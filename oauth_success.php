<?php

// This script is a central entry point for the REST api example

require_once("oauth_config.php");
require_once("init_oauth.php");


// Init ouath client
$oauthClient = init_oauth($storeBaseUrl, $callbackUrl, $consumerKey, $consumerSecret);

// Output all the available functions. Quick n' dirty.
echo "
<pre>
If you're seeing this page, then you've been successfully authenticated with oauth. Congrats!

The available functions to test are:
    <a href='list_store_credit.php'>GET /customer/store_credit - List all store credit balances in the store</a>
    <a href='get_store_credit.php'>GET /customer/:customer_id/store_credit - Get store credit balance of a given customer</a>
    <a href='get_store_credit_history.php'>GET /customer/store_credit/history - Get ALL store credit balance change history entries in the system</a>

    <a href='add_store_credit.php'>PUT /customer/:customer_id/store_credit - Add to store credit balance of a given customer</a>
    <a href='subtract_store_credit.php'>PUT /customer/:customer_id/store_credit - Subtract from store credit balance of a given customer</a>
    <a href='update_store_credit.php'>PUT /customer/:customer_id/store_credit - Update store credit balance of a given customer</a>
</pre>
";