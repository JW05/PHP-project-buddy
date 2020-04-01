<?php   
        include_once(__DIR__."/classes/User.php");
        session_start();
        
       
      
    
$Kenmerk = User::getCurrentKenmerk($_SESSION['locatie']);
        $KenmerkId = $Kenmerk['id'];

        $currentKenmerk = new User();

        $currentKenmerk->setUser_id($Kenmerk["user_id"]);
        $currentKenmerk->setLocatie($Kenmerk["locatie"]);
        $currentKenmerk->setJaar($Kenmerk["jaar"]);
        $currentKenmerk->setVoorkeur($Kenmerk["voorkeur"]);
        $currentKenmerk->setGenre($Kenmerk["genre"]);
        $currentKenmerk->setFeesten($Kenmerk["feesten"]);
        

        if(!empty($_POST)){
         $user_id = $_POST['user_id'];   
         $locatie = $_POST['locatie'];
         $jaar = $_POST['jaar'];
         $voorkeur = $_POST['voorkeur'];
         $genre = $_POST['genre'];
         $feesten = $_POST['feesten'];
   
         
if(!empty($user_id)){
    $currentKenmerk->setUser_id(htmlspecialchars($user_id));
}
if(!empty($locatie)){
    $currentKenmerk->setLocatie(htmlspecialchars($locatie));
}else{
    $error = "Please fill out all the fields.";
}

if(!empty($jaar)){
    $currentKenmerk->setJaar(htmlspecialchars($jaar));
}

if(!empty($voorkeur)){
    $currentKenmerk->setVoorkeur(htmlspecialchars($voorkeur));
}

if(!empty($genre)){
    $currentKenmerk->setGenre(htmlspecialchars($genre));
}

if(!empty($feesten)){
    $currentKenmerk->setFeesten(htmlspecialchars($feesten));
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
    <h2>Locatie: <?php echo $currentKenmerk->getLocatie();?></h2>
    <h2>Jaar: <?php echo $currentKenmerk->getJaar();?></h2>
    <h2>Voorkeur: <?php echo $currentKenmerk->getVoorkeur(); ?></h2>
    <h2>Muziek genre: <?php echo $currentKenmerk->getGenre(); ?></h2>
    <h2>Feestbeest: <?php echo $currentKenmerk->getFeesten(); ?></h2>
   
</div>
</fieldset>
</body>
</html>