<?php

require("Connection.php");

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);
//  $input = $_GET;
$case = $input["name"];
switch($case){

     case 'client.slashCommand':
     
     require("sendmessage.php");
     break;

   

     case 'app.install':
        
        $userId=$input["userId"];
        $token=$input["token"];
        $query="INSERT INTO appuser (userID, token) VALUES ('".$userId."', '".$token."')";
        
        if(mysqli_query($connection,$query))
        {
           header("HTTP/1.1 200 OK");
        }
        mysqli_close();
      break;

     case 'app.uninstall':
        $userId=$input["userId"];
       $query="delete from appuser where userID='".$userId."'";
       $result= mysqli_query($connection,$query);
       if(result)
       {
            header("HTTP/1.1 200 OK");
       }
       mysqli_close($connection);
       break;

       

 }




?>