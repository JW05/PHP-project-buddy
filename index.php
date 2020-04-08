<?php 
    include_once(__DIR__."/classes/User.php");
    session_start();

    try{
        $user = User::getCurrentUser($_SESSION['user']);
        $currentPreference = User::getCurrentPreference($user['id']);
    }catch(\Throwable $th){
       // header("Location: insertProfile.php");
    }


    //SEARCH BRYAN
    include_once(__DIR__ . "/classes/Search.php");

    $searchReturned = null;

    if(!empty($_POST['search'])){
        try {
            //code...
            $search = new Search();
            $search->setSearch($_POST['search']);
            $searchReturned = $search->getData();
        } catch (\Throwable $th) {
            //throw $th;
            $error = $th->getMessage();
        }
    }

    //END SEARCH
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPals</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>
<body>
    
    <a href="ProfilePage.php"> Profile </a>

    <a href="logout.php" class="btn-logout">logout</a>

    <!-- SEARCH BRYAN -->
    <div class="search-container">
        <form action="index.php" method="POST">
        <h1>Search for a buddy by interest or name here</h1>
        <input type="text" name="search" placeholder="name or interest">
        <button type="submit" name="search-action">Search</button>
        </form>
    </div>

    <?php
    if($searchReturned != null){
        foreach($searchReturned as $result){
    ?>
    <div>
        <h1><?php echo $result["firstname"] . " " . $result["lastname"]?></h1>
    </div>
    <?php }} ?>
    <!-- END SEARCH BRYAN -->

    
    <div class="side-bar">
        <div class="same-intrest">
            <h2>These people have the same interests</h2>
            <h3>Maybe get in touch</h3>

            <?php include_once(__DIR__."/buddySuggestion.php"); ?>
        
        </div>
    </div>

</body>
</html>