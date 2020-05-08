<?php 
    include_once(__DIR__."/classes/User.php");
    session_start();

    if(!isset($_SESSION['user'])){
      header("Location: login.php");
    }

    try{
        $user = User::getCurrentUser($_SESSION['user']);
        $currentPreference = User::getCurrentPreference($user['id']);
    }catch(\Throwable $th){
       header("Location: insertProfile.php");
    }


    //SEARCH BRYAN
    include_once(__DIR__ . "/classes/Search.php");

    $searchReturned = null;

    if(!empty($_POST['name']) || !empty($_POST['preferences']) || !empty($_POST['genres'])){
        try {
            //code...
            $search = new Search();
            $search->setName($_POST['name']);
            $search->setPreference($_POST['preferences']);
            $search->setGenre($_POST['genres']);
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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/Circle.css">
</head>
<body>
    <script src="js/Circle.js"></script>
    <?php
        include_once(__DIR__."/nav.inc.php");
    ?>
  <div class="bg-img"></div>


    <!-- SEARCH BRYAN -->
    <div class="search-container">
        <p id="searchTitle">Search for people by interests or name</p>
        <form action="index.php" method="POST" id="searchform">
          
          <label for="preferences" id="prefLabel">Preference</label>
          <select name="preferences" id="preferences" form="searchform">
            <option value=""></option>
            <option value="design">Design</option>
            <option value="development">Development</option>
          </select>

          <label for="genres" id="genresLabel">Genre</label>
          <select name="genres" id="genres" form="searchform">
            <option value=""></option>
            <option value="Pop">Pop</option>
            <option value="Rock">Rock</option>
            <option value="R&B">R&B</option>
            <option value="Latin">Latin</option>
            <option value="Drum-'n-bass">Drum-'n-bass</option>
            <option value="classic">Classic</option>
          </select>

          <label for="name" id="nameLabel">Name</label>
          <input type="text" name="name" placeholder="name" id="name">
          <input type="submit" name="search-action" value="Search" id="searchBtn"></input>

        </form>
    </div>
    <!-- END SEARCH BRYAN -->
    <section>
    <div class="hero-img">
      <?php    
           $AllStudents = User::getAllStudents();
    ?>

    <?php
           $AllBuddys = User::getAllBuddys();
    ?>


<div class="middle">
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

    <span class="label">Buddies</span>
  </li>
</ul>
</div>
</div>
    </section>
    <!-- SEARCH BRYAN -->
    <div class="search-results-container">

      <?php if($searchReturned != null):?>
          <h1 id="search-results-title">Search results for "<?php echo $_POST['name']; ?>"</h1>
      <?php endif;?>

      <?php if($searchReturned != null){
          foreach($searchReturned as $result){ ?>

        <div class="search-results-profiles">
            <h1><?php echo $result["firstname"] . " " . $result["lastname"]?></h1>
            <P>This person also likes <?php echo $result['preference'] . " and listens to " . $result["genre"]?></P>
        </div>
        
      <?php }} ?>
    
    </div>
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
    <script src="js/saveBuddy.js"></script>
</body>
</html>