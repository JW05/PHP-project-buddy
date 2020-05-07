<?php 
    include_once(__DIR__."/classes/User.php");
    include_once(__DIR__."/classes/faq.class.php");
    session_start();

    
   

    try
    {
        $user = User::getCurrentUser($_SESSION['user']);


        $questions = faq::showcaseFaq($questions);
        $answers = faq::showcaseFaq($answers);


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
<h3><a name="toc">Table of Contents</a></h3>


    <div>
        
        <span class="questions"><?php echo $questions?></span>
        <div class="answers"><?php echo $answers?></div>

    </div>


</div>


</body>
</html>