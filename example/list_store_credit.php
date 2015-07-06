<?php

// Lists all store credit balances for all customers in Magento

require_once("oauth_config.php");
require_once("init_oauth.php");


// Init ouath client
$oauthClient = init_oauth($storeBaseUrl, $callbackUrl, $consumerKey, $consumerSecret);

// Make the call
$resourceUrl = "{$apiUrl}/customer/store_credit";
$oauthClient->fetch($resourceUrl, array(), 'GET', array('Content-Type' => 'application/json'));

header('Content-type: application/json');
echo $oauthClient->getLastResponse();

exit;