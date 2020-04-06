<?php
//JENS 

session_start();

include_once(__DIR__."/classes/User.php");

//We can get the user email that was used for login from the session variable 
$email = $_SESSION['user'];

//With the email we can get the userid using the function 

$user = new User();
$user = $user->getUserId2($email);
//the returned $user object is a an array. We need the ID field of said array, so with the line below, we grab the userID and put it into a var.
$id = $user['id'];
$user = new User();
    if ($user->UserIdExists($id)){
     
      //ID is existing in profile so goto index page 
      header("Location: index.php");
    } else {
      //ID doesn't exist in profile so fill in the needed data
        header('Location: insertProfile.php?R%26B=R%26B');
        
    }
