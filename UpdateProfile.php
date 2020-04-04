<?php
include_once(__DIR__."/classes/User.php");
session_start();

    $user = User::getCurrentUser($_SESSION['user']);
    $userId = $user['id'];
    
if(!empty($_POST)){
  
  try {
         $kenmerk = new User();
         $kenmerk->setLocation ($_POST['location']);
         $kenmerk->setYear ($_POST['year']);
         $kenmerk->setPreference ($_POST['preference']);
         $kenmerk->setGenre ($_POST['genre']);
         $kenmerk->setLikesToParty ($_POST['likesToParty']);
         $kenmerk->setUserId ($userId); 


        /** testing getterssetters---------------------------------------*/ 
                    /*echo $kenmerk->getLocatie();
                    echo $kenmerk->getJaar();
                    echo $kenmerk->getVoorkeur();
                    echo $kenmerk->getGenre();
                    echo $kenmerk->getFeesten();
                    echo $kenmerk->getUserId();*/
        /*---------------------------------------------------------*/
         $kenmerk->saveKenmerken();
         /*test Save----------------
         $succes ="user saved";
        -----------------------------*/


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
  <!--<link rel="stylesheet" href="css/style.css">-->
  <style>
 
      body{ font-family: 'Roboto Condensed';color:#FF6161;}
      h1{font-size: 45px;}
      h2{font-size: 25px; }
      fieldset{ background-color: #FFF699;padding: 15px 5%;}
      input{border-radius:15px;}

  </style>
</head>
<body>
 <?php if(isset($error)):?>
  <div class="error"><?php echo $error; ?></div>
  <?php endif; ?>
  <?php if(isset($succes)):?>
  <div class="succes"><?php echo $succes; ?></div>
  <?php endif; ?>
  <h1>Vervoledig hier je profiel</h1>


<fieldset>
<legend><h1>Kenmerken</h1></legend>
<form action="" method="post">
<!--  /PHP-project-buddy/PHP-project-buddy/ProfilePage.php  -->

  <div>
  <label for="location"><h2>Van waar bent u?</h2></label><br>
  <input type="text" id="location" name="location" value=""><br><br>
  </div>
 

<div>
<h2>In welk jaar zit u</h2>


  <label for="year"></label>
  <select id="year" name="year">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
  </select>
 </div> 

<div>
<h2>Verkiest u development of design?</h2>


  <label for="preference"></label>
  <select id="preference" name="preference">
    <option value="Development">Development</option>
    <option value="Design">Design</option>
  </select>
 </div>



<div>
<h2>Wat is je muziek genre?</h2>


  <label for="genre"></label>
  <select id="genre" name="genre">
    <option value="Pop">Pop</option>
    <option value="Rock">Rock</option>
    <option value="R&B">R&B</option>
    <option value="Latin">Latin</option>
    <option value="Electronische muziek">Electronische muziek</option>
    <option value="Drum-'n-bass">Drum-'n-bass</option>
    <option value="Klasiek">Klasiek</option>
  </select>
</div>  


<div>
<h2>Bent u een feestbeest?</h2>


  <label for="likesToParty"></label>
  <select id="likesToParty" name="likesToParty">
    <option value="Ja">Ja</option>
    <option value="Nee">Nee</option>
  </select><br><br>
</div>

<div>
  <input type="submit">
</div>
</form>


    

</fieldset>


</body>
</html>






