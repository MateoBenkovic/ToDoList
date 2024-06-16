<?php 

define("POSLUZITELJ","localhost");
define("BAZA","todo_list");
define("BAZA_KORISNIK","todolist_db");
define("BAZA_LOZINKA","password123");

function spojiSeNaBazu(){
  $veza=mysqli_connect(POSLUZITELJ,BAZA_KORISNIK,BAZA_LOZINKA);
  if(!$veza)echo "GREŠKA: Problem sa spajanjem u datoteci baza.php funkcija spojiSeNaBazu: ".mysqli_connect_error();
  mysqli_select_db($veza,BAZA);
  if(mysqli_error($veza)!=="")echo "GREŠKA: Problem sa odabirom baze u baza.php funkcija spojiSeNaBazu: ".mysqli_error($veza);
  mysqli_set_charset($veza,"utf8");
  if(mysqli_error($veza)!=="")echo "GREŠKA: Problem sa odabirom baze u baza.php funkcija spojiSeNaBazu: ".mysqli_error($veza);
  return $veza;
}

function izvrsiUpit($veza,$upit){
  $rezultat=mysqli_query($veza,$upit);
  if(mysqli_error($veza)!=="")echo "GREŠKA: Problem sa upitom: ".$upit." : u datoteci baza.php funkcija izvrsiUpit: ".mysqli_error($veza);
  return $rezultat;
}

function zatvoriVezuNaBazu($veza){
  mysqli_close($veza);
}

if(session_id() == "")session_start();

if(isset($_SESSION['active_user'])){
  $active_user=$_SESSION['active_user'];
  $active_user_name=$_SESSION['active_user_name'];
}

?>