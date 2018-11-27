<?php
	/* 	CLEAR BATCH EXAMPLE  
		In some cases, you may need to cancel a batch
		mid-processing.  Clear batch will close
		the current batch, remove all orders, and 
		make the API available to create a new batch.  
	*/

	include 'sunfrogAPI.php';	// class file 
	include 'apiAuthKeys.php'; 	// auth information is set in this file

	/* 	INIT
		As always, we instantiate a new SunfrogAPI object, 
		then pass our auth keys to the init method.
	*/

	$obj = new sunfrogAPI(); 
	$obj -> init($initApiUserProfile = $apiUserProfile, $initApiUserEmail = $apiUserEmail, $initApiPassword = $apiPassword, $initApiKey = $apiKey, $initApiNumber = $apiNumber); 

	/* 	GET THE CURRENT BATCHID
		We can use startBatch or checkBatch calls to validate 
		the status of a batch, and to obtain the batchid 
		of the current batch. 
	*/

	$result = $obj -> startBatch();
	var_dump($result); 
	$batchid = $result[0] -> BatchID;

	/* clear the batch using the current batchid */ 
	$clearresult = $obj -> clearBatch($batchid);

	var_dump($clearresult); 

?> 