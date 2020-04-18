<?php
  include_once(__DIR__."/classes/User.php");

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
  <div class="card col-md-4" style="width: 18rem;">
  <img src="img/avatar/<?php echo htmlspecialchars($matchInfo->avatar);?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo htmlspecialchars($matchInfo->firstname)." ".htmlspecialchars($matchInfo->lastname);?></h5>
    <?php
      if(!empty($matchInfo->description)):
    ?>
      <blockquote class="blockquote mb-0">
        <p><?php echo htmlspecialchars($matchInfo->description);?></p>
        <footer class="blockquote-footer">Someone famous in <cite title="Source Title"><?php echo htmlspecialchars($matchInfo->location);?></cite></footer>
      </blockquote>
    <?php endif; ?>
    <p class="card-text"><?php echo User::printReasonMatch($currentPreference, $matchInfo);?></p>
    <a href="#" class="btn btn-primary">Send buddy request</a>
    <a href="chat.php?buddyId=<?php echo htmlspecialchars($matchInfo->userId); ?>" class="btn btn-primary">Open chat</a>
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