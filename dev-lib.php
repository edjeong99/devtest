<?php

/**
 * Your code goes here
 * init
 */

// require('raz-lib.php'); 

 // set environment variable
putenv("RAZOYO_TEST_KEY=ku%64TeYMo5mAIFj8e");


$msg = "Hi Debug Console 2 -- ";
echo $msg;


class CSVFormat implements FormatInterface
{
    public function start()
    {
        echo "Starting";
    }

    public function finish()
    {
        echo "The End";
    }

    public function formatProduct( $product)
    {
       // process product
       // return correct format 
        echo $product['sku'],'\n' ;

    }
}

class FormatFactory 
{
    public $apiData = array();

    public function create( $formatKey)
    {
        // create function return appropriate format Class depends on $formatKey
   
        if ($formatKey == 'csv') {
            $result = new CSVFormat();
        }

        return $result;

    // if formatKey == csv
    // return a new class instance of csvFormat class "return new CSVFormat()
    // if formatKey == jscon
    // return ....

    }
}