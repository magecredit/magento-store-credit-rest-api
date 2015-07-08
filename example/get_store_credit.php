<?php

require_once("oauth_config.php");
require_once("init_oauth.php");


// Init ouath client
$oauthClient = init_oauth($storeBaseUrl, $callbackUrl, $consumerKey, $consumerSecret);

// Get customer ID from GET request for this script so we can pass it to the REST api
if (empty($_GET['customer_id'])) {
    die("Please specify ?customer_id=*ID* in the URL to use this script.");
}
$customerId = $_GET['customer_id'];

// Make the store credit call!
$resourceUrl = "{$apiUrl}/customer/{$customerId}/store_credit";
$oauthClient->fetch($resourceUrl, array(), 'GET', array('Content-Type' => 'application/json'));

// If you have multiple balances per website, you can pass the website ID like this:
//$oauthClient->fetch($resourceUrl, array('website_id' => 2), 'GET', array('Content-Type' => 'application/json'));

// Output the results
header('Content-type: application/json');
echo $oauthClient->getLastResponse();

exit;