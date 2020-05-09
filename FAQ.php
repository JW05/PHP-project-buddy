<?php 
    include_once(__DIR__."/classes/User.php");
    include_once(__DIR__."/classes/faqs.php");
    include_once(__DIR__."/classes/Message.php");
    include_once(__DIR__."/classes/Buddy.php");
    session_start();

    


    try
    {
        $user = User::getCurrentUser($_SESSION['user']);
        $id = $user['id'];
        $faq = faq::showcaseFaq();
        $roles = User::checkRole($id);
        

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
    <?php include_once(__DIR__."/includes/scripts.html"); ?>
    <title>FAQ PHPals</title>
</head>
<body>
<?php include_once(__DIR__."/nav.inc.php");?>


<?php
if($roles['role'] == 1)
{
    ?>
    <a href="addFaq.php" class="btn-top btn btn-success">Add FAQ</a>


  <?php
}
else
{
    echo "You have no permission to access this tab!";
}


?>


<?php if($searchReturned != null): //If something is searched show results?>
    <?php include('./includes/searchResults.inc.php');?>
<?php else:?>

    <div class="faq-container float-right">
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

    <?php include_once("generalFaq.php");?>



        


    </div>
<?php endif;?>

</body>
</html>