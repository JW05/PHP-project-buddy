<?php   
        include_once(__DIR__."/classes/User.php");
        session_start();

    
        $Kenmerk = User::getCurrentKenmerk($_SESSION['user']);
        $KenmerkId = $Kenmerk['id'];

        $currentKenmerk = new User();

        $currentKenmerk->setLocatie($Kenmerk["locatie"]);
        $currentKenmerk->setJaar($Kenmerk["jaar"]);
        $currentKenmerk->setVoorkeur($Kenmerk["voorkeur"]);
        $currentKenmerk->setGenre($Kenmerk["genre"]);
        $currentKenmerk->setFeesten($Kenmerk["feesten"]);

        if(!empty($_POST)){
         $locatie = $_POST['locatie'];
         $jaar = $_POST['jaar'];
         $voorkeur = $_POST['voorkeur'];
         $genre = $_POST['genre'];
         $feesten = $_POST['feesten'];

if(!empty($locatie)){
    $currentKenmerk->setlocatie(htmlspecialchars($locatie));
}else{
    $error = "Please fill out all the fields.";
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

    <h1>Kenmerken</h1>

    <h2>Locatie: <?php echo $currentKenmerk->getLocatie();?></h2>
    <h2>Jaar: <?php echo $currentKenmerk->getJaar();?></h2>
    <h2>Voorkeur:<?php echo $currentKenmerk->getVoorkeur();?></h2>
    <h2>Muziek genre: <?php echo $currentKenmerk->getGenre();?></h2>
    <h2>Feestbeest:<?php echo $currentKenmerk->getFeesten();?></h2>
   
    
 
    
 
</div>
</body>
</html>