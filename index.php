<?php 
    include_once(__DIR__."/classes/User.php");
    session_start();

    try{
        $user = User::getCurrentUser($_SESSION['user']);
        $currentPreference = User::getCurrentPreference($user['id']);
    }catch(\Throwable $th){
       header("Location: insertProfile.php");
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


// sent requests



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPals</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="css/Circle.css">
</head>
<body>
    <script src="js/Circle.js"></script>
    <?php
        include_once(__DIR__."/nav.inc.php");
    ?>

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
    <div class="side-bar">
        <div class="same-intrest">

            <h2>These people have liked you</h2>
            <?php include_once(__DIR__."/receivedRequests.php"); ?>

            
        
        </div>
    </div>
      <!-- including geregistreerde studenten + buddy overeenkomsten-->
    
      <?php    
           $AllStudents = User::getAllStudents();
    ?>

    <?php
           $AllBuddys = User::getAllBuddys();
    ?>



<ul class="display-container">
 <li class="note-display" data-note="7.50">
    <div class="circle">
      <svg width="84" height="84" class="circle__svg">
        <circle cx="41" cy="41" r="38" class="circle__progress circle__progress--path"></circle>
        <circle cx="41" cy="41" r="38" class="circle__progress circle__progress--fill"></circle>
      </svg>

      <div class="percent">
        <span class="percent__int">
        <?php foreach($AllStudents as $student): ?>
        <h2><?php echo $student; ?></h2>
        <?php endforeach; ?>
        </span>
       <!-- <span class="percent__dec">00</span> -->
      </div>
    </div>

    <span class="label">Students</span>
  </li>

 <li class="note-display" data-note="9.27">
    <div class="circle">
      <svg width="84" height="84" class="circle__svg">
        <circle cx="41" cy="41" r="38" class="circle__progress circle__progress--path"></circle>
        <circle cx="41" cy="41" r="38" class="circle__progress circle__progress--fill"></circle>
      </svg>

      <div class="percent">
        <span class="percent__int">
        <?php foreach($AllBuddys as $Buddy): ?>
        <h2><?php echo $Buddy; ?></h2>
        <?php endforeach; ?>
        </span>
      <!--  <span class="percent__dec">00</span> -->
      </div>
    </div>

    <span class="label">Buddys</span>
  </li>
</ul>

</body>
</html>