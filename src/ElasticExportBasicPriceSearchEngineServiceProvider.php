<?php

namespace ElasticExportBasicPriceSearchEngine;

use ElasticExportBasicPriceSearchEngine\Catalog\Providers\CatalogBootServiceProvider;
use ElasticExportBasicPriceSearchEngine\Crons\ExportCron;
use Plenty\Modules\Cron\Services\CronContainer;
use Plenty\Modules\DataExchange\Services\ExportPresetContainer;
use Plenty\Plugin\ServiceProvider;

/**
 * Class ElasticExportBasicPriceSearchEngineServiceProvider
 * @package ElasticExportBasicPriceSearchEngine
 */
class ElasticExportBasicPriceSearchEngineServiceProvider extends ServiceProvider
{

    /**
     * Abstract function for registering the service provider.
     *
     * @throws \ErrorException
     */
    public function register()
    {
        $this->getApplication()->register(CatalogBootServiceProvider::class);
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
    public function boot(CronContainer $cronContainer)
    {
        // register crons
        $cronContainer->add(CronContainer::EVERY_FIFTEEN_MINUTES, ExportCron::class);
    }
}