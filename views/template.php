<?php

session_start();

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Spare Parts | Test Engineering</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="views/img/template/cog-logo-sm.jpg">


  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/AdminLTE.css">

   <!-- DataTables -->
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css">

  <!-- <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet"> -->

 

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
  <script src="views/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="views/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="views/dist/js/adminlte.min.js"></script>


     <!-- DataTables -->
  <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- SweetAlert -->
   <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>

 
   
<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script> -->

</head>

<!--=====================================
            Document Body
======================================-->


<body class="hold-transition skin-yellow-light sidebar-collapse sidebar-mini login-page">
<!-- Site wrapper -->
<?php
if (isset($_SESSION["startSession"]) && $_SESSION["startSession"] == "ok") {
echo '<div class="wrapper">';

// modules

  include "modules/header.php";

  // home

  if(isset($_GET["root"])){
    if($_GET["root"] == "home" ||
       $_GET["root"] == "users" ||
       $_GET["root"] == "categories" ||
       $_GET["root"] == "products" ||
       $_GET["root"] == "customers" ||
       $_GET["root"] == "sales" ||
       $_GET["root"] == "manage-sales" ||
       $_GET["root"] == "create-sales" ||
       $_GET["root"] == "logout" ||
       $_GET["root"] == "sales-report" ){
      include "modules/".$_GET["root"].".php";   

    } else {
      include "modules/404.php";
    }
    } else {
      include "modules/home.php";

  }
  
  include "modules/menu.php";
  include "modules/footer.php";
  
echo '</div>';
} else {
  include "modules/login.php";
}

?>



</div>
<!-- ./wrapper -->


<script src="views/js/template.js"></script>
</body>
</html>
