<?php

// This script gets the store credit history for a customer

require_once("oauth_config.php");
require_once("init_oauth.php");


// Init ouath client
$oauthClient = init_oauth($storeBaseUrl, $callbackUrl, $consumerKey, $consumerSecret);

// Get customer ID from GET request for this script so we can pass it to the REST api
if (empty($_GET['customer_id'])) {
    die("Please specify ?customer_id=*ID* in the URL to use this script.");
}
$customerId = $_GET['customer_id'];

// Make the call
$resourceUrl = "{$apiUrl}/customer/{$customerId}/store_credit/history";
$oauthClient->fetch($resourceUrl, array(), 'GET', array('Content-Type' => 'application/json'));

header('Content-type: application/json');
echo $oauthClient->getLastResponse();

exit;