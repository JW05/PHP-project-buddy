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

    function printReasonMatch($user, $match){
      $reason = "This person ";
      $i = 1;

      if($user->genre == $match->genre){
        $reason .= "also likes to listen to ".$match->genre;
        $i++;
      }

      if($i > 1 && $user->preference == $match->preference){
        $reason .= ", also does ".$match->preference;
      }else if($user->preference == $match->preference){
        $reason .= "also does ".$match->preference;
        $i++;
      }

      if($i > 1 && $user->location == $match->location){
        $reason .= ", also lives in ".$match->location;
      }else if($user->location == $match->location){
        $reason .= "also lives in ".$match->location;
        $i++;
      }

      if($user->likesToParty == $match->likesToParty && $match->likesToParty == 1){
        $reason .= " and also to party";
      }else if($user->likesToParty == $match->likesToParty && $match->likesToParty == 0){
        $reason .= " and also doesn't like to party";
      }

      return $reason;
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
  <img src="img/avatar/<?php echo $matchInfo->avatar;?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo $matchInfo->firstName." ".$matchInfo->lastName;?></h5>
    <?php
      if(!empty($matchInfo->description)):
    ?>
      <blockquote class="blockquote mb-0">
        <p><?php echo $matchInfo->description;?></p>
        <footer class="blockquote-footer">Someone famous in <cite title="Source Title"><?php echo $matchInfo->location;?></cite></footer>
      </blockquote>
    <?php endif; ?>
    <p class="card-text"><?php echo printReasonMatch($currentPreference, $matchInfo);?></p>
    <a href="#" class="btn btn-primary">Send buddy request</a>
  </div>
</div>
  <?php 
      endforeach;
    else:
      echo "Geen match gevonden.";
    endif;
  ?>
</div>