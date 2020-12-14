<?php

namespace ElasticExportBasicPriceSearchEngine\Services;

use Plenty\Modules\Catalog\Contracts\CatalogRepositoryContract;
use Plenty\Repositories\Models\PaginatedResult;

class ExportService
{

    /**
     * @var CatalogRepositoryContract
     */
    private $catalogRepositoryContract;

    /**
     * ExportService constructor.
     * @param CatalogRepositoryContract $catalogRepositoryContract
     */
    public function __construct(
        CatalogRepositoryContract $catalogRepositoryContract
    )
    {
        $this->catalogRepositoryContract = $catalogRepositoryContract;
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

//                $isProcessed = $this->export($catalog);
                $a = 'ceva';
            }

            $page++;
        } while ($catalogs->isLastPage() === false);

    }
}