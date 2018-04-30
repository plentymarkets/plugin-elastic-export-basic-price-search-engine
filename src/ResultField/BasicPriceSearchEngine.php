<?php

namespace ElasticExportBasicPriceSearchEngine\ResultField;

use Plenty\Modules\Cloud\ElasticSearch\Lib\ElasticSearch;
use Plenty\Modules\DataExchange\Contracts\ResultFields;
use Plenty\Modules\DataExchange\Models\FormatSetting;
use Plenty\Modules\Helper\Services\ArrayHelper;
use Plenty\Modules\Item\Search\Mutators\BarcodeMutator;
use Plenty\Modules\Item\Search\Mutators\ImageMutator;
use Plenty\Modules\Cloud\ElasticSearch\Lib\Source\Mutator\BuiltIn\LanguageMutator;
use Plenty\Modules\Item\Search\Mutators\DefaultCategoryMutator;
use Plenty\Modules\Item\Search\Mutators\KeyMutator;

/**
 * Class BasicPriceSearchEngine
 * @package ElasticExportBasicPriceSearchEngine\ResultField
 */
class BasicPriceSearchEngine extends ResultFields
{
    const ALL_MARKET_REFERENCE = -1;

    /**
	 * @var ArrayHelper
	 */
    private $arrayHelper;

    /**
     * BasicPriceSearchEngine constructor.
     *
     * @param ArrayHelper $arrayHelper
     */
    public function __construct(ArrayHelper $arrayHelper)
    {
        $this->arrayHelper = $arrayHelper;
    }

    /**
     * Generate result fields.
     *
     * @param  array $formatSettings = []
     * @return array
     */
    public function generateResultFields(array $formatSettings = []):array
    {
        $settings = $this->arrayHelper->buildMapFromObjectList($formatSettings, 'key', 'value');

        $reference = $settings->get('referrerId') ? $settings->get('referrerId') : self::ALL_MARKET_REFERENCE;

		$this->setOrderByList([
			'path' => 'item.id',
			'order' => ElasticSearch::SORTING_ORDER_ASC]);

        // Mutators
        /**
         * @var ImageMutator $imageMutator
         */
        $imageMutator = pluginApp(ImageMutator::class);
        if($imageMutator instanceof ImageMutator)
        {
            // add image reference for a specific market
            $imageMutator->addMarket($reference);

            // add image reference -1 when the image is available for all markets
            $imageMutator->addMarket(self::ALL_MARKET_REFERENCE);
        }

        /**
         * @var KeyMutator $keyMutator
         */
        $keyMutator = pluginApp(KeyMutator::class);
        if($keyMutator instanceof KeyMutator)
        {
            $keyMutator->setKeyList($this->getKeyList());
            $keyMutator->setNestedKeyList($this->getNestedKeyList());
        }

        /**
         * @var LanguageMutator $languageMutator
         */
		$languageMutator = pluginApp(LanguageMutator::class, ['language' => [$settings->get('lang')]]);

        /**
         * @var DefaultCategoryMutator $defaultCategoryMutator
         */
        $defaultCategoryMutator = pluginApp(DefaultCategoryMutator::class);
        if($defaultCategoryMutator instanceof DefaultCategoryMutator)
        {
            $defaultCategoryMutator->setPlentyId($settings->get('plentyId'));
        }

        /**
         * @var BarcodeMutator $barcodeMutator
         */
        $barcodeMutator = pluginApp(BarcodeMutator::class);
        if($barcodeMutator instanceof BarcodeMutator)
        {
            $barcodeMutator->addMarket($reference);
        }

        $fields = [
            [
                //item
                'item.id',
                'item.manufacturer.id',
                'item.amazonFedas',

                //variation
                'id',
                'variation.availability.id',
                'variation.model',
                'variation.weightG',
                'variation.number',

                //texts
                'texts.name'.$settings->get('nameId'),
                'texts.shortDescription',
                'texts.description',
                'texts.technicalData',
                'texts.urlPath',
                'texts.lang',

                //unit
                'unit.content',
                'unit.id',

                //images
                'images.item.urlMiddle',
                'images.item.urlPreview',
                'images.item.urlSecondPreview',
                'images.item.url',
                'images.item.path',
                'images.item.position',

                'images.variation.urlMiddle',
                'images.variation.urlPreview',
                'images.variation.urlSecondPreview',
                'images.variation.url',
                'images.variation.path',
                'images.variation.position',

                //defaultCategories
                'defaultCategories.id',

                //barcodes
                'barcodes.code',
                'barcodes.type',
                'barcodes.id',
                'barcodes.name',
            ],

            [
                $languageMutator,
                $defaultCategoryMutator,
                $keyMutator,
                $barcodeMutator
            ],
        ];

        if($reference != -1)
        {
            $fields[1][] = $imageMutator;
        }

        return $fields;
    }

    /**
     * Returns the list of keys.
     *
     * @return array
     */
    private function getKeyList()
    {
        $keyList = [
            //item
            'item.id',
            'item.manufacturer.id',
            'item.amazonFedas',

            //variation
            'variation.availability.id',
            'variation.model',
            'variation.weightG',
            'variation.number',

            //unit
            'unit.content',
            'unit.id',
        ];

        return $keyList;
    }

    /**
     * Returns the list of nested keys.
     *
     * @return mixed
     */
    private function getNestedKeyList()
    {
        $nestedKeyList['keys'] = [
            //images
            'images.item',
            'images.variation',

            //texts
            'texts',

            //defaultCategories
            'defaultCategories',

            //barcodes
            'barcodes',
        ];

        $nestedKeyList['nestedKeys'] = [
            //images
            'images.item' => [
                'urlMiddle',
                'urlPreview',
                'urlSecondPreview',
                'url',
                'path',
                'position',
            ],

            'images.variation' => [
                'urlMiddle',
                'urlPreview',
                'urlSecondPreview',
                'url',
                'path',
                'position',
            ],

            //texts
            'texts'  => [
                'urlPath',
                'lang',
                'name1',
                'name2',
                'name3',
                'shortDescription',
                'description',
                'technicalData',
            ],

            //defaultCategories
            'defaultCategories' => [
                'id',
            ],

            //barcodes
            'barcodes'  => [
                'code',
                'type',
                'name',
                'id',
            ]
        ];

        return $nestedKeyList;
    }
}
