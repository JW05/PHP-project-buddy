<?php
include_once(__DIR__."/Db.php");

class faq
{


public function showcaseFaq()
{
    $conn = Db::getConnection();
    $statement = $conn->prepare("select * from faqs");   // where question = $question and anwser = $anwser
    
    $statement->execute();

    $faqs = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $faqs;

}    
    








public function createFaq()
{
    $conn = Db::getConnection();
}
public function editFaq()
{
    $conn = Db::getConnection();
}

















}