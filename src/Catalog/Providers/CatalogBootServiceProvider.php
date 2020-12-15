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

        $container->register('ElasticExportBasicPriceSearchEngine', 'exampleType', CatalogTemplateProvider::class);

    }
}