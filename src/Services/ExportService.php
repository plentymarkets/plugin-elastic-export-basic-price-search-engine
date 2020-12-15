<?php

namespace ElasticExportBasicPriceSearchEngine\Services;

use ElasticExportBasicPriceSearchEngine\DataProviders\DataProvider;
use Plenty\Modules\Catalog\Contracts\CatalogRepositoryContract;
use Plenty\Modules\Catalog\Contracts\TemplateContainerContract;
use Plenty\Modules\Catalog\Models\CatalogExportResult;
use Plenty\Repositories\Models\PaginatedResult;

class ExportService
{
    /**
     * @var TemplateContainerContract
     */
    private $templateContainer;

    /**
     * @var CatalogRepositoryContract
     */
    private $catalogRepositoryContract;

    /**
     * ExportService constructor.
     * @param CatalogRepositoryContract $catalogRepositoryContract
     * @param TemplateContainerContract $templateContainer
     */
    public function __construct(
        CatalogRepositoryContract $catalogRepositoryContract,
        TemplateContainerContract $templateContainer
    )
    {
        $this->catalogRepositoryContract = $catalogRepositoryContract;
        $this->templateContainer = $templateContainer;
    }

    public function run()
    {
        $this->catalogRepositoryContract->setFilters([
            'active' => true,
            'type' => 'exampleType'
        ]);

        $page = 1;

        do {
            /** @var PaginatedResult $catalogs */
            $catalogs = $this->catalogRepositoryContract->all($page, 25);


            /** @var array $catalog */
            foreach ($catalogs->getResult() as $catalog) {
                $isProcessed = $this->export($catalog);
                $a = 'ceva';
            }

            $page++;
        } while ($catalogs->isLastPage() === false);
    }

    /**
     * @param $catalog
     * @return bool
     */
    private function export($catalog)
    {
        /** @var DataProvider $dataProvider */
        $dataProvider = pluginApp(DataProvider::class);

        /** @var CatalogExportResult $result */
        $result = $dataProvider->createData($catalog);

        if($result instanceof CatalogExportResult) {
            return $this->exportProducts($result);
        }

        return false;
    }

    /**
     * @param $result
     * @return bool
     */
    private function exportProducts($result)
    {
        /** @var array $variation */
        foreach ($result as $page) {
            foreach ($page as $variation) {

                $a = 'ceva';

            }
        }
    }
}