<?php
    include_once(__DIR__."/classes/Upload.php");
    
    var_dump($_POST);
    if(!empty($_POST)){
        echo($_FILES['avatarUpload']['name']);
        echo($_FILES['avatarUpload']['name']);
        if(!empty($_FILES['avatarUpload']['name'])){
            try{
                $uploadAvatar = new Upload();
                $uploadAvatar->setTargetDir("img/avatar/");
                $target_dir = $uploadAvatar->getTargetDir();
                $uploadAvatar->setFileName($target_dir . basename($_FILES["avatarUpload"]["name"]));
                $uploadAvatar->setFileType(strtolower(pathinfo($uploadAvatar->getFileName(),PATHINFO_EXTENSION)));
                $uploadAvatar->setFileSize($_FILES["avatarUpload"]["size"]);

                $uploadAvatar->saveAvatar($_FILES["avatarUpload"]["tmp_name"]);
            }catch(\Throwable $th){
                $error = $th->getMessage();
            }
        }else{
            $error = "Avatar not found.";
        }
    }
    
    /*
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    
    */
    
    
    
