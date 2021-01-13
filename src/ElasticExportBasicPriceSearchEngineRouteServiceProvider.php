<?php
namespace ElasticExportBasicPriceSearchEngine;

use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\ApiRouter;

class ElasticExportBasicPriceSearchEngineRouteServiceProvider extends RouteServiceProvider
{
    /**
     * @param ApiRouter $api
     */
    public function map( ApiRouter $api )
    {
        $api->version( [ 'v1' ], [
            'namespace' => 'EbayNBA\Controllers'
        ], function( $router ) {
            // Test Controller
            $router->get( 'basicprice/dev/test', 'TestController@test' );
        } );
    }
}