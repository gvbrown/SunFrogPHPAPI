<?php 

	/* 	ORDER EXAMPLE 
		Orders are submitted to SunFrog through batches.  

		Batches can represent a single order, or group of multiple orders.  

	*/ 

	include 'sunfrogAPI.php';	// class file 
	include 'apiAuthKeys.php'; 	// auth information is set in this file

	/* 	INIT
		As always, we instantiate a new SunfrogAPI object, 
		then pass our auth keys to the init method.
	*/
		error_reporting(E_ALL);

	$sfapi = new sunfrogAPI(); 
	$sfapi -> init($initApiUserProfile = $apiUserProfile, $initApiUserEmail = $apiUserEmail, $initApiPassword = $apiPassword, $initApiKey = $apiKey, $initApiNumber = $apiNumber); 

	/* 	START BATCH 
		First, we create a new batch with the start batch endpoint.  
		This returns a batchid that we can use in subsequent calls. 

		If you have a batch open already, the current batchid will 
		be returned with this call, as well as a warning indicating
		that a batch is already open.  You can resuse the batchid 
		from this call to continue the open batch, even though 
		the startBatch call issued a warning.  
	*/

	$result = $sfapi -> startBatch();
	//var_dump($result); 
	$batchid = $result[0] -> BatchID;
	
	/* 	ADD ORDERS
		Next, for each order in the batch, we call the addOrder endpoint
		I've created an OrderItem object that can be assigned to an array for each
		order item in the batch.  You don't have to use this for 
		your implemententation, however, I find that it simplifies 
		creating orders in certain scenarios, such as dealing with multiple
		order items from a recordset within an order. 

		In a typical scenario, you would iterate over each item in an individual 
		order, create an object for that item, and append it to the order item array.   
	*/

	$orderItems=array(); 

	$arrLen = count($orderItems); 
	$orderItems[$arrLen] = new OrderItem();  
	$orderItems[$arrLen] -> create( $mockupid = '1362037609', $quantity = '1' , $size = 'L' ); 
	
	$arrLen = count($orderItems); 
	$orderItems[$arrLen] = new OrderItem();  
	$orderItems[$arrLen] -> create( $mockupid = '1362037609', $quantity = '2' , $size = 'XL' );

	$result = $sfapi -> addOrder(
        $batchid = 0, 
        $email = 'geoff@sunfrog.com', 
        $name = 'SunFrog Shirts', 
        $address1 = '1782 ORourke Blvd', 
        $address2 = '', 
        $city = 'Gaylord', 
        $state = 'MI', 
        $shippingZipCode='49735', 
        $country = 'United States', 
        $memo='', 
        $orderItems = $orderItems); 

	var_dump($result); 
	 
?> 