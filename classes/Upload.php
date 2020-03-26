<?php

    class Upload{
        private $targetDir;
        private $fileName;
        private $fileType;
        private $fileSize;

        

        /**
         * Get the value of targetDir
         */ 
        public function getTargetDir()
        {
                return $this->targetDir;
        }

        /**
         * Set the value of targetDir
         *
         * @return  self
         */ 
        public function setTargetDir($targetDir)
        {
                $this->targetDir = $targetDir;

                return $this;
        }

        

        /**
         * Get the value of fileName
         */ 
        public function getFileName()
        {
                return $this->fileName;
        }

        /**
         * Set the value of fileName
         *
         * @return  self
         */ 
        public function setFileName($fileName)
        {
                $this->fileName = $fileName;

                return $this;
        }

        

        /**
         * Get the value of fileType
         */ 
        public function getFileType()
        {
                return $this->fileType;
        }

        /**
         * Set the value of fileType
         *
         * @return  self
         */ 
        public function setFileType($fileType)
        {
                $this->fileType = $fileType;

                return $this;
        }


        /**
         * Get the value of fileSize
         */ 
        public function getFileSize()
        {
                return $this->fileSize;
        }

        /**
         * Set the value of fileSize
         *
         * @return  self
         */ 
        public function setFileSize($fileSize)
        {
                $this->fileSize = $fileSize;

                return $this;
        }

        public function saveAvatar($currentFile){
            // Allow certain file formats
            if($this->fileType != "jpg" && $this->fileType != "png" && $this->fileType != "jpeg"
            && $this->fileType != "gif" ) {
                throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            }

            // Check file size
            if ($this->fileSize > 5000000) {
                throw new Exception("Sorry, your file is too large.");
            }

            if (move_uploaded_file($currentFile, $this->fileName)) {
                $msg = "The file ". basename( $this->fileName). " has been uploaded.";
            } else {
                throw new Exception("Sorry we could upload your avatar.");
            }

            return $msg;
        }
    }