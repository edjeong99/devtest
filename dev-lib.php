<?php

/**
 * Your code goes here
 * init
 */
require('export.php'); 

 // set environment variable
putenv("RAZOYO_TEST_KEY=ku%64TeYMo5mAIFj8e");


$msg = "Hi Debug Console 2 -- ";
echo $msg;
echo $apiUser;


class FormatFactory 
{
    
    public $apiData = array();

    public function create(string $formatKey)
    {
    //     // get data from API
    //    


    // if formatKey == csv
    // return a new class instance of csvFormat class "return new CSVFormat()
    // if formatKey == jscon
    // return ....

    // all class should have start, finish, formatProduct method 
    // 
    }
    

}

class CSVFormat
{
    public function start(){
        echo "Starting";
    }

    public function finish(){
        echo "The End";
    }

    public function formatProduct(array $product){
       // process product
       // return correct format 
    }
}
