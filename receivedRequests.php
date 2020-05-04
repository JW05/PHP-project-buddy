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
           $match->requestAccepted($userId,$buddy);
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
    <h5 class="card-title"><?php echo htmlspecialchars($senderUser->firstName)." ".htmlspecialchars($senderUser->lastName);?></h5>
 
  <form  action="" method="post">
  <input type="hidden" id="buddyId" name="buddyId" value="<?php echo $request['userId']; ?>">

 <h6>Accept request</h6>
 <label for="acceptRequest"></label>
  <select id="acceptRequest" name="requestAccepted">
    <option value="1">Accept match</option>
    <option value="0">Decline match</option>
  </select><br>



  <textarea name="reasonDenial" id="" cols="30" rows="2" placeholder="Reason for dislike"></textarea>
  <input class = "button" type="submit" placeholder="send">
 </form>
  


 
  </div>
</div>
<?php endforeach;?>
</div>