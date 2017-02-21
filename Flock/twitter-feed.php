<!DOCTYPE html>
<html>
<head>
    <title>Tweets</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.mini.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
              integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
              crossorigin="anonymous"></script>

</head>
<body>
<?php

require("twitterapi/TwitterAPIExchange.php");
    $search = "smartindiahackathon"; // the tag to be searched
    //twitter api
        $consumerKey    = 'dDDzwLkSWotP9NWaB7aX1HIVA';
    $consumerSecret = '80JVYwbobHEWKNUMXMr3mUvkK11FMqPOdN4uRUCNNuWpv0AqiA';
    $oAuthToken     = '3165552811-JX6PxlTkza2S9Md6oKdeVEQwNeHFAC90vJ2h4kn';
    $oAuthSecret    = 'ld29kbbzZPJSClgvUdLbGjWZk98kFYN0KtKeaVwZQyXiw';
    require_once('twitterapi/twitteroauth.php');
    $tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);    

  $users = $tweet->get('search/tweets', array('q' => $search)); //returns a result object




    $json=json_decode($users,true);  // converts the result into json object
    $print="";
    if (sizeof($json["statuses"])== 0)
    {
      $print.="Not tweet found for #".$search;
    }

 
$print="";
?>
<section class="container">
    <?php for ($count=0 ;$count < 3 && $count < sizeof($json["statuses"]); $count++)
    {

    ?>
    <div class="panel panel-default">

          <div class="panel-heading">
          <img src="<?php echo $json["statuses"][$count]["user"]["profile_background_image_url_https"]; ?>">

          </div>

          <div class="panel-body">
           <?php
                echo $json["statuses"][$count]["user"]["screen_name"]."</br>";
                echo $json["statuses"][$count]["text"]."</br>";
                echo $json["statuses"][$count]["favorite_count"];
           ?>
          </div>
   
    </div>
     <?php } 


     ?>


</section>
    
      <!-- $print.="User name: @".$json["statuses"][$count]["user"]["screen_name"]."\n" ;
      $print.= " tweet: ".$json["statuses"][$count]["text"]."\n";
      $print.= "likes count ".$json["statuses"][$count]["favorite_count"]."\n";
     $print.= "retweets count ".$json["statuses"][$count]["retweet_count"]."\n";
        $print="";
    }
echo "<pre>";
echo print_r($json);
echo "</pre>";

?> -->
<?php
    echo "<pre>";
    echo print_r($json);
    echo "</pre>";


?>

</body>
</html>