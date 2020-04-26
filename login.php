<?php

include_once(__DIR__."/classes/User.php");
include_once(__DIR__."/classes/LoginAttempt.php");
session_start();

if(isset($_SESSION['startAttemptTime']) && $_SESSION['startAttemptTime'] + 1800  < time()){
	unset($_SESSION['startAttemptTime']);
}


if( !empty($_POST) ){
	$user = new User();
	$email = $_POST['email'];
	$password = $_POST['password'];
	$ip = $_SERVER['REMOTE_ADDR'];
   
	if( !empty($email) && !empty($password) ){
		$loginAttempt = new LoginAttempt();
		$loginAttempt->setIpAddress($ip);
		$loginAttempt->setEmail($email);

		//Count amount of attempts
		if(isset($_SESSION['startAttemptTime'])){
			$time = $_SESSION['startAttemptTime'];
		}else{
			$_SESSION['startAttemptTime'] = time();
			$time = $_SESSION['startAttemptTime'];
		}

		$nrAttemptEmail = LoginAttempt::getNumberAttemptsWithEmail($email, $ip, $time);
		$nrAttemptIp = LoginAttempt::getNumberAttemptsWithIp($ip, $time);

		// indien ok: login checken
		//Feature 16: prevent multiple login attempt in a frame of time (limit: 5 attempts in 30 minutes in this case)
		if($nrAttemptIp['count(ipAddress)'] >= 5 || $nrAttemptEmail['count(email)'] >= 5){
			$error = "You tried to many times, please try again after some time";
		}else{
			if($user->canLogin($email, $password)){
				$loginAttempt->setIsSucceed(1);
				$loginAttempt->save();
	
				$_SESSION['user'] = $email ;
				header("Location: index.php");
				
			} else {
				$error = "Sorry, we couldn't log you in.";
				$loginAttempt->setIsSucceed(0);
				$loginAttempt->save();
			}
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
					<button class="ghost "id="signUp" ><a href="register.php"> Sign Up</a></button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>