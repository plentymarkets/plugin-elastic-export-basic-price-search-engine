<?php

namespace ElasticExportBasicPriceSearchEngine\Catalog\Providers;

use Plenty\Modules\Catalog\Contracts\TemplateContainerContract;
use Plenty\Plugin\ServiceProvider;

class CatalogBootServiceProvider extends ServiceProvider
{
    /**
     * @param TemplateContainerContract $container
     */
    public function boot(TemplateContainerContract $container) {
        $template = $container->register('BasicPriceSearchEngine', 'ElasticExportBasicPriceSearchEngine', CatalogTemplateProvider::class);

        $template->addSetting([
            'key' => 'testSelect',
            'isVisible' => true,
            'type' => 'select',
            'label' => 'select',
            'values' =>
            [
                [
                'caption' => 'test',
                'value' => 1
                ]
            ],
        ]);
    }
}