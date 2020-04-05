<?php 
//JENS 
include_once(__DIR__."/classes/User.php");

  
  session_start();

    $user = User::getCurrentUser($_SESSION['user']);
    $userId = $user['id'];

    // search buddys from the ID of the session
    $buddys = User::getBuddys($userId);
    // end buddy search list 

    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuddyPage</title>
  <link rel="stylesheet" href="css/style.css">
  <style>

@media only screen and (max-width: 600px) {
 	.panel{
	/*display:flex;*/
	display:none;
	
	
  }
  .panel-right{
	display:flex;
	
	
	
	
  }
  .buddy-left-container{
	
  }
  .buddy-right-container{
	
  }
  
  }
  </style>
    
</head>
<body>
<div class="container" id="container">
		<div class="form-container buddy-left-container">
			<form action="" id ="buddyForm" method="post">
				<h1>All your buddys</h1>
				
        <?php if (isset($error)): ?>
					<div class="form__error">
						<p> <?php echo $error;?></p>
					</div>
				<?php endif; ?>
				</form>
		</div>
		<div class="buddy-right-container">
			<div class="panel">
				<div class="panel-right">
					<h1>Your Buddys are </h1>
          
		  <?php foreach($buddys as $buddy): ?>
		  <h2><?php echo $buddy['avatar']; ?></h2>
          <h2><?php echo $buddy["firstname"]; ?></h2>
          <h2><?php echo $buddy['lastname']; ?></h2>
          <h2><?php echo $buddy['email']; ?></h2>
          <?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>


</body>
</html>