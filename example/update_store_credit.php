<?php

// This script updates the store credit balance of a customer

require_once 'oauth_config.php';
require_once 'init_oauth.php';

$oauthClient = init_oauth($storeBaseUrl, $callbackUrl, $consumerKey, $consumerSecret);

$customerId = 127; // TODO enter the customer ID of the customer you would like to fetch store credit balance of.

$resourceUrl = "{$apiUrl}/customer/{$customerId}/store_credit";

// TODO update these values with whatever you'd like
$storeCreditData = json_encode(array(
    'website_id'            => 1,           // default website
    'amount'                => 7.89,        // $7.89
    'action'              => 'update',    // if this field is left out it will also update the store credit
));
$headers = array('Content-Type' => 'application/json');

try {
    $oauthClient->fetch($resourceUrl, $storeCreditData, OAUTH_HTTP_METHOD_PUT, $headers);

    header('Content-type: application/json');
    echo json_encode($oauthClient->getLastResponseInfo());

} catch (Exception $e) {
    die($e);
}
exit;
