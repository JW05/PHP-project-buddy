<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuddyPage</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        * {
        box-sizing: border-box;
        }
        #BuddyInput {           
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 1px solid lightgrey;
        margin-bottom: 12px;
        }

        .BuddyBox{
           display:grid;
           
           padding: 50px;
  
           
        }
        .MijnBuddys{
            padding:20px;
        }
        .BuddysBuddys{
            padding:20px;
        }

        @media(min-width: 800px) {

            
        .BuddyBox{
           display:grid;
           grid-template-columns: auto auto auto;
           padding: 50px 50px 0px 400px;
  
           
        }
        .MijnBuddys{
            padding:20px;
        }
        .BuddysBuddys{
            padding:20px;
        }








        }
</style>
</head>
<body>

<input type="text" id="BuddyInput" onkeyup="myFunction()" placeholder="Zoek buddy's" title="Typ een buddy">

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("BuddyInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
<div class="BuddyBox">
    <div class="MijnBuddys">
        <h1>Jouw Buddy's</h1>
        <p>buddy1</p>
        <p>buddy2</p>
        <p>buddy3</p>
        <p>buddy4</p>
        <p>buddy5</p>
        <br>
    </div>

    <div class="BuddysBuddys">
        <h1>Jouw Buddy's Buddy's</h1>
        <p>buddy1</p>
        <p>buddy2</p>
        <p>buddy3</p>
        <p>buddy4</p>
        <p>buddy5</p> 
    </div>
</div> 






</body>
</html>