<?php

namespace ElasticExportBasicPriceSearchEngine\Generator;

use ElasticExport\Helper\ElasticExportStockHelper;
use ElasticExport\Services\FiltrationService;
use ElasticExportBasicPriceSearchEngine\Helper\PriceHelper;
use Plenty\Modules\DataExchange\Contracts\CSVPluginGenerator;
use Plenty\Modules\Helper\Services\ArrayHelper;
use Plenty\Modules\DataExchange\Models\FormatSetting;
use ElasticExport\Helper\ElasticExportCoreHelper;
use Plenty\Modules\Helper\Models\KeyValue;
use Plenty\Modules\Item\Search\Contracts\VariationElasticSearchScrollRepositoryContract;
use Plenty\Plugin\Log\Loggable;

/**
 * Class BasicPriceSearchEngine
 * @package ElasticExportBasicPriceSearchEngine\Generator
 */
class BasicPriceSearchEngine extends CSVPluginGenerator
{
    use Loggable;

    const DELIMITER = '	';

    const IMAGE_TYPE_NORMAL = 'normal';
    
    /**
     * @var ElasticExportCoreHelper
     */
    private $elasticExportHelper;

    /**
     * @var ElasticExportStockHelper $elasticExportStockHelper
     */
    private $elasticExportStockHelper;

    /**
     * @var ArrayHelper
     */
    private $arrayHelper;

    /**
     * @var PriceHelper
     */
    private $priceHelper;

    /**
     * @var array
     */
    private $shipmentCache;

    /**
     * @var array
     */
    private $manufacturerCache;

    /**
     * @var FiltrationService
     */
    private $filtrationService;

    /**
     * BasicPriceSearchEngine constructor.
     *
     * @param ArrayHelper $arrayHelper
     */
    public function __construct(
        ArrayHelper $arrayHelper,
        PriceHelper $priceHelper)
    {
        $this->arrayHelper = $arrayHelper;
        $this->priceHelper = $priceHelper;
    }

    /**
     * Generates and populates the data into the CSV file.
     *
     * @param VariationElasticSearchScrollRepositoryContract $elasticSearch
     * @param array $formatSettings
     * @param array $filter
     */
    protected function generatePluginContent($elasticSearch, array $formatSettings = [], array $filter = [])
    {
        $this->elasticExportStockHelper = pluginApp(ElasticExportStockHelper::class);
        $this->elasticExportHelper = pluginApp(ElasticExportCoreHelper::class);

        $settings = $this->arrayHelper->buildMapFromObjectList($formatSettings, 'key', 'value');
        $this->filtrationService = pluginApp(FiltrationService::class, [$settings, $filter]);

        $this->setDelimiter(self::DELIMITER);

        $this->addCSVContent($this->head());

        $startTime = microtime(true);

        if($elasticSearch instanceof VariationElasticSearchScrollRepositoryContract)
        {
            // Initiate the counter for the variations limit
            $limit = 0;
            $limitReached = false;

            do
            {
                $this->getLogger(__METHOD__)->debug('ElasticExportBasicPriceSearchEngine::logs.writtenLines', [
                    'Lines written' => $limit,
                ]);

                if($limitReached === true)
                {
                    break;
                }

                $esStartTime = microtime(true);

                // Get the data from Elastic Search
                $resultList = $elasticSearch->execute();

                $this->getLogger(__METHOD__)->debug('ElasticExportBasicPriceSearchEngine::logs.esDuration', [
                    'Elastic Search duration' => microtime(true) - $esStartTime,
                ]);

                if(count($resultList['error']) > 0)
                {
                    $this->getLogger(__METHOD__)->error('ElasticExportBasicPriceSearchEngine::logs.occurredElasticSearchErrors', [
                        'Error message' => $resultList['error'],
                    ]);

                    break;
                }

                $buildRowStartTime = microtime(true);

                if(is_array($resultList['documents']) && count($resultList['documents']) > 0)
                {
                    $previousId = null;

                    foreach($resultList['documents'] as $variation)
                    {
                        // Stop and set the flag if limit is reached
                        if($limit == $filter['limit'])
                        {
                            $limitReached = true;
                            break;
                        }

                        // If filtered by stock is set and stock is negative, then skip the variation
                        if ($this->filtrationService->filter($variation))
                        {
                            $this->getLogger(__METHOD__)->info('ElasticExportBasicPriceSearchEngine::logs.variationNotPartOfExportStock', [
                                'VariationId' => $variation['id']
                            ]);

                            continue;
                        }

                        try
                        {
                            // Set the caches if we have the first variation or when we have the first variation of an item
                            if($previousId === null || $previousId != $variation['data']['item']['id'])
                            {
                                $previousId = $variation['data']['item']['id'];
                                unset($this->shipmentCache, $this->manufacturerCache);

                                // Build the caches arrays
                                $this->buildCaches($variation, $settings);
                            }

                            // Build the new row for printing in the CSV file
                            $this->buildRow($variation, $settings);
                        }
                        catch(\Throwable $throwable)
                        {
                            $this->getLogger(__METHOD__)->error('ElasticExportBasicPriceSearchEngine::logs.fillRowError', [
                                'Error message ' => $throwable->getMessage(),
                                'Error line'     => $throwable->getLine(),
                                'VariationId'    => $variation['id']
                            ]);
                        }

                        // New line was added
                        $limit++;
                    }

                    $this->getLogger(__METHOD__)->debug('ElasticExportBasicPriceSearchEngine::logs.buildRowDuration', [
                        'Build rows duration' => microtime(true) - $buildRowStartTime,
                    ]);
                }

            } while ($elasticSearch->hasNext());
        }

        $this->getLogger(__METHOD__)->debug('ElasticExportBasicPriceSearchEngine::logs.fileGenerationDuration', [
            'Whole file generation duration' => microtime(true) - $startTime,
        ]);
    }

