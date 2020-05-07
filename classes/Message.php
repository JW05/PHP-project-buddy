<?php
    include_once(__DIR__."/Db.php");

    class Message {
        private $message;
        private $senderId;
        private $receiverId;
        private $timeStamp;
        private $readed;
        private $reaction;

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
                if(empty($message)){
                     throw new Exception("You cannot send empty messages");
                }
                
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

         /**
         * Get the value of reaction
         */ 
        public function getReaction()
        {
                return $this->reaction;
        }

        /**
         * Set the value of reaction
         *
         * @return  self
         */ 
        public function setReaction($reaction)
        {
                $this->reaction = $reaction;

                return $this;
        }

        public static function getAllMessages($userId, $buddyId){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select msg.id, firstname, avatar, senderId, message, reaction, timestamp from `chat_messages` msg left join users u on u.id = msg.senderId where (senderId = :userId and receiverId = :buddyId) or (senderId = :buddyId and receiverId = :userId) order by timestamp asc");
            $statement->bindValue(":userId", $userId);
            $statement->bindValue(":buddyId", $buddyId);
            $statement->execute();

            $allMessages = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $allMessages;
        }

        public function getMessageId(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select id from `chat_messages` where senderId = :senderId and receiverId = :receiverId order by timestamp desc limit 1");
            
            $senderId = $this->getSenderId();
            $receiverId = $this->getReceiverId();
            $statement->bindValue(":senderId", $senderId);
            $statement->bindValue(":receiverId", $receiverId);

            $statement->execute();

            $selectedMessage = $statement->fetch(PDO::FETCH_ASSOC);

            return $selectedMessage['id'];
        }

        public static function getUnreadNotifBySender($userId){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select senderId from `chat_messages` where receiverId = :userId and readed = 0 group by senderId order by timestamp desc");
            $statement->bindValue(":userId", $userId);
            $statement->execute();

            $notifMessage = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $notifMessage;
        }

        public function saveMessage(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("insert into `chat_messages` (senderId, receiverId, message) values (:senderId, :receiverId, :message)");

            $senderId = $this->getSenderId();
            $receiverId = $this->getReceiverId();
            $message = $this->getMessage();

            $statement->bindValue(":senderId", $senderId);
            $statement->bindValue(":receiverId", $receiverId);
            $statement->bindValue(":message", $message);

            $result = $statement->execute();

            return $result;
        }

        public function addReaction($messageId){
            $conn = Db::getConnection();
            $statement = $conn->prepare("update `chat_messages` set reaction = :reaction where id = :messageId");
            $reaction = $this->getReaction();

            $statement->bindValue(":messageId", $messageId);
            $statement->bindValue(":reaction", $reaction);

            $result = $statement->execute();
    
            if(empty($result)){
                throw new Exception("There has been some setting the reaction.");
            }
    
            return $result;
        }

        public function setOnRead($userId, $buddyId){
            $conn = Db::getConnection();
            $statement = $conn->prepare("update `chat_messages` set readed = 1 where (senderId = :buddyId and receiverId = :userId) and readed = 0");
            $statement->bindValue(":userId", $userId);
            $statement->bindValue(":buddyId", $buddyId);
            
            $result = $statement->execute();

            if(empty($result)){
                throw new Exception("There has been some errors while marking on read.");
            }

            return $result;
        }

    }
?>