<?php
    include_once(__DIR__."/classes/User.php");
    session_start();

    $user = User::getCurrentUser($_SESSION['user']);
    $userId = $user['id'];
    

    $currentUser = new User();
    
    $currentUser->setEmail($user["email"]);
    $currentUser->setFirstName($user["firstname"]);
    $currentUser->setLastName($user["lastname"]);
    $currentUser->setAvatar($user["avatar"]);
    $currentUser->setDescription($user["description"]);
    $currentUser->setPassword($user['password']);
    
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

        if(!empty($oldPassword) || $currentUser->getEmail() != $email){
            if($currentUser->canLogin($currentUser->getEmail(), $oldPassword)){
                if($currentUser->checkEmail(htmlspecialchars($email))){
                    $currentUser->setEmail(htmlspecialchars($email));
                }else{
                    $error = "This email was not available.";
                }
                
                if(!empty($newPassword) && !empty($oldPassword)){
                    $currentUser->setPassword(htmlspecialchars($newPassword));
                }
            }else{
                $error = "The current password you entered did not match or records.";
            }
        }


        if(!empty($firstname)){
            $currentUser->setFirstname(htmlspecialchars($firstname));
        }else{
            $error = "Please fill out all the fields.";
        }

        if(!empty($lastname)){
            $currentUser->setLastName(htmlspecialchars($lastname));
        }else{
            $error = "Please fill out all the fields.";
        }

        if(!empty($description)){
            $currentUser->setDescription(htmlspecialchars($description));
        }

        if(!isset($error)){
            if($currentUser->updateProfile($userId)){
                $success = "Your profile is successfully up to date.";
            }else{
                $error = "Something went wrong, please try again.";
            }
        }

        unset($_POST);
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="profileSettings">
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

				<div class="form__field">
                    <label for="Avatar">Your picture</label>
                    <input type="file" name="avatarUpload" id="Avatar">
                    <img class="avatar--img" src="img/avatar/<?php echo $currentUser->getAvatar();?>" alt="">
                </div>
                <div class="form__field">
					<label for="Firstname">Firstname</label>
					<input type="text" id="Firstname" name="firstname" value="<?php echo $currentUser->getFirstName();?>">
                </div>
                <div class="form__field">
					<label for="Lastname">Lastname</label>
					<input type="text" id="Lastname" name="lastname" value="<?php echo $currentUser->getLastName();?>">
                </div>
                <div class="form__field">
					<label for="Email">Email</label>
                    <input type="email" id="Email" name="email" value="<?php echo $currentUser->getEmail();?>">
                    
				</div>
				<div class="form__field">
					<label for="Description">Description</label>
					<input type="text" id="Description" name="description" value="<?php echo $currentUser->getDescription();?>">
                </div>
                <div class="form__password">
                    <div class="form__field">
                        <label for="Password">Your current password</label>
                        <input type="password" id="Password" name="oldPassword">
                    </div>
                    <div class="form__field">
                        <label for="PasswordNew">New password</label>
                        <input type="password" id="PasswordNew" name="newPassword">
                    </div>
                </div>

				<div class="form__field">
					<input type="submit" value="Update" class="btn btn--success">	
				</div>
			</form>
        </div>
    </div>
</body>
</html>