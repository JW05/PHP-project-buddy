<?php 
    include_once(__DIR__."/classes/User.php");
    session_start();

    if(!isset($_SESSION['user'])){
      header("Location: login.php");
    }

    try{
        $user = User::getCurrentUser($_SESSION['user']);
        $currentPreference = User::getCurrentPreference($user['id']);
        $AllStudents = User::getAllStudents();
        $AllBuddys = User::getAllBuddys();
      }catch(\Throwable $th){
       header("Location: insertProfile.php");
    }


// sent requests

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPals</title>
    <?php include_once(__DIR__."/includes/scripts.html"); ?>
</head>
<body>
    <script src="js/Circle.js"></script>
    <?php
        include_once(__DIR__."/nav.inc.php");
    ?>
    <div class="bg-img"></div>

    <section>
      <div class="hero-img d-flex justify-content-center align-items-center"> 
          <ul class="display-container d-flex justify-content-center">
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

              <span class="label">Buddies</span>
            </li>
          </ul>
      </div>
    </section>
    <div class="container-fluid">
      <div class="row">
        <?php if($searchReturned != null): ?>
          <?php include('./includes/searchResults.inc.php');?>
        <?php else:?>
          <div class="col-md-8">
              <div class="same-intrest">
                  <h2>These people have the same interests</h2>
                  <h3>Maybe get in touch</h3>

                  <?php include_once(__DIR__."/buddySuggestion.php"); ?>
              
              </div>
          </div>
        <?php endif;?>
        <div class="col-md-4 sidebar">
            <div class="same-intrest">

                <h2>These people have liked you</h2>
                <h3>Would you accept?</h3>
                <?php include_once(__DIR__."/receivedRequests.php"); ?>
            
            </div>
        </div>
      </div>
    </div>
      <!-- including geregistreerde studenten + buddy overeenkomsten-->
    <script src="js/saveBuddy.js"></script>
</body>
</html>