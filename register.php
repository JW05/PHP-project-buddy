<?php
	include_once(__DIR__."/classes/User.php");
	$allUsers = User::getAll(3);
	 /* een account aanmaken kan met
    Email
    Dit adres moet eindigen op @student.thomasmore.be*/
	$emailRequirement = "@student.thomasmore.be";
	$accountExists = true;
	$emailOk = true;

	
    /*Full name
    zorg voor een foutmelding indien het aanmaken van een account niet lukt 
	valideer al wat kan mislopen in dit formulier via PHP en toon gebruiksvriendelijke foutmeldingen */
	
	//$emailsUsed = NewUser::getEmails();
	//var_dump($emailsUsed);
	
	if(!empty($_POST)){
		try {
			//code...
			$emailsUsed = User::getEmails();
			$conn = Db::getConnection();

			$user = new User();
			$user->setFirstName($_POST['firstName']);
			$user->setLastName($_POST['lastName']);
			$user->setEmail($_POST['email']);
			$user->setPassword($_POST['password']);
	
			// $user->save();
			// $success = "user saved";

			/* een account aanmaken kan met email
			Dit adres moet eindigen op @student.thomasmore.be*/


			
			if(strpos($_POST["email"], $emailRequirement) == false){
				throw new Exception("Student email required i.e. John@student.thomasmore.be");
				$emailOk = false;
			}


			




			// indien een email adres in gebruik is 
			$email = ($_POST['email']);
			$query = $conn->prepare( "SELECT `email` FROM `users` WHERE `email` = ?" );
			$query->bindValue( 1, $email );
			$query->execute();

			if( $query->rowCount() > 0 ) { # If rows are found for query
				throw new Exception("Email adres is already in use");
			}
			else {
				$accountExists=false;
			}

			
			if($accountExists == false && $emailOk == true){
				$user->save();

				$success = "Email has been send for verification";
			session_start();
			$_SESSION["user"] = $_POST["email"];
			
			$salt = "dsjkirdçfàçfioijf6558ffieeéddfsze";
			$vKey = md5($email.$salt);


		//	$user->verifyAccount($vKey,$email);
			header("Location: login.php");	
			
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
	<link rel="stylesheet" href="css/register.css">
    <title>Register PHPals</title>
</head>
<body>
    <div class="register-wrap">



	<a href="login.php"><img src="img/Untitled-1.png" width="250px" height="auto" alt="" class="logo"></a>
			<?php if(isset($error)):?>
				<div class="error" style="color: red;"><?php echo $error;?></div>
			<?php endif;?>
			<?php if(isset($success)):?>
				<div class="error" style="color: green;"><?php echo $success;?></div>
			<?php endif;?>


			<form action="" method="post">
                <div class="error"></div>

				<input type="text" name="firstName" placeholder="First name" id="firstName">

                <input type="text" name="lastName" placeholder="Last name" id="lastName">

				<input type="email" name="email" placeholder="Email" id="email">

				<input type="password" name="password" placeholder="Password" id="password">

				

				<input type="submit" value="Register" id="btnAddUser">
			</form>
		</div>


		
		<script src="js/saveUser.js"></script>
</body>
</html>