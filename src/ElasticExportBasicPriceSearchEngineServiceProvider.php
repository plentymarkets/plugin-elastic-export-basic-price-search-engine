<?php

namespace ElasticExportBasicPriceSearchEngine;

use Plenty\Modules\DataExchange\Services\ExportPresetContainer;
use Plenty\Plugin\DataExchangeServiceProvider;

/**
 * Class ElasticExportBasicPriceSearchEngineServiceProvider
 * @package ElasticExportBasicPriceSearchEngine
 */
class ElasticExportBasicPriceSearchEngineServiceProvider extends DataExchangeServiceProvider
{
    /**
     * Abstract function for registering the service provider.
     */
    public function register()
    {

    }

    /**
     * Adds the export format to the export container.
     *
     * @param ExportPresetContainer $container
     */
    public function exports(ExportPresetContainer $container)
    {
        $container->add(
            'BasicPriceSearchEngine-Plugin',
            'ElasticExportBasicPriceSearchEngine\ResultField\BasicPriceSearchEngine',
            'ElasticExportBasicPriceSearchEngine\Generator\BasicPriceSearchEngine',
            '',
            true,
            true
        );
    }
}