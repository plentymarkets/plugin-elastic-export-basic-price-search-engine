<?php

namespace ElasticExportBasicPriceSearchEngine\Catalog\DataProviders;

use Plenty\Modules\Catalog\Contracts\TemplateContract;
use Plenty\Modules\Catalog\DataProviders\BaseDataProvider;

/**
 * Class ProductDataProvider
 *
 * @package ElasticExportBasicPriceSearchEngine\Catalog\DataProviders
 */
class GeneralDataProvider extends BaseDataProvider
{
    public function getRows(): array
    {
        return [
            //required
            [
                'key' => 'name.de',
                'label' => 'Name',
                'required' => true
            ],
            [
                'key' => 'article_id',
                'label' => 'Article Id',
                'required' => false
            ],
            [
                'key' => 'deeplink',
                'label' => 'Deeplink',
                'required' => false
            ],
            [
                'key' => 'short_description',
                'label' => 'Short description',
                'required' => false
            ],
            [
                'key' => 'description',
                'label' => 'Description',
                'required' => false
            ],
            [
                'key' => 'article',
                'label' => 'Article No',
                'required' => false
            ],
            [
                'key' => 'producer',
                'label' => 'Producer',
                'required' => false
            ],
            [
                'key' => 'model',
                'label' => 'Model',
                'required' => false
            ],
            [
                'key' => 'availability',
                'label' => 'Availability',
                'required' => false
            ],
            [
                'key' => 'ean',
                'label' => 'EAN',
                'required' => false
            ],
            [
                'key' => 'isbn',
                'label' => 'ISBN',
                'required' => false
            ],
            [
                'key' => 'unit',
                'label' => 'Unit',
                'required' => false
            ],
            [
                'key' => 'price',
                'label' => 'Price',
                'required' => false
            ],
            [
                'key' => 'price_old',
                'label' => 'Price old',
                'required' => false
            ],
            [
                'key' => 'weight',
                'label' => 'Weight',
                'required' => false
            ],
            [
                'key' => 'category1',
                'label' => 'Category1',
                'required' => false
            ],
            [
                'key' => 'category2',
                'label' => 'Category2',
                'required' => false
            ],
            [
                'key' => 'category3',
                'label' => 'Category3',
                'required' => false
            ],
            [
                'key' => 'category4',
                'label' => 'Category4',
                'required' => false
            ],
            [
                'key' => 'category5',
                'label' => 'Category5',
                'required' => false
            ],
            [
                'key' => 'category6',
                'label' => 'Category6',
                'required' => false
            ],
            [
                'key' => 'category_concat',
                'label' => 'Category Concat',
                'required' => false
            ],
            [
                'key' => 'image_url_preview',
                'label' => 'Image Url Preview',
                'required' => false
            ],
            [
                'key' => 'image_url',
                'label' => 'Image Url',
                'required' => false
            ],
            [
                'key' => 'shipment_and_handling',
                'label' => 'Shipment & Handling',
                'required' => false
            ],
            [
                'key' => 'unit_price',
                'label' => 'Unit Price',
                'required' => false
            ],
            [
                'key' => 'unit_price_value',
                'label' => 'Unit Price Value',
                'required' => false
            ],
            [
                'key' => 'unit_price_lot',
                'label' => 'Unit Price Lot',
                'required' => false
            ],
            [
                'key' => 'variation_id',
                'label' => 'Variation Id',
                'required' => false
            ]
        ];
    }


    public function setTemplate(TemplateContract $template) {}

    public function setMapping(array $mapping) {}
}