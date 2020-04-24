<?php
  include_once(__DIR__."/../classes/Message.php");

  if(!empty($_POST)){
    
      if(!empty($_POST['reaction'])){
        $message = new Message();
        $message->setReaction($_POST['reaction']);
        $message->addReaction($_POST['messageId']);

        $response = [
          'status' => 'success',
          'body' => htmlspecialchars($message->getReaction()),
          'message' => 'Reaction added'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
      }else{
        $response = [
          'status' => 'error',
          'message' => 'Reaction not added'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
      }

      

    
  }

?>