    /**
     * Creates the header of the CSV file.
     *
     * @return array
     */
    private function head():array
    {
        return array(
            'article_id',
            'deeplink',
            'name',
            'short_description',
            'description',
            'article_no',
            'producer',
            'model',
            'availability',
            'ean',
            'isbn',
            'unit',
            'price',
            'price_old',
            'weight',
            'category1',
            'category2',
            'category3',
            'category4',
            'category5',
            'category6',
            'category_concat',
            'image_url_preview',
            'image_url',
            'shipment_and_handling',
            'unit_price',
            'unit_price_value',
            'unit_price_lot',
            'variation_id'
        );
    }

    /**
     * Creates the variation row and prints it into the CSV file.
     *
     * @param $variation
     * @param KeyValue $settings
     */
    private function buildRow($variation, KeyValue $settings)
    {
        // get the price list
        $priceList = $this->priceHelper->getPriceList($variation, $settings);

        // only variations with the Retail Price greater than zero will be handled
        if(!is_null($priceList['variationRetailPrice.price']) && $priceList['variationRetailPrice.price'] > 0)
        {
            $shipmentAndHandling = $this->getShipment($variation);

            $manufacturer = $this->getManufacturer($variation);

            $basePriceList = $this->elasticExportHelper->getBasePriceList($variation, $priceList['variationRetailPrice.price'], $settings->get('lang'));

            $imageList = $this->getImageList($variation, $settings, self::IMAGE_TYPE_NORMAL);

            $data = [
                'article_id'            => $variation['data']['item']['id'],
                'deeplink'              => $this->elasticExportHelper->getMutatedUrl($variation, $settings, true, false),
                'name'                  => $this->elasticExportHelper->getMutatedName($variation, $settings),
                'short_description'     => $this->elasticExportHelper->getMutatedPreviewText($variation, $settings),
                'description'           => $this->elasticExportHelper->getMutatedDescription($variation, $settings, 256),
                'article_no'            => $variation['data']['variation']['number'],
                'producer'              => $manufacturer,
                'model'                 => $variation['data']['variation']['model'],
                'availability'          => $this->elasticExportHelper->getAvailability($variation, $settings),
                'ean'                   => $this->elasticExportHelper->getBarcodeByType($variation, ElasticExportCoreHelper::BARCODE_EAN),
                'isbn'                  => $this->elasticExportHelper->getBarcodeByType($variation, ElasticExportCoreHelper::BARCODE_ISBN),
                'unit'                  => $basePriceList['unit'],
                'price'                 => number_format((float)$priceList['variationRetailPrice.price'], 2, '.', ''),
                'price_old'             => number_format((float)$priceList['variationRecommendedRetailPrice.price'], 2, '.', ''),
                'weight'                => $variation['data']['variation']['weightG'],
                'category1'             => $this->elasticExportHelper->getCategoryBranch($variation['data']['defaultCategories'][0]['id'], $settings, 1),
                'category2'             => $this->elasticExportHelper->getCategoryBranch($variation['data']['defaultCategories'][0]['id'], $settings, 2),
                'category3'             => $this->elasticExportHelper->getCategoryBranch($variation['data']['defaultCategories'][0]['id'], $settings, 3),
                'category4'             => $this->elasticExportHelper->getCategoryBranch($variation['data']['defaultCategories'][0]['id'], $settings, 4),
                'category5'             => $this->elasticExportHelper->getCategoryBranch($variation['data']['defaultCategories'][0]['id'], $settings, 5),
                'category6'             => $this->elasticExportHelper->getCategoryBranch($variation['data']['defaultCategories'][0]['id'], $settings, 6),
                'category_concat'       => $this->elasticExportHelper->getCategory((int)$variation['data']['defaultCategories'][0]['id'], $settings->get('lang'), $settings->get('plentyId')),
                'image_url_preview'     => $imageList['preview']['url'],
                'image_url'             => $imageList['normal']['url'],
                'shipment_and_handling' => $shipmentAndHandling,
                'unit_price'            => $this->elasticExportHelper->getBasePrice($variation, $priceList, $settings->get('lang')),
                'unit_price_value'      => $basePriceList['price'],
                'unit_price_lot'        => $basePriceList['lot'],
                'variation_id'          => $variation['id']
            ];

            $this->addCSVContent(array_values($data));
        }
        else
        {
            $this->getLogger(__METHOD__)->info('ElasticExportBasicPriceSearchEngine::logs.variationNotPartOfExportPrice', [
                'VariationId' => $variation['id']
            ]);
        }
    }

