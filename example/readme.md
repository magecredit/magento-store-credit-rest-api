# Magento Store Credit REST API Example
This public repo contains an example of using the magecredit store credit API. 

## Usage Instructions
1. Pull down the repo (fork if you'd like).
2. Edit ```oauth_config.php``` with your own settings for the Magento installation which you are connecting to.
3. Access ```index.php``` in your browser and let it authenticate.
4. After successful authentication you will receive a list of the script functions
5. Click on the function you would like to test and follow the instructions. You will need to provide the customer ID in the URL parameters for some functions that need a customer context.

![How it looks like after you've authenticated](http://monosnap.com/image/MBpa6iWb2yM0TRZxaG5qHe3uAm6pRM.png)

## Functions
The available functions to test are through this example are:
* List all store credit balances in the store (```GET /customer/store_credit```)
* Get store credit balance of a given customer (```GET /customer/:customer_id/store_credit```)
* Get ALL store credit balance change history entries in the system (```GET /customer/store_credit/history```)
* Add to store credit balance of a given customer (```PUT /customer/:customer_id/store_credit```)
* Subtract from store credit balance of a given customer (```PUT /customer/:customer_id/store_credit```)
* Update store credit balance of a given customer (```PUT /customer/:customer_id/store_credit```)

