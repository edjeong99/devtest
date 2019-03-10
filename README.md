# this is a submission from Edward Jeong 
for the Razoyo's Developer Test as part of a job application.

Applicant : Edward Jeong
Submit Date : March 10th 2019
Company : Razoyo

The test asks applicant to implement PHP code to return appropriated formated product data from Magento's API.

## execution note
To keep the api key secure, I created "env.php" file.  This file register key value for environmental variable "RAZOYO_TEST_KEY"  To execute correctly this submission, you need to set value for "RAZOYO_TEST_KEY"


## Assumptions
From the instruction, I made following assumption to finish
    - The required " query data" are product data from product.info and product.list API.

    - I can add my codes to export.php as well as to dev-lib.php

    - Header row for CSV format are the titles of each column, such as sku and price.

# Performance Issue
My codes call product.info API for each product in synchronous way which takes long time to complete.  For future improvement, I would change it to be asynchronous if needed.



###############################################
Below is the Original Instruction from Razoyo
###############################################

# Razoyo Developer Test

The goal of this mini-project is to develop some PHP classes that allow Magento product information to be displayed in several different formats (CSV, XML, and JSON). You will be connecting to a Magento store that sells children's golf apparel: <https://www.shopjuniorgolf.com/>

If you feel like this exercise is over your head, you may be interested in our intern-to-full-time internship program. You may apply to that program here: <https://www.razoyo.com/developer-internship/>

## File overview
There are 2 external files that are included into this script.
* raz-lib.php is where we provided classes and interfaces (do NOT touch)
* dev-lib.php is where you should put any of your classes

## API Documentation
Magento API docs: <http://www.magentocommerce.com/api/soap/introduction.html>

## Requirements
Make sure that your code meets each of the following requirements.
1. Use the SOAP V1 API protocol to query data.
1. Script must be able to ouput records in CSV, XML, and JSON format.
1. Create a FormatFactory class that uses constants for the format codes (csv, xml, json).
1. Records must ONLY include the following fields: SKU, Name, Price, and Short Description
1. Must not use any of the built-in PHP encoding functions (i.e. json_encode, SimpleXML, etc.)
1. The CSV format must have a header row
1. Variables, functions, and classes should have descriptive names (in English).
1. Organize your code according to Object Oriented Programming best practices.

## Credentials
You will need an API key that should've been provided to you. The script works by pulling the password from an environment variable called **RAZOYO_TEST_KEY**. If you need the password please email me (see below).

## Need Help?
Feel free to email me if you have any questions William Byrne (wbyrne@razoyo.com).
