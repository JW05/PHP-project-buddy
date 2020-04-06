<?php
    include_once(__DIR__."/Db.php");

    class Message {
        private $message;
        private $senderId;
        private $receiverId;
        private $timeStamp;
        private $readed;

        

        /**
         * Get the value of message
         */ 
        public function getMessage()
        {
                return $this->message;
        }

        /**
         * Set the value of message
         *
         * @return  self
         */ 
        public function setMessage($message)
        {
                $this->message = $message;

                return $this;
        }

        /**
         * Get the value of senderId
         */ 
        public function getSenderId()
        {
                return $this->senderId;
        }

        /**
         * Set the value of senderId
         *
         * @return  self
         */ 
        public function setSenderId($senderId)
        {
                $this->senderId = $senderId;

                return $this;
        }

        /**
         * Get the value of receiverId
         */ 
        public function getReceiverId()
        {
                return $this->receiverId;
        }

        /**
         * Set the value of receiverId
         *
         * @return  self
         */ 
        public function setReceiverId($receiverId)
        {
                $this->receiverId = $receiverId;

                return $this;
        }

        /**
         * Get the value of timeStamp
         */ 
        public function getTimeStamp()
        {
                return $this->timeStamp;
        }

        /**
         * Set the value of timeStamp
         *
         * @return  self
         */ 
        public function setTimeStamp($timeStamp)
        {
                $this->timeStamp = $timeStamp;

                return $this;
        }

        /**
         * Get the value of readed
         */ 
        public function getReaded()
        {
                return $this->readed;
        }

        /**
         * Set the value of readed
         *
         * @return  self
         */ 
        public function setReaded($readed)
        {
                $this->readed = $readed;

                return $this;
        }

        public function getAllMessages($userId, $buddyId){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select firstname, avatar, senderId, message, timestamp from `chat-messages` msg left join users u on u.id = msg.senderId where (senderId = '$userId' and receiverId = '$buddyId') or (senderId = '$buddyId' and receiverId = '$userId') order by timestamp asc");
            $statement->execute();

            $allMessages = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $allMessages;
        }

        public function saveMessage(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("insert into `chat-messages` (senderId, receiverId, message) values (:senderId, :receiverId, :message)");

            $senderId = $this->getSenderId();
            $receiverId = $this->getReceiverId();
            $message = $this->getMessage();

            $statement->bindValue(":senderId", $senderId);
            $statement->bindValue(":receiverId", $receiverId);
            $statement->bindValue(":message", $message);

            $result = $statement->execute();

            return $result;
        }

        public function setOnRead($userId, $buddyId){
            $conn = Db::getConnection();
            $statement = $conn->prepare("update `chat-messages` set readed = 1 where (senderId = '$buddyId' and receiverId = '$userId') and readed = 0");
            $result = $statement->execute();

            if(empty($result)){
                throw new Exception("There has been some errors while marking on read.");
            }

            return $result;
        }
    }