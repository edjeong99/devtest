<?php

/**
 * Your code goes here
 * 
 */


// JSONFormat has an input argument of an Array that contains info about a product
// it returns array of JSON object that contains
// SKU, name, price, short description of the product

class JSONFormat implements FormatInterface
{

    public function start()
    {
        $JSONStart = "[";
        return $JSONStart;
    }

    public function finish()
    {
        $JSONEnd = "]";
        return $JSONEnd;
    }

    // get a product info as argument
    // return XML format of that product
    public function formatProduct( $product)
    {
        $outputJSONString = '';

             // append to JSON string
            $outputJSONString .= "{\"sku\" : \"". $product['sku']. "\",\n";
            $outputJSONString .= "\"name\" : \"" . $product['name']. "\",\n";
            $outputJSONString .= "\"price\" : \"" . $product['price']. "\",\n";
            $outputJSONString .= "\"short_description\" : \"" . $product['short_description']. "\"},\n";
           
        return $outputJSONString;
    }
}


// CSVFormat has an input argument of an Array that contains info about a product
// it returns SKU, name, price, short description of the product
// in CSV format
class CSVFormat implements FormatInterface
{
    // initialize variable
    public $delimiter = ',' ;  // delimiter separate items in csv format
    public $newLine = "\r\n" ; // newline put 'enter' that specify new row in csv

    public function start()
    {
        $CSVStart = '';
    //  $CSVStart = "Content-type: text/csv \n";
    //  $CSVStart .= "Content-Disposition: attachment; filename=productInfo" . date('Y-m-d') . ".csv\r\n"; 
    //  $CSVStart .="Pragma: no-cache\n"; 
    //  $CSVStart .="Expires: 0 \n"; 
     $CSVStart .= "SKU" . $this->delimiter . "Name" . $this->delimiter . "Price" . $this->delimiter . "Short Description \r\n";
     return $CSVStart;
    }

    public function finish()
    {
        
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

  
        // if content has comma or double quote, put double quotes around, so excel won't count that as two separate entries
        foreach ( $outputArray as $output ) { 
            if ( preg_match( "/($this->delimiter | $enclosure)/", $output ) ) { 
              $cleanedOutputArray[] = $enclosure . str_replace($enclosure, $enclosure . $enclosure, $output) . $enclosure; 
            } else { 
              $cleanedOutputArray[] = $output; } 
            } 

        $outputCSVString = implode( $this->delimiter,  $cleanedOutputArray )."\r\n";
        return $outputCSVString;

    }
}


// XMLFormat has an input argument of an Array that contains info about a product
// it returns SKU, name, price, short description of the product
// in XML format
class XMLFormat implements FormatInterface
{

    public function start()
    {
        $XMLStart = "<?xml version=\"1.0\" encoding=\"UTF-8\"?> \n<PRODUCTS>\n";
        return $XMLStart;
    }

    public function finish()
    {
        $XMLEnd = "</PRODUCTS>\n";
        return $XMLEnd;
    }

    // get a product info as argument
    // return XML format of that product
    public function formatProduct( $product)
    {
        $outputXMLString = '';

             // append to XML string
             $outputXMLString .= "<PRODUCT>\n";
            $outputXMLString .= "<SKU>" . $product['sku']. "</SKU>\n";
            $outputXMLString .= "<NAME>" . $product['name']. "</NAME>\n";
            $outputXMLString .= "<PRICE>" . $product['price']. "</PRICE>\n";
            $outputXMLString .= "<SHORT_DESCRIPTION>" . $product['short_description']. "</SHORT_DESCRIPTION>\n";
            $outputXMLString .= "</PRODUCT>\n";
        return $outputXMLString;
    }
}


// FormatFactory take a formatKey and
// return an instance of Class that match formatKey
// returned Class has method of start, finish and formatProduct
// that returns product info configured in that format
class FormatFactory 
{
    public function create( $formatKey)
    {
        // create function return appropriate format Class depends on $formatKey
   
        if ($formatKey == 'csv') {
            $result = new CSVFormat();
        }
        if ($formatKey == 'xml') {
            $result = new XMLFormat();
        }
        if ($formatKey == 'json') {
            $result = new JSONFormat();
        }

        return $result;


    }
}