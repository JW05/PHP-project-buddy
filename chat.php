<?php
  include_once(__DIR__."/classes/User.php");
  include_once(__DIR__."/classes/Message.php");
  session_start();

  try{
    $user = User::getCurrentUser($_SESSION['user']);
    $currentPreference = User::getCurrentPreference($user['id']);

    if(isset($_GET['buddyId'])){
      $buddyId = htmlspecialchars($_GET['buddyId']);
    }else{
      header("Location: index.php");
    }

    $matchInfo = User::getUserInfo($buddyId);
    $allMessages = Message::getAllMessages($user['id'], $buddyId);
    if(!empty($allMessages)){
      $messageReaded = Message::setOnRead($user['id'], $buddyId);
    }
  }catch(\Throwable $th){
      //throw $th;
    $error = $th->getMessage();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="chatContainer">
    <?php if(isset($error)): ?>
				<div class="form__error">
					<p><?php echo $error; ?></p>
						
				</div>
    <?php endif; ?>
    <h2><?php echo htmlspecialchars($matchInfo->firstname)." ".htmlspecialchars($matchInfo->lastname);?></h2>
    <div class="media mb-3">
        <div class="media-body">
          <?php echo User::printReasonMatch($currentPreference, $matchInfo);?>
        </div>
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
          <small class="float-right"><?php echo htmlspecialchars($message['timestamp']);?></small>
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
          <input type="button" id="btnSendMessage" class="btn btn-primary" data-receiverid="<?php echo $matchInfo->userId;?>" value="Send">
        </div>
      </div>
    </div>
  </div>
  <script src="js/chat.js"></script>
</body>
</html>