<?php
include_once(__DIR__."/classes/User.php");


$allEmails = User::getEmails();

if(isset($_GET['vKey']))
{
 
    foreach($allEmails as $userEmail )
    {
        $salt = "dsjkirdçfàçfioijf6558ffieeéddfsze";
        $checkKey = md5($userEmail['email'].$salt);
        if($checkKey == $_GET['vkey'] )
        {
            User::updateVerification($userEmail['email']);
        }
    }
}
else
{
    die("something went wrong during the verification");
}
?>
