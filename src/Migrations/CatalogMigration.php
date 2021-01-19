<?php

namespace ElasticExportBasicPriceSearchEngine\Migrations;

use ElasticExportBasicPriceSearchEngine\Catalog\DataProviders\BaseFieldsDataProvider;
use ElasticExportBasicPriceSearchEngine\Catalog\Providers\CatalogTemplateProvider;
use Plenty\Modules\Catalog\Contracts\CatalogContentRepositoryContract;
use Plenty\Modules\Catalog\Contracts\CatalogRepositoryContract;
use Plenty\Modules\Catalog\Contracts\TemplateContainerContract;
use Plenty\Modules\Catalog\Contracts\TemplateContract;
use Plenty\Modules\DataExchange\Contracts\ExportRepositoryContract;

/**
 * Class CatalogMigration
 *
 * @package ElasticExportBasicPriceSearchEngine\Migrations
 */
class CatalogMigration
{

    /** @var TemplateContainerContract */
    private $templateContainer;

    public function __construct(TemplateContainerContract $templateContainer)
    {
        $this->templateContainer = $templateContainer;
    }

    public function run()
    {
        $this->updateCatalogData();
    }

    /**
     * @return bool
     */
    public function updateCatalogData()
    {

        $exportRepository = pluginApp(ExportRepositoryContract::class);
        $format = $exportRepository->search(['formatKey' => 'BasicPriceSearchEngine-Plugin']);

        $template = $this->registerTemplate();
        $catalog = $this->create('Test10',$template->getIdentifier())->toArray();

        $data = [];
        $values = pluginApp(BaseFieldsDataProvider::class)->get();

        foreach ($values as $value){
            $dataProviderKey = utf8_encode($this->getDataProviderByIdentifier($value['key']));
            $data['mappings'][$dataProviderKey]['fields'][] = [
                'key' => utf8_encode($value['key']),
                'sources' => [
                    [
                        'fieldId' => utf8_encode($value['default']),
                        'key' => $value['fieldKey'],
                        'lang' => 'de',
                        'type' => $value['type'],
                        'id' => $value['id']
                    ]
                ]
            ];
        }

        // save catalog
        $catalogContentRepository = pluginApp(CatalogContentRepositoryContract::class);
        $catalogContentRepository->update($catalog['id'], $data);

        return true;
    }

    /**
     * @param string $identifier
     * @return string
     */
    private function getDataProviderByIdentifier(string $identifier)
    {
        if (preg_match('/productDescription.attributes./', $identifier)) {
            return 'secondaryGeneral';
        }

        if(preg_match('/bulletPoints/', $identifier)) {
            return 'bulletPoints';
        }

        return 'general';
    }

    /**
     * @return TemplateContract
     */
    private function registerTemplate()
    {
        return $this->templateContainer->register(
            'ElasticExportBasicPriceSearchEngine',
            'exampleType',
            CatalogTemplateProvider::class
        );
    }

    /**
     * @param $name
     * @param $template
     * @return mixed
     */
    public function create($name ,$template)
    {
        $catalogRepository = pluginApp(CatalogRepositoryContract::class);

        return $catalogRepository->create(['name' => $name, 'template' => $template]);
    }
}