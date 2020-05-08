<?php
  include_once(__DIR__."/classes/User.php");
  include_once(__DIR__."/classes/Buddy.php");

  try{
    function calcMatch($user, $match){
      $score = 0;
      if($user->location == $match['location']){
        $score += 1;
      }

      if($user->preference == $match['preference']){
        $score += 1;
      }

      if($user->genre == $match['genre']){
        $score += 1;
      }

      if($user->likesToParty == $match['likesToParty']){
        $score += 1;
      }

      return $score;
    }

    $user = User::getCurrentUser($_SESSION['user']);
    $currentPreference = User::getCurrentPreference($user['id']);

    //Get matching profiles
    $allMatch = User::getMatchingProfiles($currentPreference);

    $matchScores = array();

    //For each profile calculate the matchScore
    foreach($allMatch as $match){
      $score = calcMatch($currentPreference, $match);
      $matchScores[$match['userId']] = $score;
    }    

    //Sort the results from high to low score
    arsort($matchScores);

  }catch(\Throwable $th){
    //throw $th;
    $error = $th->getMessage();
  }
?>

<div class="row">
  <?php 
    if(!empty($matchScores)):
      foreach($matchScores as $id => $value):
        $matchInfo = User::getUserInfo($id);
  ?>
  <div class="col-md-4 p-1">
    <div class="card">
      <div class="card-body text-center">
        <img src="img/avatar/<?php echo htmlspecialchars($matchInfo->avatar);?>" class="card-img-top mx-auto d-block rounded-circle" alt="...">
        <h5 class="card-title"><?php echo htmlspecialchars($matchInfo->firstname)." ".htmlspecialchars($matchInfo->lastname);?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($matchInfo->location);?></h6>
        <?php
          if(!empty($matchInfo->description)):
        ?>
          <blockquote class="blockquote">
            <p class="mb-0"><?php echo htmlspecialchars($matchInfo->description);?></p>
          </blockquote>
        <?php endif; ?>
        <p class="card-text text-left my-1"><?php echo User::printReasonMatch($currentPreference, $matchInfo);?></p>
        <a href="#" class="sendRequest btn rounded-pill <?php echo (Buddy::buddyExist($user['id'], htmlspecialchars($matchInfo->userId)))?"btn-danger":"btn-primary";?>" data-buddyid="<?php echo htmlspecialchars($matchInfo->userId); ?>"> <?php echo (Buddy::buddyExist($user['id'], htmlspecialchars($matchInfo->userId)))?"Cancel request":"Send request";?>  </a>
        <a href="chat.php?buddyId=<?php echo htmlspecialchars($matchInfo->userId); ?>" class="btn rounded-pill btn-primary">Open chat</a>
      </div>
    </div>
  </div>
  <?php 
      endforeach;
    else:
      if(!empty($error)){
        echo $error;
      }else{
        echo "No match found.";
      }
    endif;
  ?>
</div>