<?php

require_once("oauth_config.php");
require_once("init_oauth.php");


$oauthClient = init_oauth($storeBaseUrl, $callbackUrl, $consumerKey, $consumerSecret);

$resourceUrl = "{$apiUrl}/customer/store_credit";
$oauthClient->fetch($resourceUrl, array(), 'GET', array('Content-Type' => 'application/json'));

header('Content-type: application/json');
echo $oauthClient->getLastResponse();

exit;