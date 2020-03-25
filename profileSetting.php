<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="Settings">
        <div class="form form--settings">
            <form action="" method="post">
				<h2>Profile settings</h2>
				<?php if(isset($error)): ?>
				<div class="form__error">
					<p><?php echo $error; ?></p>
						
				</div>
				<?php endif; ?>

				<div class="form__field">
					<label for="Avatar">Avatar</label>
					<input type="file" name="avatar" id="Avatar">
                </div>
                <div class="form__field">
					<label for="Firstname">Firstname</label>
					<input type="text" id="Firstname" name="firstname">
                </div>
                <div class="form__field">
					<label for="Lastname">Lastname</label>
					<input type="text" id="Lastname" name="lastname">
                </div>
                <div class="form__field">
					<label for="Email">Email</label>
					<input type="email" id="Email" name="email">
				</div>
				<div class="form__field">
					<label for="Description">Description</label>
					<input type="text" id="Description" name="description">
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