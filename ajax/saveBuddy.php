<?php
  include_once(__DIR__."/../classes/Buddy.php");
  include_once(__DIR__."/../classes/User.php");
  session_start();
  $user = User::getCurrentUser($_SESSION['user']);

  if(!empty($_POST)){
    
      $buddyExist = Buddy::buddyExist($user['id'], $_POST['buddyId']);
      if(!$buddyExist){
        $newBuddy = new Buddy();
        $newBuddy->setUserId($user['id']);
        $newBuddy->setBuddyId($_POST['buddyId']);
        $newBuddy->save();

        $response = [
          'status' => 'success',
          'message' => 'requestSend'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
      }else{
        Buddy::cancelRequest($user['id'], $_POST['buddyId']);

        $response = [
          'status' => 'success',
          'message' => 'requestCanceled'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
      }

      

    
  }

?>