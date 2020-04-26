<?php
include_once(__DIR__."/classes/User.php");



if(isset($_GET['vKey']))
{
    $conn = Db::getConnection();
    $vKey = $_GET('vKey');
    $result = $conn->query("SELECT verified, vKey FROM users WHERE verified 0 AND ");


}
else
{
    die("something went wrong during the verification");
}
?>
