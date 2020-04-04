<?php 
include_once(__DIR__."/classes/User.php");

/* check the Id of the email entered*/
if( !empty($_POST) ){
	$user = new User();
	$email = $_POST['email'];
	
   
	if( !empty($email)){
		
		// Email not empty , processing request
		if($user->getUserId2($email)){
        /* user id found , process the buddys search with the found ID */

        /* TO CREATE HOW USER ID TRANSFER ...*/

						
		} else {
      // email adress not found, so unexisting user
			$error = "Sorry, we couldn't find your Email adress, please enter an existing email adress.";
		}
	} else {
		// email adress is empty
		$error = "Email is required for looking up the Buddys.";
	}
}
/* end check the Id of the email entered*/

/* search buddy ids from the ID of the email */
$buddys = User::getBuddys($userid);

/* end buddy id search */

/* retrieve the buddy info data */ 
  if( !empty($buddys)){
  
         $buddy = new User();
         $buddy->setFirstname ($_POST['firstname']);
         $buddy->setLastname ($_POST['lastname']);
         $buddy->setEmail ($_POST['email']);  
         $buddy->setAvatar ($_POST['avatar']);

      }
/* end retrieve buddy data*/
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuddyPage</title>
 <!---  <link rel="stylesheet" href="css/style.css">-->
    
</head>
<body>

<div class="container" id="container">
		<div class="form-container sign-in-container">
			<form action="" id ="loginForm" method="post">
				<h1>Search your Buddy</h1>
				
				<?php if (isset($error)): ?>
					<div class="form__error">
						<p> <?php echo $error;?></p>
					</div>
				<?php endif; ?>
				<input type="email" placeholder="Email" name="email" />				
				<button>Search</button>
			</form>
		</div>
		<div class="signup-container">
			<div class="panel">
				<div class="panel-right">
					<h1>Your Buddys Buddys</h1>
					<?php foreach($buddys as $buddy): ?>
          <h2><?php echo $buddy['firstname']; ?></h2>
          <h2><?php echo $buddy['lastname']; ?></h2>
          <h2><?php echo $buddy['email']; ?></h2>
          <h2><?php echo $buddy['avatar']; ?></h2>
          <?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>


</body>
</html>