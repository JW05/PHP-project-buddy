<?php

include_once(__DIR__."/classes/User.php");


$user = new User();
$user->canLogout();
header("Location:login.php");

?>