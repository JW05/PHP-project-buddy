<?php
    include_once(__DIR__."/classes/User.php");
    include_once(__DIR__."/classes/Buddy.php"); //Added by Madina
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: login.php");
    }

    $user = User::getCurrentUser($_SESSION['user']);
    $userId = $user['id'];
    $matches = Buddy::activeMatches($user['id']);

    try{
        $currentUser = User::getCurrentUser($_SESSION['user']);
        $currentPreference = User::getCurrentPreference($currentUser['id']);
    }catch(\Throwable $th){
        //throw $th;
        $error = $th->getMessage();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>ProfilePage</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
   
        #Kenmerken{ background-color: #a4fcaf;padding: 60px 25%;}
        
    </style>
</head>
 
<body>
    <?php
        include_once(__DIR__."/nav.inc.php");
    ?>

    <?php if($searchReturned != null): ?>
        <?php include('./includes/searchResults.inc.php');?>
    <?php else:?>

        <a href="index.php" class="btn"> Go Back </a>
        <a href="updateProfile.php" class="btn"> Update your profile </a>

        <div id="Kenmerken">

            <fieldset>

                <legend><h1>Characteristiques</h1></legend>
                <h2>Location: <?php echo $currentPreference->location;?></h2>
                <h2>Year: <?php echo $currentPreference->year;?></h2>
                <h2>Preference: <?php echo $currentPreference->preference; ?></h2>
                <h2>Music genre: <?php echo $currentPreference->genre; ?></h2>
                <h2>Party animal: <?php echo ($currentPreference->likesToParty)? "Yes": "No"; ?></h2>
                <h2>Buddy type: <?php echo ($currentPreference->lookingForBuddy)? "I'm looking for a buddy": "I would like to take care of someone"; ?></h2>    
            
            </fieldset>
        </div>

        <div class="row">
        <?php foreach($matches as $match):
            $senderUser = User::getUserInfo($match['userId']); ?>
            <div class="card col-md-4" style="width: 3rem;">

                <img src="img/avatar/<?php echo htmlspecialchars($senderUser->avatar);?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($senderUser->firstname)." ".htmlspecialchars($senderUser->lastname);?></h5>
                    <a href="chat.php?buddyId=<?php echo htmlspecialchars($senderUser->userId); ?>" class="btn btn-primary">Open chat</a>

                </div>
            </div>
        <?php endforeach;?>
        </div>
        <?php endif; ?>
</body>
</html>