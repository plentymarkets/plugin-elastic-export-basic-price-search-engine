<?php

namespace ElasticExportBasicPriceSearchEngine\Catalog\DataProviders;

/**
 * Class BaseFieldsDataProvider
 *
 * @package ElasticExportBasicPriceSearchEngine\Catalog\DataProviders
 */
class BaseFieldsDataProvider
{
    /**
     * @return array
     */
    public function get():array
    {
        return [
//            [
//                'key' => 'name.de',
//                'simplifiedKey' => 'name.de',
//                'required' => true,
//                'label' => 'Name',
//                'default' => 'item-id',
//                'type' => 'string',
//            	'isMapping' => false,
//            ],
            [
                'key' => 'name.de',
                'label' => 'Name',
                'required' => true,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'article_id',
                'label' => 'Article Id',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'deeplink',
                'label' => 'Deeplink',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'short_description',
                'label' => 'Short description',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'description',
                'label' => 'Description',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'article',
                'label' => 'Article No',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'producer',
                'label' => 'Producer',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'model',
                'label' => 'Model',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'availability',
                'label' => 'Availability',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'ean',
                'label' => 'EAN',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'isbn',
                'label' => 'ISBN',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'unit',
                'label' => 'Unit',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'price',
                'label' => 'Price',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'price_old',
                'label' => 'Price old',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'weight',
                'label' => 'Weight',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'category1',
                'label' => 'Category1',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'category2',
                'label' => 'Category2',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'category3',
                'label' => 'Category3',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'category4',
                'label' => 'Category4',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'category5',
                'label' => 'Category5',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'category6',
                'label' => 'Category6',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'category_concat',
                'label' => 'Category Concat',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'image_url_preview',
                'label' => 'Image Url Preview',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'image_url',
                'label' => 'Image Url',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'shipment_and_handling',
                'label' => 'Shipment & Handling',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'unit_price',
                'label' => 'Unit Price',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'unit_price_value',
                'label' => 'Unit Price Value',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'unit_price_lot',
                'label' => 'Unit Price Lot',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ],
            [
                'key' => 'variation_id',
                'label' => 'Variation Id',
                'required' => false,
                'default' => 'item-id',
                'type' => 'string',
                'isMapping' => false,
            ]
            

        ];
    }
}
