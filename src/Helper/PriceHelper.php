<?php

namespace ElasticExportBasicPriceSearchEngine\Helper;

use Plenty\Modules\Helper\Models\KeyValue;
use Plenty\Modules\Item\SalesPrice\Contracts\SalesPriceSearchRepositoryContract;
use Plenty\Modules\Item\SalesPrice\Models\SalesPriceSearchRequest;
use Plenty\Modules\Item\SalesPrice\Models\SalesPriceSearchResponse;
use Plenty\Plugin\Log\Loggable;

/**
 * Class PriceHelper
 * @package ElasticExportBasicPriceSearchEngine\Helper
 */
class PriceHelper
{
    use Loggable;

    const TRANSFER_RRP_YES = 1;

    /**
     * @var SalesPriceSearchRepositoryContract
     */
    private $salesPriceSearchRepository;

    /**
     * @var SalesPriceSearchRequest
     */
    private $salesPriceSearchRequest;

    /**
     * PriceHelper constructor.
     *
     * @param SalesPriceSearchRepositoryContract $salesPriceSearchRepositoryContract
     * @param SalesPriceSearchRequest $salesPriceSearchRequest
     */
    public function __construct(
        SalesPriceSearchRepositoryContract $salesPriceSearchRepositoryContract,
        SalesPriceSearchRequest $salesPriceSearchRequest)
    {
        $this->salesPriceSearchRepository = $salesPriceSearchRepositoryContract;
        $this->salesPriceSearchRequest = $salesPriceSearchRequest;
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

        if($this->salesPriceSearchRequest instanceof SalesPriceSearchRequest)
        {
            $this->salesPriceSearchRequest->variationId = $variation['id'];
            $this->salesPriceSearchRequest->referrerId = $settings->get('referrerId');
            $this->salesPriceSearchRequest->type = 'default';
        }

        // Getting the retail price
        $salesPriceSearch = $this->salesPriceSearchRepository->search($this->salesPriceSearchRequest);
        if($salesPriceSearch instanceof SalesPriceSearchResponse)
        {
            $variationPrice = (float)$salesPriceSearch->price;
        }

        // Getting the recommended retail price
        if($settings->get('transferRrp') == self::TRANSFER_RRP_YES)
        {
            $this->salesPriceSearchRequest->type = 'rrp';
            $rrpPriceSearch = $this->salesPriceSearchRepository->search($this->salesPriceSearchRequest);

            if($rrpPriceSearch instanceof SalesPriceSearchResponse)
            {
                $variationRrp = (float)$rrpPriceSearch->price;
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
}