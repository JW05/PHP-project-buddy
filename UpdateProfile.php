<?php
  // JENS UPDATE 
  include_once(__DIR__."/classes/User.php");
  session_start();

  try{
    $user = User::getCurrentUser($_SESSION['user']);
    $userId = $user['id'];
    $currentPreference = User::getCurrentPreference($userId);
  }catch(\Throwable $th){
    $error = $th->getMessage();
  }
    
  if(!empty($_POST)){
  
    try {
      $info = new User();
      $info->setLocation ($_POST['location']);
      $info->setYear ($_POST['year']);
      $info->setPreference ($_POST['preference']);
      $info->setGenre ($_POST['genre']);
      $info->setLikesToParty ($_POST['likesToParty']);
      $info->setLookingForBuddy ($_POST['lookingForBuddy']);

      $result = $info->updateInfo($userId);
      // If the result from the save is success, redirect to the index.
      if(!empty($result)) {
        $success = "Preferences are up to date";
      }

  } catch (\Throwable $th) {
    $error =$th->getMessage();
  }       
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UpdateProfile</title>
 <link rel="stylesheet" href="css/style.css">
  <style>
   
      body{
        background: #0396FF;
        background: -webkit-linear-gradient(to right, #ABDCFF, #0396FF);
        background: linear-gradient(to right, #ABDCFF, #0396FF);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 0 0;
        color: black;
        height: 135vh;
      }

</style>
</head>
<body>
<div ><a href="index.php">Go Back</a></div>

  <h1>Complete your profile</h1>
  <br><br>
  
  <form action="" method="post">
    <?php if(isset($error)):?>
      <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if(isset($success)):?>
      <div class="succes"><?php echo $success; ?></div>
    <?php endif; ?>

    <div>
      <label for="location"><h2>From where are you?</h2></label><br>
      <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($currentPreference->location);?>"><br><br>
    </div>
 
    <div>
      <label for="year"><h2>Your study year</h2></label>
      <select id="year" name="year">
        <option value="1" <?php echo ($currentPreference->year == 1)? "selected": ""; ?>>1</option>
        <option value="2" <?php echo ($currentPreference->year == 2)? "selected": ""; ?>>2</option>
        <option value="3" <?php echo ($currentPreference->year == 3)? "selected": ""; ?>>3</option>
      </select>
    </div> 

    <div>
      <label for="preference"><h2>Do you prefer Design or Development?</h2></label>
      <select id="preference" name="preference">
        <option value="Development" <?php echo ($currentPreference->preference == "Development")? "selected": ""; ?>>Development</option>
        <option value="Design" <?php echo ($currentPreference->preference == "Design")? "selected": ""; ?>>Design</option>
      </select>
    </div>

    <div>
      <label for="genre"><h2>What is your music genre?</h2></label>
      <select id="genre" name="genre">
        <option value="Pop" <?php echo ($currentPreference->genre == "Pop")? "selected": ""; ?>>Pop</option>
        <option value="Rock" <?php echo ($currentPreference->genre == "Rock")? "selected": ""; ?>>Rock</option>
        <option value="R&B" <?php echo ($currentPreference->genre == "R&B")? "selected": ""; ?>>R&B</option>
        <option value="Latin" <?php echo ($currentPreference->genre == "Latin")? "selected": ""; ?>>Latin</option>
        <option value="Electronische Music" <?php echo ($currentPreference->genre == "Electronische Music")? "selected": ""; ?>>Electronic Music</option>
        <option value="Drum-'n-bass" <?php echo ($currentPreference->genre == "Drum-'n-bass")? "selected": ""; ?>>Drum-'n-bass</option>
        <option value="Classic" <?php echo ($currentPreference->genre == "Classic")? "selected": ""; ?>>Classic</option>
      </select>
    </div>  

    <div>
      <label for="likesToParty"><h2>Party animal?</h2></label>
      <select id="likesToParty" name="likesToParty">
        <option value="1" <?php echo ($currentPreference->likesToParty == 1)? "selected": ""; ?>>Ja</option>
        <option value="0" <?php echo ($currentPreference->likesToParty == 0)? "selected": ""; ?>>Nee</option>
      </select><br><br>
    </div>

    <div>
      <label for="lookingForBuddy"><h2>Need a buddy?</h2></label>
      <select id="lookingForBuddy" name="lookingForBuddy">
        <option value="1" <?php echo ($currentPreference->lookingForBuddy == 1)? "selected": ""; ?>>I am looking for a buddy</option>
        <option value="0" <?php echo ($currentPreference->lookingForBuddy == 0)? "selected": ""; ?>>I would like to take care of someone</option>
      </select><br><br>
    </div>

    <div>
      <input class = "button" type="submit">
    </div>
  </form>

</body>
</html>
