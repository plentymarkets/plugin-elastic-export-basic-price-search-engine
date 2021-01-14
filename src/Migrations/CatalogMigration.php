<?php

namespace ElasticExportBasicPriceSearchEngine\Migrations;

use ElasticExportBasicPriceSearchEngine\Generator\BasicPriceSearchEngine;

/**
 * Class CatalogMigration
 *
 * @package ElasticExportBasicPriceSearchEngine\Migrations
 */
class CatalogMigration
{

    public function run()
    {
        /** @var BasicPriceSearchEngine $variable */
        $variable = pluginApp(BasicPriceSearchEngine::class);
        $variable->updateCatalogData();
    }

}