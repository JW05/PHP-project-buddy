<?php
include_once(__DIR__."/Db.php");

class faq
{


public function showcaseFaq()
{
    $conn = Db::getConnection();
            
    $statement = $conn->prepare("select * from faqs");
    $res = PDO($statement) or die(mysqli_error());
    if(mysqli_num_rows($res)> 0)
    {
        while($row = mysqli_fetch_assoc($res))
        {
            $questions = $row['questions'];
            $answers = $row['questions'];
        }
    }
    else
    {
        echo "there are no FAQ's to be shown";
    }







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