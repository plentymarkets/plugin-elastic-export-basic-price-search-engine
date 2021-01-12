<?php

namespace ElasticExportBasicPriceSearchEngine\Crons;

use ElasticExportBasicPriceSearchEngine\Generator\BasicPriceSearchEngine;

/**
 * Class ExportCron
 *
 * @package ElasticExportBasicPriceSearchEngine\Crons
 */
class ExportCron
{
    /**
     * @param BasicPriceSearchEngine $exportService
     */
    public function handle(BasicPriceSearchEngine $exportService)
    {

        $exportService->getCatalog('ElasticTest1','b6ad478b-d070-5110-9bd4-a1c52feecda5');

    }
}
