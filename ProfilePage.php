<?php   
        include_once(__DIR__."/classes/User.php");
      
        
       
      
      /*  $kenmerken = User::getCurrentAllKenmerk();*/
        /*var_dump($kenmerken);*/

        $currentKenmerk = new User();

        $currentKenmerk->setUserId($_POST["userId"]);
        $currentKenmerk->setLocatie($_POST["location"]);
        $currentKenmerk->setJaar($_POST["year"]);
        $currentKenmerk->setVoorkeur($_POST["preference"]);
        $currentKenmerk->setGenre($_POST["genre"]);
        $currentKenmerk->setFeesten($_POST["likestoparty"]);
        

        if(!empty($_POST)){
         $userId = $_POST['userId'];   
         $locatie = $_POST['location'];
         $jaar = $_POST['year'];
         $voorkeur = $_POST['prefernce'];
         $genre = $_POST['genre'];
         $feesten = $_POST['likestoparty'];
   
         
if(!empty($userId)){
    $currentKenmerk->setUserId(htmlspecialchars($userId));
}
if(!empty($locatie)){
    $currentKenmerk->setLocation(htmlspecialchars($location));
}else{
    $error = "Please fill out all the fields.";
}

if(!empty($year)){
    $currentKenmerk->setYear(htmlspecialchars($year));
}

if(!empty($preference)){
    $currentKenmerk->setPreference(htmlspecialchars($preference));
}

if(!empty($genre)){
    $currentKenmerk->setGenre(htmlspecialchars($genre));
}

if(!empty($likestoparty)){
    $currentKenmerk->setParty(htmlspecialchars($likestoparty));
}

}


?>

<!DOCTYPE html>
<html>
<head>
    <title>ProfilePage</title>
    <style>
 
        body{padding: 0;margin: 0; font-family: 'Roboto Condensed';color:#FF6161;}
        h1{font-size: 45px;}
        h2{font-size: 25px;}
        #Kenmerken{ background-color: #a4fcaf;padding: 60px 25%;}
        
    </style>
</head>
 
<body>
<div id="Kenmerken">

<fieldset>

    
    
    <legend><h1>Kenmerken</h1></legend>
<<<<<<< HEAD
    <h2>Location: <?php echo $currentKenmerk->getLocatie();?></h2>
    <h2>Year: <?php echo $currentKenmerk->getJaar();?></h2>
    <h2>Preference: <?php echo $currentKenmerk->getVoorkeur(); ?></h2>
    <h2>Music genre: <?php echo $currentKenmerk->getGenre(); ?></h2>
    <h2>Party animal: <?php echo $currentKenmerk->getFeesten(); ?></h2>
    <h2>userId: <?php echo $currentKenmerk->getUserId(); ?></h2>
=======
    <h2>Locatie: <?php echo $currentKenmerk->getLocatie();?></h2>
    <h2>Jaar: <?php echo $currentKenmerk->getJaar();?></h2>
    <h2>Voorkeur: <?php echo $currentKenmerk->getVoorkeur(); ?></h2>
    <h2>Muziek genre: <?php echo $currentKenmerk->getGenre(); ?></h2>
    <h2>Feestbeest: <?php echo $currentKenmerk->getFeesten(); ?></h2>
  <!--  <h2>userId: </*?php echo $currentKenmerk->getUserId(); ?></h2> -->
>>>>>>> 3ffa2bdbf5f864fcc868ea2f53c9c6d9d86afae2


    Buddy:
<input type="radio" name="buddy"
<?php if (isset($buddy) && $buddy=="buddy") echo "checked";?>
value="looking for">Looking for a Buddy
<input type="radio" name="buddy"
<?php if (isset($buddy) && $buddy=="male") echo "checked";?>
value="accepting">Guarding over a Buddy
   
</div>
</fieldset>
</body>
</html>