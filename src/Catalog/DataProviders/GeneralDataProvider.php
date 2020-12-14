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
                'required' => true
            ],
            [
                'key' => 'deeplink',
                'label' => 'Deeplink',
                'required' => true
            ],
            [
                'key' => 'short_description',
                'label' => 'Short description',
                'required' => true
            ],
            [
                'key' => 'description',
                'label' => 'Description',
                'required' => true
            ],
            [
                'key' => 'article',
                'label' => 'Article No',
                'required' => true
            ],
            [
                'key' => 'producer',
                'label' => 'Producer',
                'required' => true
            ],
            [
                'key' => 'model',
                'label' => 'Model',
                'required' => true
            ],
            [
                'key' => 'availability',
                'label' => 'Availability',
                'required' => true
            ],
            [
                'key' => 'ean',
                'label' => 'EAN',
                'required' => true
            ],
            [
                'key' => 'isbn',
                'label' => 'ISBN',
                'required' => true
            ],
            [
                'key' => 'unit',
                'label' => 'Unit',
                'required' => true
            ],
            [
                'key' => 'price',
                'label' => 'Price',
                'required' => true
            ],
            [
                'key' => 'price_old',
                'label' => 'Price old',
                'required' => true
            ],
            [
                'key' => 'weight',
                'label' => 'Weight',
                'required' => true
            ],
            [
                'key' => 'category1',
                'label' => 'Category1',
                'required' => true
            ],
            [
                'key' => 'category2',
                'label' => 'Category2',
                'required' => true
            ],
            [
                'key' => 'category3',
                'label' => 'Category3',
                'required' => true
            ],
            [
                'key' => 'category4',
                'label' => 'Category4',
                'required' => true
            ],
            [
                'key' => 'category5',
                'label' => 'Category5',
                'required' => true
            ],
            [
                'key' => 'category6',
                'label' => 'Category6',
                'required' => true
            ],
            [
                'key' => 'category_concat',
                'label' => 'Category Concat',
                'required' => true
            ],
            [
                'key' => 'image_url_preview',
                'label' => 'Image Url Preview',
                'required' => true
            ],
            [
                'key' => 'image_url',
                'label' => 'Image Url',
                'required' => true
            ],
            [
                'key' => 'shipment_and_handling',
                'label' => 'Shipment & Handling',
                'required' => true
            ],
            [
                'key' => 'unit_price',
                'label' => 'Unit Price',
                'required' => true
            ],
            [
                'key' => 'unit_price_value',
                'label' => 'Unit Price Value',
                'required' => true
            ],
            [
                'key' => 'unit_price_lot',
                'label' => 'Unit Price Lot',
                'required' => true
            ],
            [
                'key' => 'variation_id',
                'label' => 'Variation Id',
                'required' => true
            ]
        ];
    }


    public function setTemplate(TemplateContract $template) {}

    public function setMapping(array $mapping) {}
}