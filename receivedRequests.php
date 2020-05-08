<?php
  include_once(__DIR__."/classes/User.php");
  include_once(__DIR__."/classes/Buddy.php");

  $user = User::getCurrentUser($_SESSION['user']);
  $userId = $user['id'];
  $receivedRequest = Buddy::showcaseMatches($user['id']);

  if(!empty($_POST) && isset($_POST['requestAction'])){
     
    try {
          $buddy = $_POST['buddyId'];
           $match = new Buddy();
           $match->setRequestAccepted($_POST['requestAccepted']);
           $match->setReasonDenial($_POST['reasonDenial']);
           $match->setBuddyId($buddy);
           $match->setUserId($userId);
           $match->requestAccepted();
    } catch (\Throwable $th) {
      $error =$th->getMessage();
    }
           
  }
?>

<div class="row">

<?php foreach($receivedRequest as $request):
  $senderUser = User::getUserInfo($request['userId']); ?>
  <div class="col-12 p-1">
    <div class="card">
      <div class="card-body">
      <img src="img/avatar/<?php echo htmlspecialchars($senderUser->avatar);?>" class="card-img-top rounded-circle mx-auto d-block" alt="...">
        <h5 class="card-title text-center"><?php echo htmlspecialchars($senderUser->firstname)." ".htmlspecialchars($senderUser->lastname);?></h5>
  
        <form  action="" method="post" id="requestForm">
          <input type="hidden" id="buddyId" name="buddyId" value="<?php echo $request['userId']; ?>">
          <div class="form-group d-flex flex-column text-left">
            <label for="acceptRequest">Accept request</label>
            <select id="acceptRequest" name="requestAccepted">
              <option value="1">Accept match</option>
              <option value="0">Decline match</option>
            </select>
          </div>
          <div class="form-group text-left">
            <label for="reasonDenial">Reason</label>
            <textarea name="reasonDenial" id="reasonDenial" cols="30" rows="2" placeholder="Reason for dislike"></textarea>
          </div>
          <input class = "button" type="submit" name="requestAction" placeholder="send">
        </form>
  
      </div>
    </div>
  </div>
<?php endforeach;?>
</div>