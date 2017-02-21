<?php
require('TwitterAPIExchange.php');
//twitter api
$consumerKey    = 'dDDzwLkSWotP9NWaB7aX1HIVA';
$consumerSecret = '80JVYwbobHEWKNUMXMr3mUvkK11FMqPOdN4uRUCNNuWpv0AqiA';
$oAuthToken     = '3165552811-JX6PxlTkza2S9Md6oKdeVEQwNeHFAC90vJ2h4kn';
$oAuthSecret    = 'ld29kbbzZPJSClgvUdLbGjWZk98kFYN0KtKeaVwZQyXiw';
require_once('twitteroauth.php');
$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);


$search = "smartindiahackathon"; // the tag to be searched
	
  $users = $tweet->get('search/tweets', array('q' => $search)); //returns a result object




$json=json_decode($users,true);  // converts the result into json object

$count=0;

if (sizeof($json["statuses"])== 0)
{
  echo "Not tweet found for #".$search;
  exit;
}

 

for ($count=0 ;$count < 3 && $count < sizeof($json["statuses"]); $count++)
{
 echo "User name: @".$json["statuses"][$count]["user"]["screen_name"] ; 
 echo " tweet: ".$json["statuses"][$count]["text"]."</br>";
 echo "likes count ".$json["statuses"][$count]["favorite_count"]."</br>";
 echo "retweets count ".$json["statuses"][$count]["retweet_count"]."</br>";

}
