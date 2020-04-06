<?php 
    include_once(__DIR__."/classes/User.php");
    session_start();

    try{
        $user = User::getCurrentUser($_SESSION['user']);
        $currentPreference = User::getCurrentPreference($user['id']);
    }catch(\Throwable $th){
        header("Location: insertProfile.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPals</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <?php
        include_once(__DIR__."/nav.inc.php");
    ?>

    <div class="side-bar">
    <div class="same-intrest">
        <h2>These people have the same interests</h2>
        <h3>Maybe get in touch</h3>

        <?php include_once(__DIR__."/buddySuggestion.php"); ?>
    
    </div>
    </div>

</body>
</html>