<!-- SEARCH BRYAN -->
<div class="search-results-container col-md-8">

<?php if($searchReturned != null):?>
    <h1 id="search-results-title">Search results for "<?php echo $_POST['name']; ?>"</h1>
<?php endif;?>

<?php if($searchReturned != null){
    foreach($searchReturned as $result){ ?>

  <div class="search-results-profiles">
      <h1><?php echo $result["firstname"] . " " . $result["lastname"]?></h1>
      <P>This person also likes <?php echo $result['preference'] . " and listens to " . $result["genre"]?></P>
  </div>
  
<?php }} ?>

</div>
<!-- END SEARCH BRYAN -->