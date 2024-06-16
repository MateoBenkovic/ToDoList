<?php 

include("baza.php");
$bp=spojiSeNaBazu();

if($_GET['todo_id']){
  $todo_id=$_GET['todo_id'];

  $sql="UPDATE todo_items SET finished='1' WHERE todo_id='$todo_id'";
  
  izvrsiUpit($bp,$sql);
  header("Location:index.php");
}

?>