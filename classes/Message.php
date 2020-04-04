<?php
    include_once(__DIR__."/Db.php");

    class Message {
        private $message;
        private $senderId;
        private $receiverId;
        private $timeStamp;
    }