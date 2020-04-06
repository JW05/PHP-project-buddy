<?php
    include_once(__DIR__."/classes/User.php");
    session_start();

    try{
        //To get current active user
        $user = User::getCurrentUser($_SESSION['user']);
        $userId = $user['id'];

        //Save retrieved information
        $currentUser = new User();
        $currentUser->setEmail($user["email"]);
        $currentUser->setFirstName($user["firstname"]);
        $currentUser->setLastName($user["lastname"]);
        $currentUser->setAvatar($user["avatar"]);
        $currentUser->setDescription($user["description"]);
        
        //To check if the email meets the conditions and currentPassword is filled in
        $emailRequirement = "@student.thomasmore.be";
        $emailCorrect = true;
        $pwdCorrect = true;

        if(!empty($_POST)){
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $description = $_POST['description'];
            $oldPassword = $_POST['oldPassword'];
            $newPassword = $_POST['newPassword'];
            
            if(!empty($_FILES['avatarUpload']['name'])){
                include_once(__DIR__."/upload.php");
            }

            $currentUser->setFirstName($firstname);
            $currentUser->setLastName($lastname);
            $currentUser->setDescription($description);

            //Check if email is changed
            if($currentUser->getEmail() != $email || $oldPassword){
                echo $currentUser->getEmail();
                if($currentUser->canLogin($currentUser->getEmail(), $oldPassword)){
                    
                    //If email is changed don't meets the condition, give error
                    if(strpos($email, $emailRequirement) != true){
                        throw new Exception("Student email required i.e. John@student.thomasmore.be");
                        $emailCorrect = false;
                    }
                    
                    if($currentUser->checkEmail($email)){
                        $currentUser->setEmail($email);
                        $emailCorrect = true;
                    }else{
                        throw new Exception("Email is taken.");
                        $emailCorrect = false;
                    }
    
                }else{
                    throw new Exception("Current password you entered did not match our records. Please try again.");
                    $pwdCorrect = false;
                }
            }

            //check if user request to change password
            if(!empty($newPassword)){
                if($currentUser->canLogin($currentUser->getEmail(), $oldPassword)){
                    $currentUser->setPassword($newPassword);
                }else{
                    throw new Exception("Current password you entered did not match our records. Please try again.");
                    $pwdCorrect = false;
                }
                
            }


            if($emailCorrect == true && $pwdCorrect == true){
                if($currentUser->updateProfile($userId)){
                    $success = "Your profile is successfully up to date.";
                    $_SESSION['user'] = $currentUser->getEmail();
                }else{
                    $error = "Something went wrong, please try again.";
                }
            }

            unset($_POST);
        }
    }catch(\Throwable $th){
        $error = $th->getMessage();
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once(__DIR__."/nav.inc.php");
    ?>
    <div>
        <div class="form--settings">
            <form action="" method="post" enctype="multipart/form-data">
				<h2>Profile settings</h2>
				<?php if(isset($error)): ?>
				<div class="form__error">
					<p><?php echo $error; ?></p>
						
				</div>
                <?php endif; ?>
                <?php if(isset($success)): ?>
				<div class="form__success">
					<p><?php echo $success; ?></p>
						
				</div>
				<?php endif; ?>

				<div class="form-group">
                    <label for="Avatar">Your picture</label>
                    <input type="file" class="form-control-file" name="avatarUpload" id="Avatar">
                    <img class="avatar--img" src="img/avatar/<?php echo htmlspecialchars($currentUser->getAvatar());?>" alt="">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Firstname">Firstname</label>
                        <input type="text" class="form-control" id="Firstname" name="firstname" value="<?php echo htmlspecialchars($currentUser->getFirstName());?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Lastname">Lastname</label>
                        <input type="text" class="form-control" id="Lastname" name="lastname" value="<?php echo htmlspecialchars($currentUser->getLastName());?>">
                    </div>
                </div>
				<div class="form-group">
					<label for="Description">Description</label>
					<input type="text" class="form-control" id="Description" name="description" value="<?php echo htmlspecialchars($currentUser->getDescription());?>">
                </div>
                <hr>
                <h3>Account information</h3>
                <div class="form-group">
					<label for="Email">Email</label>
                    <input type="email" class="form-control" id="Email" name="email" value="<?php echo htmlspecialchars($currentUser->getEmail());?>">
                    
				</div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="Password">Your current password</label>
                        <input type="password" class="form-control" id="Password" name="oldPassword">
                        <small id="passwordHelp" class="form-text text-muted">
                            Your current password is only needed if you want to change your email or password. 
                            Leave this empty if you only want to change details information.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="PasswordNew">New password</label>
                        <input type="password" class="form-control" id="PasswordNew" name="newPassword">
                        <small id="newPasswordHelp" class="form-text text-muted">
                            Leave this empty if you dont want to change your password.
                        </small>
                    </div>
                </div>

				<div class="form-group">
					<input type="submit" value="Update" class="btn btn-success">	
				</div>
			</form>
        </div>
    </div>
</body>
</html>