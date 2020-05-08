<?php 
    include_once(__DIR__."/classes/User.php");
    include_once(__DIR__."/classes/faqs.php");
    session_start();

    
   

    try
    {
        if(!empty($_POST))
        {
            $user = User::getCurrentUser($_SESSION['user']);
    
            $faqs = new faq();
            $faqs->setQuestions($_POST['questions']);
            $faqs->setAnswers($_POST['answers']);
      
            $result = $faqs->createFaq($questions,$answers);
            // FAQ REDIRECT
            if($result) {
                header('Location: FAQ.php');
               }
        }
       
    }
    catch(\Throwable $th)
    {
    }
      

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>FAQ PHPals</title>
</head>
<body>
<?php include_once(__DIR__."/nav.inc.php");?> 



<div class="faq-container">
<h1>Frequently Asked Questions</h1>

<form action="" method="post">

  <div class="questions">
  <label for="questions"><h2>What is the Question?</h2></label><br>
  <input type="text" id="questions" name="questions" value=""><br><br>
  </div>

  <div class="answers">
  <label for="answers"><h2>What is the answer to it?</h2></label><br>
  <input type="text" id="answers" name="answers" value=""><br><br>
  </div>

<div>
  <input class = "button" type="submit" placeholder="send">
</div>
</form>










</div>


</body>
</html>