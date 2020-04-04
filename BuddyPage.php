




<?php 
include_once(__DIR__."/classes/User.php");


if( !empty($_POST) ){
	$user = new User();
	$email = $_POST['email'];
	
   
	if( !empty($email)){

		
		// indien ok: login checken
		if($user->getUserId2($email)){
			session_start();
			$_SESSION['user'] = $email ;
		
			
		} else {
			$error = "Sorry, we couldn't find your buddy.";
		}
	} else {
		// indien leeg: error generen
		$error = "Email is required.";
	}
}















if(!empty($_POST)){
  
  
         $buddy = new User();
         $buddy->setEmail ($_POST['email']);        
      }

$buddys = User::getBuddys();












?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuddyPage</title>
 <!--   <link rel="stylesheet" href="css/style.css"> -->
    <!--<style>
        * {
        box-sizing: border-box;
        }
        #BuddyInput {           
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 1px solid lightgrey;
        margin-bottom: 12px;
        }
        .BuddyBox{
           display:grid;
           width:499px;
           padding: 50px;
           margin-right:auto;
           margin-left:auto;
          
        }
        .MijnBuddys{
            color:#FFF699;
            padding:20px;
            margin-bottom:50px;
            border: 5px solid #FFF699;
            width: 100%;
            border-radius: 15%;
            text-align:center;
        }
        .BuddysBuddys{
            color:#a4fcaf;
            padding:20px;
            border: 5px solid #a4fcaf;
            width: 100%;
            border-radius: 15%;
            text-align:center;
        }
        @media(min-width: 1200px) {
           
        .BuddyBox{
           display:grid;  
           width:1100px;       
           grid-template-columns:auto auto auto;
           
                    
        }
        .MijnBuddys{
          position:relative;
          left:50px;
          top:150px;            
             
        }
        .BuddysBuddys{
          position:relative;
          left:200px;
          top:150px;       
            
        }
        }
        @media(min-width: 1400px) {
           
           .BuddyBox{
              display:grid;
              width:1100px;
              grid-template-columns:auto auto auto;
              
              
                       
           }
           .MijnBuddys{
            position:relative;
             right:375px;
             top:150px;          
                
           }
           .BuddysBuddys{
             position:relative;
             left:185px;
             bottom:100px;         
               
           }
   
           }
</style>-->
</head>
<body>
<!--<input type="text" id="BuddyInput" onkeyup="myFunction()" placeholder="Zoek buddy's" title="Typ een buddy">

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("BuddyInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>-->

<!--<div class="BuddyBox">
    <div class="MijnBuddys">
        <h1>Jouw Buddy's</h1>
        <p>buddy1</p>
        <p>buddy2</p>
        <p>buddy3</p>
        <p>buddy4</p>
        <p>buddy5</p>
        <br>
    </div>
    <div class="BuddysBuddys">
        <h1>Jouw Buddy's Buddy's</h1>
        <p>buddy1</p>
        <p>buddy2</p>
        <p>buddy3</p>
        <p>buddy4</p>
        <p>buddy5</p> 
    </div>
</div> -->
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
          <h2><?php echo $buddy['email']; ?></h2>
          <?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>


</body>
</html>