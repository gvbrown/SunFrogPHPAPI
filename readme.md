PHP Library For SunFrog API 

## Requirements

* PHP 5 or later

## Getting started

Create an account and obtain your API keys at https://manager.sunfrog.com/
Your authentication details can be entered in your ./apiAuthKeys.php file 
when using these examples (example file included). 

## Documentation

Detailed API documentation can be found at https://manager.sunfrog.com/ 

### Products, sizes and colors
Products that you have access to are available in your API profile in the SunFrog Manager.  These can vary depending on your account configuration.  Types and colors can be passed to this library as either the string representation of the name (black), or the numeric representation of the name (20). 

### Methods in this Library: 

**init( apiUserProfile, apiUserEmail, apiPassword, apiKey, apiNumber)** - used to initialize the auth settings prior to making API Calls. 

**sendAPICall( endpoint, payload )** - generic function to make calls to the SunFrog API. 

**startBatch()** - Opens a new batch for placing orders. 

**clearBatch( batchid )** - Clears (erases and closes) an existing open batch. 

**finalizeBatch( batchid)** - Signals that the batch is ready to be closed, and finalizes pricing. 

**endBatch( batchid )** - Ends a batch and sends included orders to production. 

**getOrderStatus( orderid, email )** - Gets the current production status of an order and shipping / tracking information if available. 

**createSignup( name, email, password, company, address, city, state, zipcode, country)** - creates a new sub account for interacting with the API.  

**createMockup( mockupObj )** - Creates a new mockup (group) under which product variants can be added. 

**createMockupVariant( MockupObj )** - creates a variant for an existing product group. 

**addOrder(batchid, email, name, address1, address2, city, state, shippingZipCode, country, memo, orderItems)** - Adds an order and order items to an open batch. 

### Helper Objects
**MockupObj( mockupGroupID, color, mockupType, imageFile, aiFile, imageFileBack, aiFileBack )** - Object that represents a mockup or mockup variant.  These represent a single object which is passed to the addMockup or addMockupVariant methods. 

**OrderItem( mockupID, quantity, size )** - Object that represents a line item in an order. These are stored an in array and passed to addOrder. 

## License

SunFrogAPIPHP is licensed under the Apache License, Version 2.0
http://www.apache.org/licenses/LICENSE-2.0
