<?php

include_once(__DIR__."/classes/User.php");

if( !empty($_POST) ){
	$user = new User();
	$email = $_POST['email'];
	$password = $_POST['password'];
   
	if( !empty($email) && !empty($password) ){

		
		// indien ok: login checken
		if($user->canLogin($email, $password)){
			session_start();
			$_SESSION['user'] = $email ;
		
			header("Location: UserIdExist.php"); //JENS //Instead of going to index, first we will perform a check if our profile is filled in
		} else {
			$error = "Sorry, we couldn't log you in.";
		}
	} else {
		// indien leeg: error generen
		$error = "Email and password are required.";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">


  <link rel="stylesheet" href="css/style.css">

  
  <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">



  <title>PHPals</title>

</head>
<body>
	<div class="container" id="container">
		<div class="form-container sign-in-container">
			<form action="" id ="loginForm" method="post">
				<h1>Sign in</h1>
				<span>or use your account</span>
				<?php if (isset($error)): ?>
					<div class="form__error">
						<p> <?php echo $error;?></p>
					</div>
				<?php endif; ?>
				<input type="email" placeholder="Email" name="email" />
				<input type="password" placeholder="Password" name="password" />
				<a href="#">Forgot your password?</a>
				<button>Sign In</button>
			</form>
		</div>
		<div class="signup-container">
			<div class="panel">
				<div class="panel-right">
					<h1>Hello, Traveler!</h1>
					<p>Enter your personal info and get started on your IMD journey with a buddy</p>
					<button class="ghost "id="signUp" href="./register.php">Sign Up</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>