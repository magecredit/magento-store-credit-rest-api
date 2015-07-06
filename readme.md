# Magento Store Credit REST API
This repository contains an example set of scripts that can be used with the Magecredit store credit extension for Magento to retrieve and update store credit balances of customers in the Magento eCommerce platform. 

### Requirements
1. You must have a version of Magento that supports the REST API. Magento 1.7+ is recommended.
2. You must have Magecredit installed.
   If you do not already have Magecredit, please visit [Magecredit.com](http://www.magecredit.com) to get it and read more about it.

### REST API Magento Setup
Magecredit comes with the ability to restrict/enable read/write permissions to
different Magento REST users. Make sure the user you are logging in with and approving for the REST oauth process has permission to access and read/write to the Magento store credit fields.

1. Ensure that the REST API role is allowed
![Magento Store Credit REST Role Permissions](http://monosnap.com/image/MXV2Z4w14fxZpsFkSTNBnvNvyWe8Y9.png)
2. Ensure that the REST API store credit attributes are enabled for the user you're authenticating with in Magento:
![Magento Store Credit REST API ACL information](http://monosnap.com/image/EtZJnkgroo8EPrd4oOPnQo7KofVM7k.png)
3. Authenticate and use the REST API just like you would with any other Magento REST API endpoint for your store.

### Using the Example PHP Code
Please see the readme.md in the Example folder for usage instructions of the example.


-----

## Store Credit API Specification

Notes:
* If base_currency_code is empty, assume base store currency
* Website ID #1 is the default Magento website.
* customer_id refers to the customer entity ID.

### Get all store credit balances
* URL: /customer/store_credit
* Method: GET

#### Example Request
* Request URL: /customer/store_credit
* Response: 
  
  ```
  [
    {
        "balance_id": "1",
        "customer_id": "136",
        "website_id": "1",
        "amount": "0.0000",
        "base_currency_code": null
    },
    {
        "balance_id": "2",
        "customer_id": "135",
        "website_id": "1",
        "amount": "1000.0000",
        "base_currency_code": null
    },
    {
        "balance_id": "3",
        "customer_id": "127",
        "website_id": "1",
        "amount": "1.2300",
        "base_currency_code": null
    }
  ]
  ```

### Get a customer's store credit balance
* URL: /customer/**:customer_id**/store_credit
* Method: GET

#### Example Request
* Request URL: /customer/127/store_credit
* Response:

    ```
    {
        "balance_id": "3",
        "customer_id": "127",
        "website_id": "1",
        "amount": "1.2300",
        "base_currency_code": null
    }
    ```

### Get a customer's store credit balance change history
* URL: /customer/**:customer_id**/store_credit/history
* Method: GET
* 'action' is the action code for what was performed (1=UPDATED, 2=CREATED, 3=USED, 4=REFUNDED, 5=REVERTED, 6=IMPORTED)
* 'is_customer_notified' tells you if the customer was notified via email automatically when the balance changed.
* 'balance_amount' is the balance *after* the change
* 'balance_delta' is the change. Negative is a reduction in store credit, positive is an increase in store credit.

#### Example Request
* Request URL: /customer/135/store_credit/history
* Response: 

    ```
    [
        {
            "history_id": "5",
            "balance_id": "2",
            "updated_at": "2015-02-05 00:58:02",
            "action": "3",
            "balance_amount": "0.0000",
            "balance_delta": "-123.0000",
            "additional_info": "Order #145000012",
            "is_customer_notified": "0"
        },
        {
            "history_id": "4",
            "balance_id": "2",
            "updated_at": "2015-02-05 00:57:30",
            "action": "1",
            "balance_amount": "123.0000",
            "balance_delta": "123.0000",
            "additional_info": "By admin: admin.",
            "is_customer_notified": "0"
        },
        {
            "history_id": "3",
            "balance_id": "2",
            "updated_at": "2015-02-04 23:06:25",
            "action": "3",
            "balance_amount": "0.0000",
            "balance_delta": "-5.0000",
            "additional_info": "Order #145000011",
            "is_customer_notified": "0"
        },
        {
            "history_id": "2",
            "balance_id": "2",
            "updated_at": "2015-02-04 18:44:09",
            "action": "2",
            "balance_amount": "5.0000",
            "balance_delta": "5.0000",
            "additional_info": "By admin: admin.",
            "is_customer_notified": "0"
        }
    ]
    ```

### Update a customer's store credit balance
* URL: /customer/**:customer_id**/store_credit
* Method: PUT
* 'amount' is the amount you want to add/subtract/update to.
* 'action' is the action you would like to perform with the amount. You can 'add', 'subtract' or 'update' (default it update)

#### Example Request 1 - Update store credit balance
  * This sets the customer's store credit balance to 7.89
  * Request URL: /customer/127/store_credit
  * Request Data 
    ```
    {
        'website_id' : 1,       
        'amount'     : 7.89,    
        'action'   : 'update',
    }
    ```
  * Response: 200 Success OR a browser error will be thrown.

#### Example Request 2 - subtract from store credit balance
  * This subtracts 1.23 from the store credit balance of the customer
  * Request URL: /customer/127/store_credit
  * Request Data 
    ```
    {
        'website_id' : 1,       
        'amount'     : 1.23,    
        'action'   : 'subtract',
    }
    ```
  * Response: 200 Success OR a browser error will be thrown.

#### Example Request 3 - add to customer's store credit balance
  * This adds 3.21 to the store credit balance of the customer
  * Request URL: /customer/127/store_credit
  * Request Data 
    ```
    {
        'website_id' : 1,       
        'amount'     : 3.21,    
        'action'   : 'add',
    }
    ```
  * Response: 200 Success OR a browser error will be thrown.
