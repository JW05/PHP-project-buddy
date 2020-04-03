<?php
include_once(__DIR__."/classes/User.php");
$id = 2;
$user = new User();
/*
$UserIds = User::UserIdExists($id);
  */  

    if ($user->UserIdExists($id)){
        echo "Username is available. goto main page";
    } else {
        header('Location: http://localhost/PHP-project-buddy/PHP-project-buddy/UpdateProfile.php?R%26B=R%26B');
        
    }
    ?>