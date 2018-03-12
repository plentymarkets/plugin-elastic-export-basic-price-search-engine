<?php

namespace ElasticExportBasicPriceSearchEngine\Helper;

use Plenty\Modules\Helper\Models\KeyValue;
use Plenty\Modules\Item\SalesPrice\Contracts\SalesPriceRepositoryContract;
use Plenty\Modules\Item\SalesPrice\Contracts\SalesPriceSearchRepositoryContract;
use Plenty\Modules\Item\SalesPrice\Models\SalesPrice;
use Plenty\Modules\Item\SalesPrice\Models\SalesPriceSearchRequest;
use Plenty\Modules\Item\SalesPrice\Models\SalesPriceSearchResponse;
use Plenty\Modules\Order\Currency\Contracts\CurrencyConversionSettingsRepositoryContract;
use Plenty\Plugin\Log\Loggable;

/**
 * Class PriceHelper
 * @package ElasticExportBasicPriceSearchEngine\Helper
 */
class PriceHelper
{
    use Loggable;

    const TRANSFER_RRP_YES = 1;
	const NET_PRICE = 'netPrice';
	const GROSS_PRICE = 'grossPrice';
    
    /**
     * @var SalesPriceSearchRepositoryContract
     */
    private $salesPriceSearchRepository;

    /**
     * @var SalesPriceSearchRequest
     */
    private $salesPriceSearchRequest;

	/**
	 * @var SalesPriceRepositoryContract
	 */
	private $salesPriceRepository;

	/**
	 * @var CurrencyConversionSettingsRepositoryContract
	 */
	private $currencyConversionSettingsRepository;

	/**
	 * @var array
	 */
	private $salesPriceCurrencyList = [];

	/**
	 * @var array
	 */
	private $currencyConversionList = [];

	/**
	 * PriceHelper constructor.
	 *
	 * @param SalesPriceSearchRepositoryContract $salesPriceSearchRepositoryContract
	 * @param SalesPriceSearchRequest $salesPriceSearchRequest
	 * @param SalesPriceRepositoryContract $salesPriceRepository
	 * @param CurrencyConversionSettingsRepositoryContract $currencyConversionSettingsRepository
	 */
    public function __construct(
        SalesPriceSearchRepositoryContract $salesPriceSearchRepositoryContract,
        SalesPriceSearchRequest $salesPriceSearchRequest,
        SalesPriceRepositoryContract $salesPriceRepository, 
        CurrencyConversionSettingsRepositoryContract $currencyConversionSettingsRepository)
    {
        $this->salesPriceSearchRepository = $salesPriceSearchRepositoryContract;
        $this->salesPriceSearchRequest = $salesPriceSearchRequest;
	    $this->salesPriceRepository = $salesPriceRepository;
	    $this->currencyConversionSettingsRepository = $currencyConversionSettingsRepository;
    }