	/**
	 * Get image information.
	 *
	 * @param  array    $variation
	 * @param  KeyValue $settings
	 * @param  string   $imageType
	 * @return array
	 */
	private function getImageList($variation, KeyValue $settings, string $imageType):array
	{
		$image = $this->elasticExportHelper->getImageListInOrder($variation, $settings, 1, $this->elasticExportHelper::VARIATION_IMAGES, $imageType, true);

		$imageInformation = [
			'preview' => [
				'url' => '',
			],
			'normal' => [
				'url' => '',
			]
		];

		foreach($image as $imageData)
		{
			if(strlen($imageData['urlPreview']) > 0)
			{
				$imageInformation['preview'] = [
					'url' => $imageData['urlPreview'],
				];
			}

			if(strlen($imageData['url']) > 0)
			{
				$imageInformation['normal'] = [
					'url' => $imageData['url'],
				];
			}
		}

		return $imageInformation;
	}

    /**
     * Build the cache arrays for the item variation.
     *
     * @param $variation
     * @param $settings
     */
    private function buildCaches($variation, $settings)
    {
        if(!is_null($variation) && !is_null($variation['data']['item']['id']))
        {
            $this->shipmentCache[$variation['data']['item']['id']] = $this->elasticExportHelper->getShippingCost($variation['data']['item']['id'], $settings);

            $this->manufacturerCache[$variation['data']['item']['id']] = $this->elasticExportHelper->getExternalManufacturerName((int)$variation['data']['item']['manufacturer']['id']);
        }
    }

    /**
     * Get the shipment cost.
     *
     * @param $variation
     * @return string
     */
    private function getShipment($variation):string
    {
        $shipment = null;
        if(isset($this->shipmentCache) && array_key_exists($variation['data']['item']['id'], $this->shipmentCache))
        {
            $shipment = $this->shipmentCache[$variation['data']['item']['id']];
        }

        if(!is_null($shipment))
        {
            $shipment = number_format((float)$shipment, 2, ',', '');
            return $shipment;
        }

        return '';
    }

    /**
     * Get the manufacturer name.
     *
     * @param $variation
     * @return string
     */
    private function getManufacturer($variation):string
    {
        $manufacturer = null;
        if(isset($this->manufacturerCache) && array_key_exists($variation['data']['item']['id'], $this->manufacturerCache))
        {
            $manufacturer = $this->manufacturerCache[$variation['data']['item']['id']];
        }

        if(!is_null($manufacturer))
        {
            return $manufacturer;
        }

        return '';
    }
}