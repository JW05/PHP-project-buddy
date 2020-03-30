<?php
	include_once(__DIR__."/classes/newUser.php");
	 /* een account aanmaken kan met
    Email
    Dit adres moet eindigen op @student.thomasmore.be*/
	$emailRequirement = "@student.thomasmore.be";
	
    /*Full name
    zorg voor een foutmelding indien het aanmaken van een account niet lukt 
	valideer al wat kan mislopen in dit formulier via PHP en toon gebruiksvriendelijke foutmeldingen */

	/* Dit adres mag nog niet bestaan, dubbele accounts aanmaken mag dus niet mogelijk zijn,
	toon een fout als het email adres reeds in gebruik is */
	

	//$emailsUsed = NewUser::getEmails();
	//var_dump($emailsUsed);
	
	if(!empty($_POST)){
		try {
			//code...
			$emailsUsed = NewUser::getEmails();

			$user = new NewUser();
			$user->setFirstName($_POST['firstName']);
			$user->setLastName($_POST['lastName']);
			$user->setEmail($_POST['email']);
			$user->setPassword($_POST['password']);
	
			$user->save();
			$success = "user saved";

			/* een account aanmaken kan met email
			Dit adres moet eindigen op @student.thomasmore.be*/
			if(strpos($_POST["email"], $emailRequirement) == false){
				throw new Exception("Student email required i.e. John@student.thomasmore.be");
				$requiredVerification = false;
			}

		} catch (\Throwable $th) {
			//throw $th;
			$error = $th->getMessage();
		}

	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="register">

			<?php if(isset($error)):?>
				<div class="error" style="color: red;"><?php echo $error;?></div>
			<?php endif;?>
			<?php if(isset($success)):?>
				<div class="error" style="color: green;"><?php echo $success;?></div>
			<?php endif;?>

			<h1>Register</h1>
			<form action="" method="post">
                <div class="error"></div>

				<input type="text" name="firstName" placeholder="First name" id="firstName">

                <input type="text" name="lastName" placeholder="Last name" id="lastName">

				<input type="email" name="email" placeholder="Email" id="email">

				<input type="password" name="password" placeholder="Password" id="password">

				<input type="submit" value="Register">
			</form>
		</div>
</body>
</html>