<?php 

	/* 	CREATE MOCKUP EXAMPLE 
		
		"Mockups" represent a product variant, and are organized in groups.  

		A group of mockups share the same common artwork, but will be applied to 
		different product types, styles and colors.  

		A group is created by calling the createMockup() method.  This returns the groupid 
		for that group, as well as a mockupid (m) for the initial variant.  

		A variation for a group is created by calling createMockupVariant(), which requires
		the groupid for the original group, and will return a mockupid (m), which is used 
		when placing orders.  

	*/ 

	include 'SunfrogAPI.php';	// class file 
	include 'apiAuthKeys.php'; 	// auth information is set in this file

	// create the sunfrog api object and set the init params using the values in the apiAuthKeys.php file 
	$sfapi = new SunfrogAPI(); 
	$sfapi -> init($initApiUserProfile = $apiUserProfile, $initApiUserEmail = $apiUserEmail, $initApiPassword = $apiPassword, $initApiKey = $apiKey, $initApiNumber = $apiNumber); 
	
	// create a generic mockup object and assign properties
	$mockupObj = new MockupObj(); 
	$mockupObj -> create(
		$mockupGroupID = '', 
		$color = 'red', 
		$mockupType = '8', 
		$imageFile = 'https://api.sunfrogshirts.com/sunfrogshirt.jpg', 
		$aiFile = 'https://api.sunfrogshirts.com/sunfroglogo.png', 
		$imageFileBack = '', 
		$aiFileBack = ''); 

	// send the MockupObject to the SunFrog API (uses /mockups/addmockup endpoint) 
	$createMockupResponse = $sfapi -> createMockup($mockupObj); 
	var_dump($createMockupResponse); 

	/* 
	** Create Mockup Response ** 

	GROUP & M PARAMETERS
	The GROUP parameter is useful for creating variations based on a design.  
	Variants are created as a child of the group. 

	The M parameter is a reference to the created variant, which is used 
	when creating orders. Whenever possible, store these values in relation
	to your own designs and variants, as they can be reused in subsequent 
	orders for the same design and style. 

	CREATING VARIANTS 
	To create variants, we reference the groupid from the response, 
	and add different type and color options.  

	Colors and types can be passed as numeric values or strings.  The 
	supported options vary by account.  Review the documentation 
	for a list of supported products, sizes and colors for you 
	API account.  

	*/ 

	// get the value of the groupid for the initial produ
	$newMockupGroupID = $createMockupResponse[0] -> Group; 
	
	// create a new MockupObject using the new groupid and the variant values
	$mockupObjVariant = new MockupObj(); 

	$mockupObjVariant -> create(
		$mockupGroupID = $newMockupGroupID, 
		$color = 'black', 
		$mockupType = '8', 
		$imageFile = 'https://api.sunfrogshirts.com/sunfrogshirt.jpg', 
		$aiFile = 'https://api.sunfrogshirts.com/sunfroglogo.png', 
		$imageFileBack = '', 
		$aiFileBack = '');

	$mockupVariantResponse = $sfapi -> createMockupVariant($mockupObjVariant); 

	/* 
		Add Color Response 
		Similar to the addMockup response, the addColor endpoint will return the parameter "m", which 
		is used to reference this particular variant in the future. 

	*/
	var_dump($mockupVariantResponse); 

?> 