<?php
  include_once(__DIR__."/classes/User.php");
  include_once(__DIR__."/classes/faqs.php");


  if(!isset($_SESSION['user'])){
    header("Location: login.php");
  }

  
  $user = User::getCurrentUser($_SESSION['user']);

  $allMessages = faq::getAllMessages();
if(!empty($_POST)){
  try{

    $sentMessage = new faq();
    $sentMessage->setSenderId($user['id']);
    $sentMessage->setMessage($_POST['message']);

    $sentMessage->saveMessage();
           
   
   
  }
  catch(\Throwable $th)
  {
      //throw $th;
    $error = $th->getMessage();
  }
}


?>




<div class="chatContainer">
  <div class="row">
    <div class="col-md-3">
      <h2>categories</h2>
      <div class="list-group">
  
          <ul>
              <li><a href="#"> general</a></li>
              <li><a href="#"> coding</a></li>
              <li><a href="#"> school</a></li>
          </ul>
          
        
      </div>
    </div>
    <div class="col-md-9">
      <?php if(isset($error)): ?>
          <div class="form__error">
            <p><?php echo $error; ?></p>
              
          </div>
      <?php endif; ?>
        
      <h2> General FAQ chat</h2>
      
      
      
      <form action="" method="POST"> 
        <div class="chatMessages">
          <?php 
            
              foreach($allMessages as $message):
                  $formUser = User::getUserInfo($user['id']);
          ?>

          <div class="media mb-2">
            
              <img src="img/avatar/<?php echo htmlspecialchars($formUser->avatar);?>" class="mr-3 avatar">
          


            <div class="media-body">
              <h5 class="mt-0"><?php echo htmlspecialchars($formUser->firstname);?></h5>
              <?php echo htmlspecialchars($message['message']);?>
              <div class="float-right"> 
                <small><?php echo htmlspecialchars($message['timestamp']);?></small>
              </div>
            </div>
          </div>

          <?php
              endforeach; 
            ?>
        </div>
        <div class="sendMessage">
          <div class="input-group mb-3">
            <input type="text" id="chatMessage" name="message" class="form-control" placeholder="Write here your message..." aria-label="sendMessage">
            <div class="input-group-append">
              
              <input type="submit" value="Send" id="btnSendMessage" background-color="orange"class="btn">
            </div>
          </div>
        </div>
      </form> 
      
    </div>
  </div>
</div>
  