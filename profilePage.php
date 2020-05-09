<?php
    include_once(__DIR__."/classes/User.php");
    include_once(__DIR__."/classes/Buddy.php"); //Added by Madina
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: login.php");
    }


    try{
        $user = User::getCurrentUser($_SESSION['user']);
        $currentPreference = User::getCurrentPreference($user['id']);
        $matches = Buddy::activeMatches($user['id']);
    }catch(\Throwable $th){
        //throw $th;
        $error = $th->getMessage();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <?php include_once(__DIR__."/includes/scripts.html"); ?>
</head>
 
<body>
    <?php
        include_once(__DIR__."/nav.inc.php");
    ?>

    <?php if($searchReturned != null): ?>
        <?php include('./includes/searchResults.inc.php');?>
    <?php else:?>

        <div class="container-fluid profile">
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm pt-3">
                    <img src="img/avatar/<?php echo htmlspecialchars($user['avatar']);?>" class="card-img-top mx-auto d-block rounded-circle" alt="...">
                        <div class="card-body">
                            <h3 class="card-title text-center"><?php echo htmlspecialchars($user['firstname'])." ".htmlspecialchars($user['lastname']);?></h3>
                            <h5 class="card-subtitle text-center mb-2 text-muted"><?php echo htmlspecialchars($currentPreference->preference);?></h5>
                            <h6 class="text-center"><span class="badge badge-pill badge-<?php echo ($currentPreference->lookingForBuddy)? "success": "warning"; ?> p-2"><?php echo ($currentPreference->lookingForBuddy)? "I'm looking for a buddy": "I would like to take care of someone"; ?></span></h6>
                            <p class="text-center"><?php echo htmlspecialchars($user['description']);?></p>
                            <div class="w-50 mx-auto profile-description d-flex flex-column justify-content-center">
                                <div class="form-group d-flex flex-row">
                                    <label><span class="badge badge-pill badge-primary w-100 p-2">Location</span></label>
                                    <h7><?php echo htmlspecialchars($currentPreference->location);?></h7>
                                </div>

                                <div class="form-group d-flex flex-row">
                                    <label><span class="badge badge-pill badge-primary w-100 p-2">Year</span></label>
                                    <h7><?php echo htmlspecialchars($currentPreference->year)." IMD";?></h7>
                                </div>
                                
                                <div class="form-group d-flex flex-row">
                                    <label><span class="badge badge-pill badge-primary w-100 p-2">Music genre</span></label>
                                    <h7><?php echo htmlspecialchars($currentPreference->genre);?></h7>
                                </div>

                                <div class="form-group d-flex flex-row">
                                    <label><span class="badge badge-pill badge-primary w-100 p-2">Party animal</span></label>
                                    <h7><?php echo ($currentPreference->likesToParty)? "Yes": "No"; ?></h7>
                                </div>

                                <a href="updateProfile.php" class="btn btn-primary">Update Profile</a>
                                    
                            </div>
                            
                            <hr>
                            <div class="w-100">
                                <h5 class="text-center">My buddies</h5>
                                <ul class="list-unstyled">
                                    <?php foreach($matches as $match):
                                        $senderUser = User::getUserInfo($match['userId']); ?>
                                        <li class="media border-0">

                                            <img src="img/avatar/<?php echo htmlspecialchars($senderUser->avatar);?>" class="mr-3 rounded-cirlce" alt="...">
                                            <div class="media-body d-flex flex-row justify-content-between align-items-center">
                                                <h5 class="mt-0 mb-1"><?php echo htmlspecialchars($senderUser->firstname)." ".htmlspecialchars($senderUser->lastname);?></h5>
                                                <a href="chat.php?buddyId=<?php echo htmlspecialchars($senderUser->userId); ?>" class="btn btn-primary">Open chat</a>
                                            </div>
                                        </li>
                                    <?php endforeach;?>
                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card shadow-sm pt-3">
                        <?php include_once(__DIR__."/profileSetting.php"); ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>
</body>
</html>
