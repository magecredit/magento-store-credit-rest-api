<?php

require_once("oauth_config.php");
require_once("init_oauth.php");


$oauthClient = init_oauth($storeBaseUrl, $callbackUrl, $consumerKey, $consumerSecret);

$customerId = 135; // TODO enter the customer ID of the customer you would like to fetch store credit balance of.

$resourceUrl = "{$apiUrl}/customer/{$customerId}/store_credit";
$oauthClient->fetch($resourceUrl, array(), 'GET', array('Content-Type' => 'application/json'));

header('Content-type: application/json');
echo $oauthClient->getLastResponse();

exit;