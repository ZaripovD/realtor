<?php require 'php/db.php';?>


<?php 

$data = $_POST;
  if (isset ($_SESSION['logged_user'])) {
  	$ses = $_SESSION['logged_user'];
    $sesid = $_SESSION['logged_user']->id;
   if ($_SESSION['logged_user']->id_role == 2) {
     include("includes/header2.php"); 
   

  } else {

    include("includes/header1.php"); 
   

}
} else {
  error_reporting(0);
    include("includes/header.php"); 
   

}


 ?>
</div> 

<!-- jQuery 1.8 or later, 33 KB -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- Fotorama from CDNJS, 19 KB -->
<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>  