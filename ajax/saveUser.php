<?php 
    include_once(__DIR__."/../classes/User.php");
    
    session_start();
    
        $user = User::getCurrentUser($_SESSION['user']);
        $userId = $user['id'];

    if(!empty($_POST)){

        //new user
        $u= new User();
        $u->setEmail($_POST["emailId"]);
        $u->setEmail($_POST["email"]);
        $u->setUserId($userId);
        //save()
        $u->saveUser();
        //succes teruggeven
        $reponse = [
            'status' => 'success',
            'body' => htmlspecialchars($u->getEmail()),
            'message' => 'User saved'
        ];
            header('Content-Type: application/json');
            echo json_encode($reponse); 

    }




?>