<?php

require_once 'oauth_config.php';
require_once 'init_oauth.php';

$oauthClient = init_oauth($storeBaseUrl, $callbackUrl, $consumerKey, $consumerSecret);

$customerId = 127; // TODO enter the customer ID of the customer you would like to fetch store credit balance of.

$resourceUrl = "{$apiUrl}/customer/{$customerId}/store_credit";

$storeCreditData = json_encode(array(
    'website_id'            => 1,       // default website
    'amount'                => 1.23,    // $1.23
    'action'                => 'add',
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
