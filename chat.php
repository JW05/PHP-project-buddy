<?php
  include_once(__DIR__."/classes/User.php");
  include_once(__DIR__."/classes/Message.php");
  include_once(__DIR__."/classes/Buddy.php");
  session_start();

  try{
    $user = User::getCurrentUser($_SESSION['user']);
    $currentPreference = User::getCurrentPreference($user['id']);

    if(isset($_GET['buddyId']) && !empty($_GET['buddyId'])){
      $buddyId = htmlspecialchars($_GET['buddyId']);
    }else{
      header("Location: index.php");
    }

    $buddyExist = Buddy::buddyExist($user['id'], $buddyId);
    if(!$buddyExist){
      $newBuddy = new Buddy();
      $newBuddy->setUserId($user['id']);
      $newBuddy->setBuddyId($buddyId);
      $newBuddy->save();
    }

    $matchInfo = User::getUserInfo($buddyId);
    $allMessages = Message::getAllMessages($user['id'], $buddyId);
    if(!empty($allMessages)){
      $messageReaded = Message::setOnRead($user['id'], $buddyId);
    }

    $getAllBuddies = Buddy::getAllBuddies($user['id']);
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

<?php
        include_once(__DIR__."/nav.inc.php");
    ?>



  <div class="chatContainer">
    <div class="row">
      <div class="col-md-3">
        <h2>Chat</h2>
        <div class="list-group">
          <?php 
            foreach($getAllBuddies as $buddy):
              //Get info of the buddy
              $buddyInfo = ($buddy->userId != $user['id'])? User::getUserInfo($buddy->userId): User::getUserInfo($buddy->buddyId);
          ?>
            <a href="?buddyId=<?php echo htmlspecialchars($buddyInfo->userId); ?>" class="list-group-item list-group-item-action <?php echo ($buddyId == $buddyInfo->userId)? "active":""; ?>"><?php echo htmlspecialchars($buddyInfo->firstname." ".$buddyInfo->lastname); ?></a>
          <?php endforeach; ?>
            </div>
      </div>
      <div class="col-md-9">
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
              <input type="button" id="btnSendMessage" class="btn btn-primary" data-receiverid="<?php echo $matchInfo->userId;?>" value="Send">
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
                  <button class="btn btn-light col-md-2 reaction">❤</button>
                  <button class="btn btn-light col-md-2 reaction">😆</button>
                  <button class="btn btn-light col-md-2 reaction">😮</button>
                  <button class="btn btn-light col-md-2 reaction">😢</button>
                  <button class="btn btn-ligth col-md-2 reaction">😡</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="js/chat.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>