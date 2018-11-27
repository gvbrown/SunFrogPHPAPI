<?php
/* 
    SUNFROG API FOR PHP 

    Copyright (c) 2018, Geoffrey Brown

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

        http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.
    
*/
class SunfrogAPI {

    public $apiUserProfile; 
    public $apiUserEmail; 
    public $apiPassword; 
    public $apiKey; 
    public $apiNumber;
    public $verifyPeer = false; 

    public function init(string $initApiUserProfile, string $initApiUserEmail, string $initApiPassword, string $initApiKey, string $initApiNumber) {
        /* INIT */ 
        $this->apiUserProfile = $initApiUserProfile;
        $this->apiUserEmail = $initApiUserEmail; 
        $this->apiPassword = $initApiPassword; 
        $this->apiKey = $initApiKey; 
        $this->apiNumber = $initApiNumber; 

    }

    public function sendAPICall(string $endpoint, array $payload) {
        /* Generic method to call api */
 
        $ch = curl_init();  

        $conString = "$this->apiNumber:$this->apiKey"; 

        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_USERPWD, $conString);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this -> verifyPeer);

        $data = $payload; 
        
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        
        $result = curl_exec($ch);
        $result = json_decode($result);   
        curl_close($ch);
        return $result; 
    }    

    public function startBatch() {
        /* START BATCH METHOD */
        $targetURL = 'https://api.sunfrogshirts.com/v1/Orders/' . $this -> apiUserProfile . '/startBatch.json';
        $data = [
            "Iagree" => "1", 
            "password" => $this -> apiPassword,
            "username" => $this -> apiUserEmail
        ];
        
        $result = $this -> sendAPICall($endpoint = $targetURL, $payload = $data); 
        return $result; 
    }    

    public function clearBatch(string $batchid) {
        /* CLEAR BATCH METHOD */
        $targetURL = 'https://api.sunfrogshirts.com/v1/Orders/' . $this -> apiUserProfile . '/clearBatch.json';
      
        $data = [
            "Iagree" => "1", 
            "password" => $this -> apiPassword,
            "username" => $this -> apiUserEmail, 
            "password" => $this -> apiPassword, 
            "batchid" => $batchid
        ];
        
        $result = $this -> sendAPICall($endpoint = $targetURL, $payload = $data); 
        return $result; 
    }   

    public function endBatch(string $batchid) {
        /* END BATCH METHOD */
        $targetURL = 'https://api.sunfrogshirts.com/v1/Orders/' . $this -> apiUserProfile . '/endBatch.json';
      
        $data = [
            "Iagree" => "1", 
            "password" => $this -> apiPassword,
            "username" => $this -> apiUserEmail, 
            "password" => $this -> apiPassword, 
            "batchid" => $batchid, 
            "transactionid" => 'internal'
        ];
        
        $result = $this -> sendAPICall($endpoint = $targetURL, $payload = $data); 
        return $result; 
    }   

    public function finalizeBatch(string $batchid) {
        /* FINALIZE BATCH METHOD */
        $targetURL = 'https://api.sunfrogshirts.com/v1/Orders/' . $this -> apiUserProfile . '/finalizeBatch.json';
      
        $data = [
            "Iagree" => "1", 
            "password" => $this -> apiPassword,
            "username" => $this -> apiUserEmail, 
            "password" => $this -> apiPassword, 
            "batchid" => $batchid
        ];
        
        $result = $this -> sendAPICall($endpoint = $targetURL, $payload = $data); 
        return $result; 
    }          

    public function getOrderStatus(string $orderid, string $email) {
        /* FINALIZE BATCH METHOD */
        $targetURL = 'https://api.sunfrogshirts.com/v1/Orders/Tracking/locate.json';
      
        $data = [
            "Iagree" => "1", 
            "password" => $this -> apiPassword,
            "username" => $this -> apiUserEmail, 
            "password" => $this -> apiPassword, 
            "orderid" => $orderid, 
            "email" => $email 
        ];
        
        $result = $this -> sendAPICall($endpoint = $targetURL, $payload = $data); 
        return $result; 
    }
    public function createSignup(string $name, string $email, string $password, string $company, string $address, string $city, string $state, string $zipcode, string $country) {
        /* CREATE A NEW SUB ACCOUNT (SIGNUP) */ 
        $targetURL = 'https://api.sunfrogshirts.com/v1/Signup/addSignup.json'; 

        $data = [
            "Iagree" => "1", 
            "password" => $this -> apiPassword,
            "username" => $this -> apiUserEmail, 
            "password" => $this -> apiPassword, 
            "name" => $name,
            "email" => $email,
            "Iagree" => "1", 
            "password" => $password,
            "company" => $company,
            "address" => $address,
            "city" => $city,
            "state" => $state,
            "zipcode" => $zipcode,
            "country" => $country     
        ];

        $result = $this -> sendAPICall($endpoint = $targetURL, $payload = $data); 
        return $result; 
    }

    public function createMockup(MockupObj $mockupObject) {
        /* CREATE MOCKUP METHOD */
        $targetURL = 'https://api.sunfrogshirts.com/v1/mockups/' . $this -> apiUserProfile . '/addMockup.json';
            
        $data = [
            "Iagree" => "1", 
            "password" => $this -> apiPassword,
            "username" => $this -> apiUserEmail, 
            "password" => $this -> apiPassword, 
            "aiFile" => $mockupObject -> aiFile, 
            "aiFileBack" => $mockupObject -> aiFileBack, 
            "imageFile" => $mockupObject -> imageFile, 
            "imageFileBack" => $mockupObject -> imageFileBack, 
            "mockupType" => $mockupObject -> mockupType, 
            "color" => $mockupObject -> color
        ];
        
        $result = $this -> sendAPICall($endpoint = $targetURL, $payload = $data); 
        return $result; 
    }

    public function createMockupVariant(MockupObj $mockupObject) {
        /* CREATE MOCKUP VARIANT METHOD */
        $targetURL = 'https://api.sunfrogshirts.com/v1/mockups/' . $this -> apiUserProfile . '/addColor.json';
            
        $data = [
            "Iagree" => "1", 
            "password" => $this -> apiPassword,
            "username" => $this -> apiUserEmail, 
            "password" => $this -> apiPassword, 
            "aiFile" => $mockupObject -> aiFile, 
            "aiFileBack" => $mockupObject -> aiFileBack, 
            "imageFile" => $mockupObject -> imageFile, 
            "imageFileBack" => $mockupObject -> imageFileBack, 
            "mockupType" => $mockupObject -> mockupType, 
            "color" => $mockupObject -> color, 
            "group" => $mockupObject -> mockupGroupID
        ];
        
        $result = $this -> sendAPICall($endpoint = $targetURL, $payload = $data); 
        return $result; 
    }

    public function addOrder(
        string $batchid,
        string $email, 
        string $name, 
        string $address1, 
        string $address2, 
        string $city, 
        string $state, 
        string $shippingZipCode, 
        string $country, 
        string $memo, 
        array $orderItems ) {
        
        /* ADD ORDER METHOD */ 
        $targetURL = 'https://api.sunfrogshirts.com/v1/orders/' . $this -> apiUserProfile . '/addOrder.json';
        
        $data= [
            "Iagree" => "1", 
            "password" => $this -> apiPassword,
            "username" => $this -> apiUserEmail, 
            "password" => $this -> apiPassword, 
            "batchid" => $batchid,
            "email" => $email,
            "name" => $name,
            "address1" => $address1,
            "address2" => $address2,
            "city" => $city,
            "state" => $state,
            "shippingZipCode" => $shippingZipCode,
            "country" => $country,
            "memo" => $memo
        ];

        // iterate over the orderItems and create the necessary form fields
        foreach ($orderItems as $key => $value) {
            $thisItemInt = $key + 1; 
            $mField = "m_".$thisItemInt; 
            $$mField = $orderItems[$key] -> mockupID; 
            $mValue = ${$mField};
            $data[$mField] = $mValue;    

            $sField = "size_".$thisItemInt; 
            $$sField = $orderItems[$key] -> size; 
            $sValue = ${$sField};  
            $data[$sField] = $sValue;    

            $qField = "quantity_".$thisItemInt; 
            $$qField = $orderItems[$key] -> quantity; 
            $qValue = ${$qField};  
            $data[$qField] = $qValue;    
        }

        $result = $this -> sendAPICall($endpoint = $targetURL, $payload = $data); 
        return $result; 
    }

}

/* ****************** HELPER OBJECTS ****************** */ 

class MockupObj {
    /* MOCKUP OBJECT CLASS */ 
    public $mockupGroupID; 
    public $color; 
    public $mockupType; 
    public $imageFile; 
    public $aiFile; 
    public $imageFileBack; 
    public $aiFileBack; 

    public function create(string $mockupGroupID, string $color, string $mockupType, string $imageFile, string $aiFile, string $imageFileBack, string $aiFileBack) {
        $this -> mockupGroupID = $mockupGroupID; 
        $this -> color = $color; 
        $this -> mockupType = $mockupType; 
        $this -> imageFile = $imageFile; 
        $this -> aiFile = $aiFile; 
        $this -> imageFileBack = $imageFileBack; 
        $this -> aiFileBack = $aiFileBack; 

        return $this; 
    }
}

class OrderItem {
    /* ORDER ITEM CLASS */ 
    public $mockupID; 
    public $quantity; 
    public $size; 

    public function create(string $mockupID, string $quantity, string $size) {
        $this -> mockupID = $mockupID; 
        $this -> quantity = $quantity; 
        $this -> size = $size; 

        return $this; 
    }
}

?>
