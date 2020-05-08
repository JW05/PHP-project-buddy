<?php 
    include_once(__DIR__."/classes/User.php");
    include_once(__DIR__."/classes/faqs.php");
    session_start();

    
   

    try
    {
        $user = User::getCurrentUser($_SESSION['user']);

        $faq = faq::showcaseFaq();


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
<a href="addFaq.php" class="btn btn-success float-right">Add FAQ</a>
<div class="faq-container">
<h1>Frequently Asked Questions</h1>



    <div>
        
    <?php foreach($faq as $faqItem):?>
        
        <span class="questions">
            <ul>

            <li> <span> Q:</span> <?php echo $faqItem['questions']?></li>

            
            <li> <span> A: </span><?php echo $faqItem['answers']?>
            </ul>    
        </span>
    <?php endforeach ?>




       


</div>


</body>
</html>