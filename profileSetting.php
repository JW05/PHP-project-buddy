<?php
    include_once(__DIR__."/classes/User.php");
    session_start();

    $user = User::getCurrentUser($_SESSION['user']);
    var_dump($user);
    echo $user["avatar"];

    $currentUser = new User();
    $currentUser->setEmail($user["email"]);
    $currentUser->setFirstname($user["firstname"]);
    $currentUser->setLastname($user["lastname"]);
    $currentUser->setAvatar($user["avatar"]);
    $currentUser->setDescription($user["description"]);
    $currentUser->setPassword($user['password']);

    include_once(__DIR__."/upload.php");
    
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
					<input type="text" id="Firstname" name="firstname" value="<?php echo $currentUser->getFirstname();?>">
                </div>
                <div class="form__field">
					<label for="Lastname">Lastname</label>
					<input type="text" id="Lastname" name="lastname" value="<?php echo $currentUser->getLastname();?>">
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