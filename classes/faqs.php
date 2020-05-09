<?php
include_once(__DIR__."/Db.php");
include_once("User.php");

class faq
{
    //FAQ general
    private $questions;
    private $answers;


    //FAQ all chat
    
    private $senderId;
    private $timeStamp;
    private $message;
    private $reaction;
    



public static function showcaseFaq()
{
    $conn = Db::getConnection();
    $statement = $conn->prepare("select * from faqs");
    $statement->execute();

    $faqs = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $faqs;

}    
public function createFaq($questions,$answers)
{
    $conn = Db::getConnection();
    $statement = $conn->prepare("insert into faqs (questions, answers) values (:questions, :answers)");
    $questions = $this->getQuestions();
    $answers = $this->getanswers();

    $statement->bindValue(":questions", $questions);
    $statement->bindValue(":answers", $answers);

    $result = $statement->execute();
    return $result;
}

public static function getAllMessages($userId){
    $conn = Db::getConnection();
    $statement = $conn->prepare("select msg.id, firstname, avatar, senderId, message, reaction, timestamp from `faqs_messages` msg left join users u on u.id = msg.senderId where (senderId = :userId) order by timestamp asc");
    $statement->bindValue(":userId", $userId);
    $statement->execute();

    $allMessages = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $allMessages;
}


public static function getMessageId($senderId){
    $conn = Db::getConnection();
    $statement = $conn->prepare("select id from `faqs_messages` where senderId = :senderIdorder by timestamp desc limit 1");
    
    $statement->bindValue(":senderId", $senderId);

    $statement->execute();

    $selectedMessage = $statement->fetch(PDO::FETCH_ASSOC);

    return $selectedMessage['id'];
}


public function saveMessage(){
    $conn = Db::getConnection();
    $statement = $conn->prepare("insert into `faqs_messages` (senderId, message) values (:senderId, :message)");

    $senderId = $this->getSenderId();
    $message = $this->getMessage();

    $statement->bindValue(":senderId", $senderId);
    $statement->bindValue(":message", $message);

    $result = $statement->execute();

    return $result;
}

public function addReaction($messageId){
    $conn = Db::getConnection();
    $statement = $conn->prepare("update `faqs_messages` set reaction = :reaction where id = :messageId");
    $reaction = $this->getReaction();

    $statement->bindValue(":messageId", $messageId);
    $statement->bindValue(":reaction", $reaction);

    $result = $statement->execute();

    if(empty($result)){
        throw new Exception("There has been some setting the reaction.");
    }

    return $result;
}















    public function getQuestions()
    {
        return $this->questions;
    }

    public function setQuestions($questions)
    {
        $this->questions = $questions;

        return $this;
    }


    public function getAnswers()
    {
        return $this->answers;
    }

    public function setAnswers($answers)
    {
        $this->answers = $answers;

        return $this;
    }


    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }


    public function getSenderId()
    {
        return $this->senderId;
    }

    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;

        return $this;
    }


    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }


    public function getReaction()
    {
        return $this->reaction;
    }

    public function setReaction($reaction)
    {
        $this->reaction = $reaction;

        return $this;
    }
    
    public function getTimeStamp()
    {
        return $this->timeStamp;
    }

    public function setTimeStamp($timeStamp)
    {
        $this->timeStamp = $timeStamp;

        return $this;
    }
}