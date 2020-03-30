<?php
    include_once(__DIR__."/classes/Upload.php");
    
    
        
    try{
        $uploadAvatar = new Upload();
        $uploadAvatar->setTargetDir("img/avatar/");
        $target_dir = $uploadAvatar->getTargetDir();
        $uploadAvatar->setFileName($target_dir . basename($_FILES["avatarUpload"]["name"]));
        $uploadAvatar->setFileType(strtolower(pathinfo($uploadAvatar->getFileName(),PATHINFO_EXTENSION)));
        $uploadAvatar->setFileSize($_FILES["avatarUpload"]["size"]);

        $codeGen = "Ze2-2ad";
        if($uploadAvatar->saveAvatar($_FILES["avatarUpload"]["tmp_name"], $user['id'].md5($codeGen))){
            $currentUser->setAvatar($userId.md5($codeGen).".".$uploadAvatar->getFileType());
        }
        
    }catch(\Throwable $th){
        $error = $th->getMessage();
    }
        
    
    
    
