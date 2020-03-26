

<?php   

        $locatie ="Sorry er is iets mis geggaan";
        
        if(!empty($_POST)){
            
        if(!empty ($_POST['locatie'])){

		$locatie = $_POST['locatie'];
      
		$file = fopen("locatielist.txt","a+");

		fwrite($file,$locatie."\n");

		fclose($file);
        
        $locaties = file("locatielist.txt");
        $locatie = "$locatie";
	}
}



$jaar = "Sorry er is iets mis geggaan";
        
if(!empty($_POST)){
    
if(!empty ($_POST['jaar'])){

$jaar = $_POST['jaar'];

$file = fopen("jaarlist.txt","a+");

fwrite($file,$jaar."\n");

fclose($file);

$jaaren = file("jaarlist.txt");
$jaar = "$jaar";
}
}



$voorkeur = "Sorry er is iets mis geggaan";
        
if(!empty($_POST)){
    
if(!empty ($_POST['voorkeur'])){

$voorkeur = $_POST['voorkeur'];

$file = fopen("voorkeurlist.txt","a+");

fwrite($file,$voorkeur."\n");

fclose($file);

$voorkeuren = file("voorkeurlist.txt");
$voorkeur = "$voorkeur";
}
}



$genre = "Sorry er is iets mis geggaan";
        
if(!empty($_POST)){
    
if(!empty ($_POST['genre'])){

$genre = $_POST['genre'];

$file = fopen("genrelist.txt","a+");

fwrite($file,$genre."\n");

fclose($file);

$genres = file("genrelist.txt");
$genre = "$genre";
}
}



$feesten = "Sorry er is iets mis geggaan";
        
if(!empty($_POST)){
    
if(!empty ($_POST['feesten'])){

$feesten = $_POST['feesten'];

$file = fopen("feestenlist.txt","a+");

fwrite($file,$feesten."\n");

fclose($file);

$feestenlist = file("feestenlist.txt");
$feesten = "$feesten";
}
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>ProfilePage</title>
    <style>
 
        body{padding: 0;margin: 0; font-family: 'Roboto Condensed'}
        h1{font-size: 45px;}
        h2{font-size: 25px;}
        #Kenmerken{ background-color: #f1f1f1;padding: 60px 25%;}
        
    </style>
</head>
 
<body>
<div id="Kenmerken">

    <h1>Kenmerken</h1>

    <h2>Locatie: <?php echo $locatie; ?></h2>
    <h2>Jaar: <?php echo $jaar; ?></h2>
    <h2>Voorkeur: <?php echo $voorkeur; ?></h2>
    <h2>Muziek genre: <?php echo $genre; ?></h2>
    <h2>Feestbeest: <?php echo $feesten; ?></h2>
   
    
 
    
 
</div>
</body>
</html>