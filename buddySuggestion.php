<?php
  include_once(__DIR__."/classes/User.php");
  session_start();

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

    $perfectMatches = array();

    //For each profile calculate the matchScore
    foreach($allMatch as $match){
      $score = calcMatch($currentPreference, $match);
      $perfectMatches[$match['userId']] = $score;
    }    

    //Sort the results from high to low score
    arsort($perfectMatches);

    var_dump($perfectMatch);
  }catch(\Throwable $th){
    //throw $th;
    $error = $th->getMessage();
  }
?>

<div class="suggestion">
  <?php 
    foreach($perfectMatches as $id => $value):
      $matchInfo = User::getUserInfo($id);
      echo $matchInfo;
  ?>
  <div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
  <?php endforeach;?>
</div>