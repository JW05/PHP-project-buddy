<?php 
    include_once(__DIR__."/classes/User.php");
    session_start();

    try{
        $user = User::getCurrentUser($_SESSION['user']);
        $currentPreference = User::getCurrentPreference($user['id']);
    }catch(\Throwable $th){
        include_once(__DIR__."/insertProfile.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPals</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <a href="ProfilePage.php"> Profile </a>

    <a href="logout.php" class="btn-logout">logout</a>

    <div class="side-bar">
    <div class="same-intrest">
        <h2>These people have the same intrest</h2>
        <h3>Maybe get in touch</h3>

        <!--   code gedeeldte feature 7 -->
    
    </div>
    </div>

</body>
</html>