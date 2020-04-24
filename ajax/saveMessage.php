<?php
  include_once(__DIR__."/../classes/Message.php");
  include_once(__DIR__."/../classes/User.php");
  session_start();
  $user = User::getCurrentUser($_SESSION['user']);

  if(!empty($_POST)){
    
      if(!empty($_POST['message'])){
        $newMessage = new Message();
        $newMessage->setSenderId($user['id']);
        $newMessage->setReceiverId($_POST['receiverId']);
        $newMessage->setMessage($_POST["message"]);
        $newMessage->saveMessage();

        $response = [
          'status' => 'success',
          'body' => [
            'message' => htmlspecialchars($newMessage->getMessage()),
            'timestamp' => date("Y-m-d H:i:s", time())
          ],
          'message' => 'Message send'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
      }else{
        $response = [
          'status' => 'error',
          'message' => 'Message not send'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
      }

      

    
  }

?>