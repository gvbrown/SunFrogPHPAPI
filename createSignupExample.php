<?php 
	/* CREATE SIGNUP EXAMPLE
		API Accouunts require at least one signup (sub account). 

		Signups allow you to provide services for multiple, separate 
		users, under your API account.  An example usage would be if 
		you are providing printing services for multiple stores
		which need to be tracked and handled separately.

		If you are the only user accessing the API, you will still 
		need to create one account to authenticate to the API.  

		This should be the first step, once you have your API keys, 
		as most calls require a profileid, which is returned from the signup 
		call. 
	*/

	include 'SunfrogAPI.php';	// class file 
	include 'apiAuthKeys.php'; 	// auth information is set in this file

	// create the sunfrog api object and set the init params using the values in the apiAuthKeys.php file 
	$sfapi = new SunfrogAPI(); 
	$sfapi -> init($initApiUserProfile = $apiUserProfile, $initApiUserEmail = $apiUserEmail, $initApiPassword = $apiPassword, $initApiKey = $apiKey, $initApiNumber = $apiNumber); 
	
	$sfapi -> createSignup(
		$name = 'Geoff B', 
		$email = 'geoff@sunfrog.com', 
		$password = '123456', 
		$company = 'SunFrog Shirts', 
		$address = '123 Some Street', 
		$city = 'Gaylord', 
		$state = 'MI', 
		$zipcode = '49616', 
		$country = 'USA'
	); 

	/* Create signup will return the sent username / password, 
	as well as the users profileid.  

	The profileID is used in certain calls to the api.  You will  need
	to include this in your init call to the Sunfrog API class. 
	*/ 

	var_dump($sfapi); 

?> 