<?php

/**
 * Your code goes here
 * init
 */

// require('raz-lib.php'); 



 // set environment variable
putenv("RAZOYO_TEST_KEY=ku%64TeYMo5mAIFj8e");


class CSVFormat implements FormatInterface
{
    public $delimiter = ',' ;
    public $newLine = "\r\n" ;

    public function start()
    {
     $CSVStart = "Content-type: text/csv \n";
     $CSVStart .= "Content-Disposition: attachment; filename=productInfo" . date('Y-m-d') . ".csv\r\n"; 
     $CSVStart .="Pragma: no-cache\n"; 
     $CSVStart .="Expires: 0 \n"; 
     $CSVStart .= "SKU" . $this->delimiter . "Name" . $this->delimiter . "Price" . $this->delimiter . "Short Description \r\n";
     return $CSVStart;
    }

    public function finish()
    {
        echo "The End";
    }

    // get a product info as argument
    // return csv format of that product
    public function formatProduct( $product)
    {
        
       $outputCSVString ='';
       $outputArray = array();
       $cleanedOutputArray = array();
       $enclosure = '"'; 
       $delimiter_esc = preg_quote($this->delimiter, '/'); 
       $enclosure_esc = preg_quote($enclosure, '/');  
  
        // get price and short description using product info API
        $result = $client->call($session, 'catalog_product.info', '4');
        
        // SKU, Name, Price, and Short Description
        $outputArray[0] = $product['sku'];
        $outputArray[1] = $product['name'];
        $outputArray[2] = $result['price'];
        $outputArray[3] = $result['short description'];

        // if content has comma, put double quotes around, so excel won't count that as two separate entries
        foreach ( $outputArray as $output ) { 
            if ( preg_match( "/(?:${delimiter_esc}|${enclosure_esc}|\s)/", $output ) ) { 
              $cleanedOutputArray[] = $enclosure . str_replace($enclosure, $enclosure . $enclosure, $output) . $enclosure; 
            } else { 
              $cleanedOutputArray[] = $output; } 
            } 

        $outputCSVString = implode( $this->delimiter,  $outputArray )."\r\n";
        return $outputCSVString;

    }
}

// if input is number, convert it to string for csv
// if (gettype($field) == 'integer' || gettype($field) == 'double') {
//     $field = strval($field); // Change $field to string if it's a numeric type
// }

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