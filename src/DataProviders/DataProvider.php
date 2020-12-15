<?php

namespace ElasticExportBasicPriceSearchEngine\DataProviders;

use Plenty\Modules\Catalog\Contracts\CatalogExportRepositoryContract;
use Plenty\Modules\Catalog\Contracts\CatalogExportServiceContract;
use Plenty\Plugin\Application;

class DataProvider
{
    /**
     * @var CatalogExportRepositoryContract
     */
    private $catalogExportRepository;

    /**
     * @var Application
     */
    private $application;

    /**
     * ProductCreateDataProvider constructor.
     *
     * @param CatalogExportRepositoryContract $catalogExportRepositoryContract
     * @param Application $application
     */
    public function __construct(
        CatalogExportRepositoryContract $catalogExportRepositoryContract,
        Application $application
    ) {
        $this->catalogExportRepository = $catalogExportRepositoryContract;
        $this->application = $application;
    }

    /**
     * @param $catalog
     * @return \Plenty\Modules\Catalog\Models\CatalogExportResult|null
     */
    public function createData($catalog)
    {
        try {
            /** @var CatalogExportServiceContract $result */
            $result = $this->catalogExportRepository->exportById($catalog['id']);
            $result->setSettings([
                'plentyId' => $this->application->getPlentyId()
            ]);

            $result->setAdditionalFields([
                'itemId'      => 'item.id',
                'variationId' => 'variation.id',
                'exportedAt' => 'skus.exportedAt',
                'deletedAt' => 'skus.deletedAt',
                'parentSku' => 'skus.parentSku',
            ]);

            return $result->getResult();
        } catch (\Throwable $exception) {
            return null;
        }
    }
}