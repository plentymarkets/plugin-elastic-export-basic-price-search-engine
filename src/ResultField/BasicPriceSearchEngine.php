<?php

namespace ElasticExportBasicPriceSearchEngine\ResultField;

use Plenty\Modules\DataExchange\Contracts\ResultFields;
use Plenty\Modules\DataExchange\Models\FormatSetting;
use Plenty\Modules\Helper\Services\ArrayHelper;
use Plenty\Modules\Item\Search\Mutators\ImageMutator;
use Plenty\Modules\Cloud\ElasticSearch\Lib\Source\Mutator\BuiltIn\LanguageMutator;
use Plenty\Modules\Item\Search\Mutators\DefaultCategoryMutator;

/**
 * Class BasicPriceSearchEngine
 */
class BasicPriceSearchEngine extends ResultFields
{
    /*
	 * @var ArrayHelper
	 */
    private $arrayHelper;

    /**
     * BasicPriceSearchEngine constructor.
     * @param ArrayHelper $arrayHelper
     */
    public function __construct(ArrayHelper $arrayHelper)
    {
        $this->arrayHelper = $arrayHelper;
    }

    /**
     * Generate result fields.
     * @param  array $formatSettings = []
     * @return array
     */
    public function generateResultFields(array $formatSettings = []):array
    {
        $settings = $this->arrayHelper->buildMapFromObjectList($formatSettings, 'key', 'value');

        $reference = $settings->get('referrerId') ? $settings->get('referrerId') : -1;

        //Mutator
        /**
         * @var ImageMutator $imageMutator
         */
        $imageMutator = pluginApp(ImageMutator::class);
        if($imageMutator instanceof ImageMutator)
        {
            $imageMutator->addMarket($reference);
        }
        /**
         * @var LanguageMutator $languageMutator
         */
        $languageMutator = pluginApp(LanguageMutator::class, [[$settings->get('lang')]]);
        /**
         * @var DefaultCategoryMutator $defaultCategoryMutator
         */
        $defaultCategoryMutator = pluginApp(DefaultCategoryMutator::class);
        if($defaultCategoryMutator instanceof DefaultCategoryMutator)
        {
            $defaultCategoryMutator->setPlentyId($settings->get('plentyId'));
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

                //texts
                'texts.name'.$settings->get('nameId'),
                'texts.shortDescription',
                'texts.description',
                'texts.technicalData',
                'texts.urlPath',

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
            ],
        ];

        if($reference != -1)
        {
            $fields[1][] = $imageMutator;
        }

        return $fields;
    }
}
