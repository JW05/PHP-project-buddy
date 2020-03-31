

<?php   
        include_once(__DIR__."/classes/User.php");
        session_start();




      /*  public static function getCurrentKenmerk($email){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from users where email = '$email'");
            $statement->execute();
            $kenmerk = $statement->fetch(PDO::FETCH_ASSOC);

            return $kenmerk;
    }

    public function updateKenmerken($id){
            $conn = Db::getConnection();
            $statement = $conn->prepare("update users set locatie = :locatie, jaar = :jaar, voorkeur = :voorkeur, genre = :genre, feesten = :feesten where id = '$id'");
            
            $locatie = $this->getLocatie();
            $jaar = $this->getJaar();
            $voorkeur = $this->getVoorkeur();
            $genre = $this->getGenre();
            $feesten = $this->getFeesten();
            

    }














        $Kenmerk = User::getCurrentKenmerk($_SESSION['user']);
        $KenmerkId = $Kenmerk['id'];

        $currentKenmerk = new User();

        $currentKenmerk->setLocatie($Kenmerk["locatie"]);
        $currentKenmerk->setJaar($Kenmerk["jaar"]);
        $currentKenmerk->setVoorkeur($Kenmerk["voorkeur"]);
        $currentKenmerk->setGenre($Kenmerk["genre"]);
        $currentKenmerk->setFeesten($Kenmerk["feesten"]);
*/
        if(!empty($_POST)){
         $locatie = $_POST['locatie'];
         $jaar = $_POST['jaar'];
         $voorkeur = $_POST['voorkeur'];
         $genre = $_POST['genre'];
         $feesten = $_POST['feesten'];

/*if(!empty($locatie)){
    $currentKenmerk->setlocatie(htmlspecialchars($locatie));
}else{
    $error = "Please fill out all the fields.";
}*/
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