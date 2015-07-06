<?php

// This is the consumer key/secret you generted in the Magento admin.
$consumerKey = '533afdb044b73dc292e622a6f1932f5c'; // TODO: update with yours
$consumerSecret = '1a9728793bfbda2a40b8420b641f1271'; // TODO: update with yours

// This is the path  to this script - to redirect to after the Oauth request is approved.
$callbackUrl = 'http://local.dev/magecredit/restapi/oauth_success.php'; // TODO: update with yours

// This is the store's base URL
$storeBaseUrl = 'http://mage.dev/1.9.1.0/'; // TODO: update with yours
$apiUrl = $storeBaseUrl . "api/rest/";