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
            ]
        ];
    }

    public function setTemplate(TemplateContract $template) {}

    public function setMapping(array $mapping) {}
}