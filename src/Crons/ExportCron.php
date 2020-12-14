<?php

namespace ElasticExportBasicPriceSearchEngine\Crons;

use ElasticExportBasicPriceSearchEngine\Services\ExportService;

/**
 * Class ExportCron
 *
 * @package ElasticExportBasicPriceSearchEngine\Crons
 */
class ExportCron
{
    /**
     * @param ExportService $exportService
     */
    public function handle(ExportService $exportService)
    {

        $exportService->run();

    }
}