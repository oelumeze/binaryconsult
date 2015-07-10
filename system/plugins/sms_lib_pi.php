<?php

		//function sendSMS($foneNumbers,$mySMSMsg,$msgType,$sender_id,array $param, $url)
		//{
		//	$request = "";
		//	
		//	//send message to all contacts
		//	$param["message"] = stripslashes($mySMSMsg); //this is the message that we want to send
		//	$param["destination"] = $foneNumbers; //these are the recipients of the message					
		//	$param["source"] = $sender_id;//this is our sender
		//	$param["type"] = $msgType;//we are only simulating a broadcast
		//	$param["dlr"] = 0;
		//						
		//	foreach($param as $key=>$val) //traverse through each member of the param array
		//	{
		//	  $request.= $key."=".urlencode($val); //we have to urlencode the values
		//	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		//	}
		//
		//	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request			
		//										
		//	$ch = curl_init(); //initialize curl handle
		//	curl_setopt($ch, CURLOPT_URL, $url); //set the url
		//	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //return as a variable
		//	curl_setopt($ch, CURLOPT_POST, 1); //set POST method
		//	curl_setopt($ch, CURLOPT_POSTFIELDS, $request); //set the POST variables
		//	$response = curl_exec($ch); //run the whole process and return the response
		//	curl_close($ch); //close the curl handle
		//	//print $response; //show the result onscreen for debugging	
		//}
		
		function sendSMS($foneNumbers,$mySMSMsg,$msgType,$sender_id,array $param, $url)
		{
			$request = "";
			
			//send message to all contacts
			$param["message"] = stripslashes($mySMSMsg); //this is the message that we want to send
			$param["mobile"] = $foneNumbers; //these are the recipients of the message					
			$param["sender"] = $sender_id;//this is our sender
			$param["type"] = $msgType;//we are only simulating a broadcast
								
			foreach($param as $key=>$val) //traverse through each member of the param array
			{
			  $request.= $key."=".urlencode($val); //we have to urlencode the values
			  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
			}
		
			$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request			
												
			$ch = curl_init(); //initialize curl handle
			curl_setopt($ch, CURLOPT_URL, $url); //set the url
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //return as a variable
			curl_setopt($ch, CURLOPT_POST, 1); //set POST method
			curl_setopt($ch, CURLOPT_POSTFIELDS, $request); //set the POST variables
			$response = curl_exec($ch); //run the whole process and return the response
			curl_close($ch); //close the curl handle
			//print $response; //show the result onscreen for debugging	
		}
		
		function sendSMSInternational($foneNumbers,$mySMSMsg,$msgType,$sender_id,array $param, $url)
		{
			$request = "";
			
		        $param["sender"] = $sender_id;//this is our sender
		        $param["message"] = stripslashes($mySMSMsg); //this is the message that we want to send					
		        $param["flash"] = $msgType;//we are only simulating a broadcast
		        $param["sendtime"] = "";
		        $param["listname"] = "friends";
		        $param["recipients"] = $foneNumbers; //these are the recipients of the message		
									
		        foreach($param as $key=>$val) //traverse through each member of the param array
		        {
				$request.= $key."=".urlencode($val); //we have to urlencode the values
				$request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		        }
				
		        $request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request			
				
		        postRequestData($url."?".$request);
			//print $response; //show the result onscreen for debugging	
		}	
		
		//function sendSMS_reseller($foneNumbers,$mySMSMsg,$msgType,$sender_id,array $param, $url)
		//{
		//	$request = "";
		//	
		//	//send message to all contacts
		//	$param["message"] = stripslashes($mySMSMsg); //this is the message that we want to send
		//	$param["mobile"] = $foneNumbers; //these are the recipients of the message					
		//	$param["sender"] = $sender_id;//this is our sender
		//	$param["type"] = $msgType;//we are only simulating a broadcast
		//						
		//	foreach($param as $key=>$val) //traverse through each member of the param array
		//	{
		//	  $request.= $key."=".urlencode($val); //we have to urlencode the values
		//	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		//	}
		//
		//	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request			
		//										
		//	$ch = curl_init(); //initialize curl handle
		//	curl_setopt($ch, CURLOPT_URL, $url); //set the url
		//	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //return as a variable
		//	curl_setopt($ch, CURLOPT_POST, 1); //set POST method
		//	curl_setopt($ch, CURLOPT_POSTFIELDS, $request); //set the POST variables
		//	$response = curl_exec($ch); //run the whole process and return the response
		//	curl_close($ch); //close the curl handle
		//	//print $response; //show the result onscreen for debugging	
		//}
		
		function sendSMS_reseller($foneNumbers,$mySMSMsg,$msgType,$sender_id,array $param, $url)
		{
			$request = "";
			
		        $param["sender"] = $sender_id;//this is our sender
		        $param["message"] = stripslashes($mySMSMsg); //this is the message that we want to send					
		        $param["flash"] = $msgType;//we are only simulating a broadcast
		        $param["sendtime"] = "";
		        $param["listname"] = "friends";
		        $param["recipients"] = $foneNumbers; //these are the recipients of the message		
									
		        foreach($param as $key=>$val) //traverse through each member of the param array
		        {
				$request.= $key."=".urlencode($val); //we have to urlencode the values
				$request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		        }
				
		        $request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request			
				
		        postRequestData($url."?".$request);
			//print $response; //show the result onscreen for debugging	
		}
		
		//function for international sms sending
		function postRequestData($url){
			
			$fp = @fopen($url, 'rb', false);
			if (!$fp) {
				//echo ("Problem with $url.<br> Url is inaccessible");
				return false;
			}
			stream_set_timeout($fp, 0, 250);
			$response = @stream_get_contents($fp);
			
			//if ($response === false) {
				//throw new Exception("Problem reading data from $url, $php_errormsg");
			//}
			return $response;
		}		

?>