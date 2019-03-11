<?php

/**
 * @author William Byrne <wbyrne@razoyo.com>
 * Documentation: https://github.com/razoyo/devtest
 */

require_once __DIR__ . '/raz-lib.php';
require_once __DIR__ . '/dev-lib.php';

// getting env.php which has environmental variable value for apiKey
require('env.php');

$apiWsdl = 'https://www.shopjuniorgolf.com/api/?wsdl';
$apiUser = 'devtest';
$apiKey = getenv('RAZOYO_TEST_KEY');

$formatKey = 'csv'; // csv, xml, or json

// Connect to SOAP API using PHP's SoapClient class
// Feel free to create your own classes to organize code

// adding param for SOAP API call
$contextOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    ));

$sslContext = stream_context_create($contextOptions);

$params =  array(
    'trace' => 1,
    'exceptions' => true,
    'cache_wsdl' => WSDL_CACHE_NONE,
    'stream_context' => $sslContext
    );

 
$client = new SoapClient($apiWsdl, $params);

$session = $client->login($apiUser, $apiKey);

// get catalog product list from API as array    
// returns prod id, sku, name
$products = $client->call($session, 'catalog_product.list');


// for each product, get price and short description 
for ($i = 0; $i < count($products); $i++) {

    $product_data = $client->call($session, 'catalog_product.info', $products[$i]["product_id"]);

    $products[$i]["price"] = (array_key_exists('price', $product_data)) ? $product_data["price"] : null;
    $products[$i]["short_description"] = $product_data["short_description"];
}

$client->endSession($session);

// You will need to create a FormatFactory.
$factory = new FormatFactory();

// $format gets appropriate instance of Format Class
$format = $factory->create($formatKey);  

// See ProductOutput in raz-lib.php for reference
$output = new ProductOutput();
// set product and format
$output->setProducts($products);
$output->setFormat($format);

$output->format();
