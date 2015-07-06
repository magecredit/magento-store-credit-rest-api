<?php

require_once("oauth_config.php");
require_once("init_oauth.php");

$oauth = init_oauth($storeBaseUrl, $callbackUrl, $consumerKey, $consumerSecret);

echo "
<pre>
If you're seeing this page, then you've been successfully authenticated with oauth. Congrats!

The available functions to test are:
    <a href='list_store_credit.php'>GET /customer/store_credit - List all store credit balances</a>
    <a href='get_store_credit.php'>GET /customer/:customer_id/store_credit - Get store credit balance of a given customer</a>
    <a href='add_store_credit.php'>POST /customer/:customer_id/store_credit - Add to store credit balance of a given customer</a>
    <a href='subtract_store_credit.php'>POST /customer/:customer_id/store_credit - Subtract from store credit balance of a given customer</a>
</pre>
";