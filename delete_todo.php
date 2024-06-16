<?php 

include("baza.php");
$bp=spojiSeNaBazu();

if($_GET['todo_id']){
  $todo_id=$_GET['todo_id'];

  $sql="DELETE FROM todo_items WHERE todo_id='$todo_id'";
  izvrsiUpit($bp,$sql);
  header('Location:index.php');
}

?>