<?php
include_once(__DIR__."/Db.php");

class faq
{

    private $questions;
    private $answers;

    






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


















    /**
     * Get the value of questions
     */ 
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Set the value of questions
     *
     * @return  self
     */ 
    public function setQuestions($questions)
    {
        $this->questions = $questions;

        return $this;
    }

    /**
     * Get the value of answers
     */ 
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Set the value of answers
     *
     * @return  self
     */ 
    public function setAnswers($answers)
    {
        $this->answers = $answers;

        return $this;
    }
}