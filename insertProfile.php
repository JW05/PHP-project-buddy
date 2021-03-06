<?php
// JENS
include_once(__DIR__."/classes/User.php");
session_start();

    $user = User::getCurrentUser($_SESSION['user']);
    $userId = $user['id'];
    
if(!empty($_POST)){
  
  try {
         $info = new User();
         $info->setLocation($_POST['location']);
         $info->setYear($_POST['year']);
         $info->setPreference($_POST['preference']);
         $info->setGenre($_POST['genre']);
         $info->setLikesToParty($_POST['likesToParty']);
         $info->setLookingForBuddy($_POST['lookingForBuddy']);
         $info->setUserId($userId); 

         $result = $info->saveInfo();
         // If the result from the save is success, redirect to the index.
         if($result) {
          header('Location: index.php');
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

 <?php if(isset($error)):?>
  <div class="error"><?php echo $error; ?></div>
  <?php endif; ?>
  <?php if(isset($succes)):?>
  <div class="succes"><?php echo $succes; ?></div>
  <?php endif; ?>


<h1>Complete your profile</h1>
<br><br>
<legend><h1>Fill in your info</h1></legend>
<form action="" method="post">

  <div>
  <label for="location"><h2>Where do you live?</h2></label><br>
  <input type="text" id="location" name="location" value=""><br><br>
  </div>
 
<div>
<h2>What grade are you in?</h2>

  <label for="year"></label>
  <select id="year" name="year">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
  </select>
 </div> 

<div>
<h2>Do you prefer design or development?</h2>

  <label for="preference"></label>
  <select id="preference" name="preference">
    <option value="Development">Development</option>
    <option value="Design">Design</option>
  </select>
 </div>

<div>
<h2>What is your favorite music genre?</h2>

  <label for="genre"></label>
  <select id="genre" name="genre">
    <option value="Pop">Pop</option>
    <option value="Rock">Rock</option>
    <option value="Metal">Metal</option>
    <option value="R&B">R&B</option>
    <option value="Latin">Latin</option>
    <option value="Electronische muziek">Electro</option>
    <option value="Drum-'n-bass">Drum-'n-bass</option>
    <option value="Klasiek">Classical Music</option>
  </select>
</div>  

<div>
<h2>Do you enjoy going out?</h2>

  <label for="likesToParty"></label>
  <select id="likesToParty" name="likesToParty">
    <option value="1">Yes</option>
    <option value="0">No</option>
  </select><br><br>
</div>



<h2>Need a buddy?</h2>

  <label for="lookingForBuddy"></label>
  <select id="lookingForBuddy" name="lookingForBuddy">
    <option value="1">I am looking for a buddy</option>
    <option value="0">I would like to take care of someone</option>
  </select><br><br>
</div>





<div>
  <input class = "button" type="submit" placeholder="send">
</div>
</form>

</body>
</html>
