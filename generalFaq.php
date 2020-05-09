<?php
  include_once(__DIR__."/classes/User.php");
  include_once(__DIR__."/classes/faqs.php");


  if(!isset($_SESSION['user'])){
    header("Location: login.php");
  }

     
if(!empty($_POST)){
  try{
    $user = User::getCurrentUser($_SESSION['user']);
    $currentPreference = User::getCurrentPreference($user['id']);

    $allMessages = faq::getAllMessages($user['id']);

    $sentMessage = new faq();
    $sentMessage->setSenderId($_POST($user['id']));
    $sentMessage->setMessage($_POST['message']);

    $result = $sentMessage->saveMessage();
           
   
   
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
          <div class="media mb-3">
          <form action="" method="POST">  
          </div>
          <div class="chatMessages">
            <?php 
              if(!empty($allMessages)):
                foreach($allMessages as $message):
            ?>

            <div class="media mb-2 <?php echo ($message['senderId'] == $buddyId)? "buddy":"float-right"; ?>">
              <?php if($message['senderId'] == $buddyId): ?>
                <img src="img/avatar/<?php echo htmlspecialchars($message['avatar']);?>" class="mr-3 avatar">
              <?php endif;?>


              <div class="media-body">
                <h5 class="mt-0"><?php echo ($message['senderId'] == $buddyId)? htmlspecialchars($message['firstname']): "Me" ;?></h5>
                <?php echo htmlspecialchars($message['message']);?>
                <div class="float-right"> 
                  <small><?php echo htmlspecialchars($message['timestamp']);?></small>
                  <button type="button" class="btn btn-primary btnReact" data-toggle="modal" data-target="#reactions" data-messageid="<?php echo htmlspecialchars($message['id']); ?>">
                    <?php echo (empty($message['reaction']))? "Reaction": htmlspecialchars($message['reaction']);?>
                  </button>
                </div>
              </div>
            </div>

            <?php
                endforeach; 
              endif;?>
          </div>
          <div class="sendMessage">
            <div class="input-group mb-3">
              <input type="text" id="chatMessage" name="message" class="form-control" placeholder="Write here your message..." aria-label="sendMessage">
              <div class="input-group-append">
                
                <input type="submit" value="Send" id="btnSendMessage" background-color="orange"class="btn">
              </div>
            </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="reactions" tabindex="-1" role="dialog" aria-labelledby="reactions" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="row">
                  <button class="btn btn-light col-md-2 reaction">👍</button>
                  <button class="btn btn-light col-md-2 reaction">😆</button>
                  <button class="btn btn-light col-md-2 reaction">😮</button>
                  <button class="btn btn-light col-md-2 reaction">😢</button>
                  <button class="btn btn-ligth col-md-2 reaction">😡</button>
                  <button class="btn btn-light col-md-2 reaction">🤯</button>
                  <button class="btn btn-light col-md-2 reaction">🥳</button>
                  <button class="btn btn-light col-md-2 reaction">❌</button>
                  <button class="btn btn-ligth col-md-2 reaction">✔️</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>