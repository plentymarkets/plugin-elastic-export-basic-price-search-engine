<?php

namespace ElasticExportBasicPriceSearchEngine;

use Plenty\Modules\DataExchange\Services\ExportPresetContainer;
use Plenty\Plugin\DataExchangeServiceProvider;

class ElasticExportBasicPriceSearchEngineServiceProvider extends DataExchangeServiceProvider
{
    public function register()
    {

    }

    public function exports(ExportPresetContainer $container)
    {
        $container->add(
            'BasicPriceSearchEngine-Plugin',
            'ElasticExportBasicPriceSearchEngine\ResultField\BasicPriceSearchEngine',
            'ElasticExportBasicPriceSearchEngine\Generator\BasicPriceSearchEngine',
            true
        );
    }
}