<?php

/**
 * Your code goes here
 * init
 */

 // set environment variable
putenv("RAZOYO_TEST_KEY=ku%64TeYMo5mAIFj8e");


$msg = "Hi Debug Console 2";
echo $msg;

/*

// import ...  

class SoapClient
{
    public function __construct($api_URL) {
        $this->api_URL = $api_URL;
        $this->apiUser = $apiUser;
        $this->apiKey = getenv('RAZOYO_TEST_KEY');
    }

    public function getDateFromAPI(){
        $session = $this->login($this->apiUser, $this->apiKey);
    }

    public function printOut(){
        echo $this->apiUser;
    }
}
*/