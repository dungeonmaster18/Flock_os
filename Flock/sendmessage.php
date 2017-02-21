<?php
//twitter api
		$consumerKey    = 'dDDzwLkSWotP9NWaB7aX1HIVA';
	$consumerSecret = '80JVYwbobHEWKNUMXMr3mUvkK11FMqPOdN4uRUCNNuWpv0AqiA';
	$oAuthToken     = '3165552811-JX6PxlTkza2S9Md6oKdeVEQwNeHFAC90vJ2h4kn';
	$oAuthSecret    = 'ld29kbbzZPJSClgvUdLbGjWZk98kFYN0KtKeaVwZQyXiw';
	require_once('twitterapi/twitteroauth.php');
    $dataexplode=explode(' ',$input["text"]);
	$text=$input["text"];
     $to=$input["chat"];
	 
     $query="select token from appuser where userID like '".$input["userId"]."'";
	//  $query="select token from users where userID like '".$input["userId"]."'";
	 $result=mysqli_query($connection,$query);
     
    if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
		     $from = $row["token"];
				    }
				}
				
    

	$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);	

    for($value=0;$value < sizeof($dataexplode);$value++)
    {

   
	$search = "".$dataexplode[$value]; // the tag to be searched
	
  $users = $tweet->get('search/tweets', array('q' => $search)); //returns a result object




	$json=json_decode($users,true);  // converts the result into json object
	$print="";
	if (sizeof($json["statuses"])== 0)
	{
	  $print.="Not tweet found for #".$search;
	  $url = 'https://api.flock.co/v1/chat.sendMessage';
	  
		$data = array("to" => "$to","text" =>"$print","token" => "$from");
		//print_r($data);
		$options = array(
							'http' => array(
							        'header'  => "Content-type: application/json",
							        'method'  => 'POST',
							        'content' => json_encode($data)
							    )
					);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
	}

 
$print="";
	for ($count=0 ;$count < 3 && $count < sizeof($json["statuses"]); $count++)
	{
	 $print.="User name: @".$json["statuses"][$count]["user"]["screen_name"]."\n" ; 
	  $print.= " tweet: ".$json["statuses"][$count]["text"]."\n";
	  $print.= "likes count ".$json["statuses"][$count]["favorite_count"]."\n";
	 $print.= "retweets count ".$json["statuses"][$count]["retweet_count"]."\n";

	  $url = 'https://api.flock.co/v1/chat.sendMessage';
	  
		$data = array("to" => "$to","text" =>"$print","token" => "$from");
		
		$options = array(
							'http' => array(
							        'header'  => "Content-type: application/json",
							        'method'  => 'POST',
							        'content' => json_encode($data)
							    )
					);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
        $print="";
	}
    }
?>