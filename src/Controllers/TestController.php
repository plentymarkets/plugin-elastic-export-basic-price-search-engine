<?php
namespace ElasticExportBasicPriceSearchEngine\Controllers;

use ElasticExportBasicPriceSearchEngine\Generator\BasicPriceSearchEngine;
use Plenty\Modules\Authorization\Services\AuthHelper;
use Plenty\Plugin\Controller;

class TestController extends Controller
{
    const CLASS_NAME = 'TestController';

    /**
     * @param AuthHelper $authHelper
     *
     * @return string
     * @throws \Throwable
     */
    public function test( AuthHelper $authHelper )
    {
        $authHelper->processUnguarded( function() {
            $variable = pluginApp(BasicPriceSearchEngine::class);
            $variable->updateCatalogData();
        } );

        return 'done';
    }
}