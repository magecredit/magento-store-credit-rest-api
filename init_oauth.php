<?php

/**
 * Example of retrieving the products list using Admin account via Magento REST API. OAuth authorization is used
 * Preconditions:
 * 1. Install php oauth extension
 * 2. If you were authorized as a Customer before this step, clear browser cookies for 'yourhost'
 * 3. Create at least one product in Magento
 * 4. Configure resource permissions for Admin REST user for retrieving all product data for Admin
 * 5. Create a Consumer.
 */
// $callbackUrl is a path to your file with OAuth authentication example for the Admin user

/**
 * Initializes the oauth client and authenticates if necessary.
 * @return OAuth_Client or null if unsuccessful (or needs auth)
 */
function init_oauth($storeBaseUrl, $callbackUrl, $consumerKey, $consumerSecret)
{
    $temporaryCredentialsRequestUrl = $storeBaseUrl.'/oauth/initiate?oauth_callback='.urlencode($callbackUrl);
    $adminAuthorizationUrl = $storeBaseUrl.'/admin/oAuth_authorize';
    $accessTokenRequestUrl = $storeBaseUrl.'/oauth/token';
    $apiUrl = $storeBaseUrl.'/api/rest';

    session_start();

    if (!isset($_SESSION['state'])) {
        $_SESSION['state'] = null;
    }
    if (!isset($_GET['oauth_token']) && isset($_SESSION['state']) && $_SESSION['state'] == 1) {
        $_SESSION['state'] = 0;
    }
    try {
        $authType = ($_SESSION['state'] == 2) ? OAUTH_AUTH_TYPE_AUTHORIZATION : OAUTH_AUTH_TYPE_URI;
        $oauthClient = new OAuth($consumerKey, $consumerSecret, OAUTH_SIG_METHOD_HMACSHA1, $authType);
        $oauthClient->enableDebug();

        if (!isset($_GET['oauth_token']) && !$_SESSION['state']) {
            $requestToken = $oauthClient->getRequestToken($temporaryCredentialsRequestUrl);
            $_SESSION['secret'] = $requestToken['oauth_token_secret'];
            $_SESSION['state'] = 1;
            header('Location: '.$adminAuthorizationUrl.'?oauth_token='.$requestToken['oauth_token']);
            exit;
        } elseif ($_SESSION['state'] == 1) {
            $oauthClient->setToken($_GET['oauth_token'], $_SESSION['secret']);
            $accessToken = $oauthClient->getAccessToken($accessTokenRequestUrl);
            $_SESSION['state'] = 2;
            $_SESSION['token'] = $accessToken['oauth_token'];
            $_SESSION['secret'] = $accessToken['oauth_token_secret'];
            header('Location: '.$callbackUrl);
            exit;
        } else {
            $oauthClient->setToken($_SESSION['token'], $_SESSION['secret']);

            return $oauthClient;
        }
    } catch (OAuthException $e) {
        print_r($e->getMessage());
        echo '<br/>';
        print_r($e->lastResponse);
    }

    return;
}