    /** 
     * Get a list with price and recommended retail price.
     *
     * @param  array $variation
     * @param  KeyValue $settings
     * @return array
     */
    public function getPriceList($variation, KeyValue $settings):array
    {
        $variationPrice = $variationRrp = 0.00;
    	$countryId = $settings->get('destination');
 	$currency = $this->currencyRepositoryContract->getCountryCurrency($countryId)->currency;

        if($this->salesPriceSearchRequest instanceof SalesPriceSearchRequest)
        {
            $this->salesPriceSearchRequest->variationId = $variation['id'];
            $this->salesPriceSearchRequest->referrerId = $settings->get('referrerId');
	    $this->salesPriceSearchRequest->plentyId = $settings->get('plentyId');
            $this->salesPriceSearchRequest->type = 'default';
	    $this->salesPriceSearchRequest->countryId = $countryId;
 	    $this->salesPriceSearchRequest->currency = $currency;
        }

	    if(!is_null($settings->get('liveConversion')) &&
		    $settings->get('liveConversion') == true &&
		    count($this->currencyConversionList) == 0)
	    {
		    $this->currencyConversionList = $this->currencyConversionSettingsRepository->getCurrencyConversionList();
	    }

        // Getting the retail price
        $salesPriceSearch = $this->salesPriceSearchRepository->search($this->salesPriceSearchRequest);
        if($salesPriceSearch instanceof SalesPriceSearchResponse)
        {
        	$variationPrice = $this->getPriceByRetailPriceSettings($salesPriceSearch, $settings);
        }

        // Getting the recommended retail price
        if($settings->get('transferRrp') == self::TRANSFER_RRP_YES)
        {
            $this->salesPriceSearchRequest->type = 'rrp';
            $rrpPriceSearch = $this->salesPriceSearchRepository->search($this->salesPriceSearchRequest);

            if($rrpPriceSearch instanceof SalesPriceSearchResponse)
            {
				$variationRrp = $this->getPriceByRetailPriceSettings($salesPriceSearch, $settings);
            }
        }

        // Set the initial price and recommended retail price
        $price = $variationPrice;
        $rrp = $variationRrp;

        // Compare price and recommended retail price
        if ($variationPrice != '' || $variationPrice != 0.00)
        {
            // If recommended retail price is set and less than retail price...
            if ($variationRrp > 0 && $variationPrice > $variationRrp)
            {
                //set retail price as recommended retail price price
                $price = $variationRrp;
                //set recommended retail price as retail price
                $rrp = $variationPrice;
            }
        }

        return array(
            'variationRetailPrice.price'            =>  $price,
            'variationRecommendedRetailPrice.price' =>  $rrp
        );
    }

	/**
	 * Gets the price by the format setting for the retail price.
	 *
	 * @param SalesPriceSearchResponse $salesPriceSearch
	 * @param KeyValue $settings
	 * @return string
	 */
	private function getPriceByRetailPriceSettings(SalesPriceSearchResponse $salesPriceSearch, KeyValue $settings)
	{
		if(isset($salesPriceSearch->price) &&
			($settings->get('retailPrice') == self::GROSS_PRICE || is_null($settings->get('retailPrice'))))
		{
			$price = $this->calculatePriceByCurrency($salesPriceSearch, $salesPriceSearch->price, $settings);
			return (float)$price;
		}
		elseif(isset($salesPriceSearch->priceNet) && $settings->get('retailPrice') == self::NET_PRICE)
		{
			$priceNet = $this->calculatePriceByCurrency($salesPriceSearch, $salesPriceSearch->priceNet, $settings);
			return (float)$priceNet;
		}

		return '';
	}

	/**
	 * Gets the calculated price for a given currency.
	 *
	 * @param SalesPriceSearchResponse $salesPriceSearch
	 * @param $price
	 * @param KeyValue $settings
	 * @return mixed
	 */
	private function calculatePriceByCurrency(SalesPriceSearchResponse $salesPriceSearch, $price, KeyValue $settings)
	{
		if(!is_null($settings->get('liveConversion')) &&
			$settings->get('liveConversion') == true &&
			count($this->currencyConversionList) > 0 &&
			$price > 0)
		{
			if(array_key_exists($salesPriceSearch->salesPriceId, $this->salesPriceCurrencyList) &&
				$this->salesPriceCurrencyList[$salesPriceSearch->salesPriceId] === true)
			{
				$price = $price * $this->currencyConversionList['list'][$salesPriceSearch->currency]['exchange_ratio'];
				return $price;
			}
			elseif(array_key_exists($salesPriceSearch->salesPriceId, $this->salesPriceCurrencyList) &&
				$this->salesPriceCurrencyList[$salesPriceSearch->salesPriceId] === false)
			{
				return $price;
			}

			$salesPriceData = $this->salesPriceRepository->findById($salesPriceSearch->salesPriceId);

			if($salesPriceData instanceof SalesPrice)
			{
				$salePriceCurrencyData = $salesPriceData->currencies->whereIn('currency', [$this->currencyConversionList['default'], "-1"]);

				if(count($salePriceCurrencyData))
				{
					$this->salesPriceCurrencyList[$salesPriceSearch->salesPriceId] = true;

					$price = $price * $this->currencyConversionList['list'][$salesPriceSearch->currency]['exchange_ratio'];

					return $price;
				}
				else
				{
					$this->salesPriceCurrencyList[$salesPriceSearch->salesPriceId] = false;
				}
			}
		}

		return $price;
	}
}
