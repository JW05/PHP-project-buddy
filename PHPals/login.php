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
		
			header("Location: index.php");
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
	<div class="header"><h1 class="title">PHPals</h1></div>

	<div class="phpalsLogin">
		<div class="form form--login">
			<form action="" method="post">
				<h2 form__title>Log In</h2>

				<?php if (isset($error)): ?>
				<div class="form__error">
					<p>
						<?php echo $error;?>
					</p>
				</div>
				<?php endif; ?>

				<div class="form__field">
					
					<input type="text" name="email" value="email">
				</div>
				<div class="form__field">
					
					<input type="password" name="password">
				</div>

				<div class="form__field">
					<input type="submit" value="Sign in" class="btn">
				</div>

				<div>
					<p>Not registered yet?<a href="register.php">Sign up here</a></p>
				</div>
			</form>
		</div>
	</div>
</body>
</html>