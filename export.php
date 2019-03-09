<?php

/**
 * @author William Byrne <wbyrne@razoyo.com>
 * Documentation: https://github.com/razoyo/devtest
 */

require_once __DIR__ . '/raz-lib.php';
require_once __DIR__ . '/dev-lib.php';

$apiWsdl = 'https://www.shopjuniorgolf.com/api/?wsdl';
$apiUser = 'devtest';
$apiKey = getenv('RAZOYO_TEST_KEY');

$formatKey = 'csv'; // csv, xml, or json

// Connect to SOAP API using PHP's SoapClient class
// Feel free to create your own classes to organize code


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

$session = $client->login($apiUser, 'ku%64TeYMo5mAIFj8e');
echo $session;
    
$apiData = $client->call($session, 'catalog_product.info', '4');
echo "result start";
print_r( $apiData);
echo "result end";
$client->endSession($session);

// You will need to create a FormatFactory.
$factory = new FormatFactory();

// assign appropriate instance of Format Class
$format = $factory->create($formatKey);  

// See ProductOutput in raz-lib.php for reference
$output = new ProductOutput();
// set product and format
$output->setProducts($apiData);
$output->setFormat($format);
$output->format();
