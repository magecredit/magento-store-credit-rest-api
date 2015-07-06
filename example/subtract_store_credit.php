<?php

// This script subtracts store credit from the customer's store credit balance

require_once 'oauth_config.php';
require_once 'init_oauth.php';

// Init ouath client
$oauthClient = init_oauth($storeBaseUrl, $callbackUrl, $consumerKey, $consumerSecret);

// Get customer ID from GET request for this script so we can pass it to the REST api
if (empty($_GET['customer_id'])) {
    die("Please specify ?customer_id=*ID* in the URL to use this script.");
}
$customerId = $_GET['customer_id'];

$resourceUrl = "{$apiUrl}/customer/{$customerId}/store_credit";

// TODO update these numbers with the values you want.
$storeCreditData = json_encode(array(
    'website_id'            => 1,           // default website
    'amount'                => 1.23,        // $1.23
    'subtract'              => 'subtract',  // subtract from the balance
));
$headers = array('Content-Type' => 'application/json');

try {
    $oauthClient->fetch($resourceUrl, $storeCreditData, OAUTH_HTTP_METHOD_PUT, $headers);

    // header('Content-type: application/json');
    echo $oauthClient->getLastResponse();

} catch (Exception $e) {
    die($e);
}
exit;
