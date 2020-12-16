<?php

namespace ElasticExportBasicPriceSearchEngine\Catalog\Providers;

use ElasticExportBasicPriceSearchEngine\Catalog\DataProviders\GeneralDataProvider;
use Plenty\Modules\Catalog\Templates\BaseTemplateProvider;

/**
 * Class CatalogTemplateProvider
 *
 * @package ElasticExportBasicPriceSearchEngine\Catalog\Providers
 */
class CatalogTemplateProvider extends BaseTemplateProvider
{
    /**
     * @return array
     */
    public function getMappings(): array
    {
        return [
            [
                'identifier' => 'general',
                'label' => 'General',
                'isMapping' => false,
                'provider' => GeneralDataProvider::class,
            ],
        ];
    }

    /**
     * @return array
     */
    public function getFilter(): array
    {
        return [
//            [
//                'name' => 'variationMarket.isVisibleForMarket',
//                'params' => [
//                      [
//                          'name' => 'marketId',
//                          'value' => 9.00
//                      ]
//                ]
//            ],
        //Check if variation is active
//            [
//                'name' => 'variationBase.isActive',
//                'params' => [
//                    [
//                        'name' => 'active',
//                        'value' => true
//                    ]
//                ]
//            ],
            [
                'name' => 'variationBase.hasBarcode',
                'params' => [
                    [
                        'name' => 'exist',
                        'value' => true
                    ]
                ]
            ]
        ];
    }

    /**
     * @return callable[]
     */
    public function getPreMutators(): array
    {
        return [];
    }

    /**
     * @return callable[]
     */
    public function getPostMutators(): array
    {
        return [];
    }

    /**
     * @return callable
     */
    public function getSkuCallback(): callable
    {
        return function ($value, $item) {
            return $value;
        };
    }

    /**
     * @return array
     */
    public function getSettings(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getMetaInfo(): array
    {
        return [];
    }
}