<?php
  include_once(__DIR__."/classes/User.php");

      $user = User::getCurrentUser($_SESSION['user']);
      $userId = $user['id'];
      $receivedRequest = User::showcaseMatches($user['id']);
     

  if(!empty($_POST)){
    
     
    try {
          $buddy = $_POST['buddyId'];
           $match = new User();
           $match->setRequestAccepted($_POST['requestAccepted']);
           $match->setReasonDenial($_POST['reasonDenial']);
           $match->setBuddy($buddy);
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
  <div class="card col-md-4" style="width: 3rem;">

  <img src="img/avatar/<?php echo htmlspecialchars($senderUser->avatar);?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo htmlspecialchars($senderUser->firstname)." ".htmlspecialchars($senderUser->lastname);?></h5>
 
  <form  action="" method="post">
  <input type="hidden" id="buddyId" name="buddyId" value="<?php echo $request['userId']; ?>">

 <label for="acceptRequest">Accept request</label>
  <select id="acceptRequest" name="requestAccepted">
    <option value="1">Accept match</option>
    <option value="0">Decline match</option>
  </select><br>


  <label for="reasonDenial">Reason</label>
  <textarea name="reasonDenial" id="reasonDenial" cols="30" rows="2" placeholder="Reason for dislike"></textarea>
  <input class = "button" type="submit" placeholder="send">
 </form>
  


 
  </div>
</div>
<?php endforeach;?>
</div>