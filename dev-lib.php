<?php

/**
 * Your code goes here
 * init
 */



 // set environment variable


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
  
    
        // assign SKU, Name, Price, and Short Description
        $outputArray[0] = $product['sku'];
        $outputArray[1] = $product['name'];
        $outputArray[2] = $product['price'];
        $outputArray[3] = $product['short_description'];

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

class XMLFormat implements FormatInterface
{
  

    public function start()
    {
        $XMLStart = "<ROW0>\n";
        return $XMLStart;
    }

    public function finish()
    {
        $XMLEnd = "\n</ROW0>\n";
        return $XMLEnd;
    }

    // get a product info as argument
    // return XML format of that product
    public function formatProduct( $product)
    {
        $outputXMLString = '';

             // append to XML string
            $outputXMLString .= "<SKU>" . $product['sku']. "</SKU>";
            $outputXMLString .= "<NAME>" . $product['name']. "</NAME>";
            $outputXMLString .= "<PRICE>" . $product['price']. "</PRICE>";
            $outputXMLString .= "<SHORT_DESCRIPTION>" . $product['short_description']. "</SHORT_DESCRIPTION>";
 
        return $outputXMLString;
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
        if ($formatKey == 'xml') {
            $result = new XMLFormat();
        }
        return $result;

    // if formatKey == csv
    // return a new class instance of csvFormat class "return new CSVFormat()
    // if formatKey == jscon
    // return ....

    }
}