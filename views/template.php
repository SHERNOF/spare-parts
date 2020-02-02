<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Test Engineering | Spare Parts</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="views/img/template/cog-logo-sm.jpg">

  <!--=================================
  =            Plugins CSS            =
  ==================================-->
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/AdminLTE.css">

  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css"> 

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> 

     <!-- iCheck for checkboxes and radio inputs -->
     <link rel="stylesheet" href="views/plugins/iCheck/all.css">

    <!-- Date Picker -->
     <link rel="stylesheet" href="views/bower_components/bootstrap-daterangepicker/daterangepicker.css">

     <!-- Morris chart -->
  <link rel="stylesheet" href="views/bower_components/morris.js/morris.css">
  <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css"> -->
  
  
  
  <!--====  End of Plugins CSS  ====-->
  
  <!--========================================
  =            plugins javascript            =
  =========================================-->
  <!-- jQuery 3 -->
  <script src="views/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- DataTables -->
  <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="views/bower_components/fastclick/lib/fastclick.js"></script>

  <!-- AdminLTE App -->
  <script src="views/dist/js/adminlte.min.js"></script>

  <!-- sweet alert -->
  <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>

  <!-- By default sweetalert2 doesn't support IE. To enable IE 11 support, include Promise polyfill -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

 
   <!-- iCheck 1.0.1 -->
<script src="views/plugins/iCheck/icheck.min.js"></script>

 <!-- InputMask -->
 <script src="views/plugins/input-mask/jquery.inputmask.js"></script>
<script src="views/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="views/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- jQuery Number -->
<script src="views/plugins/jQueryNumber/jquerynumber.min.js"></script>

<!-- daterangepicker http://www.daterangepicker.com/-->
<script src="views/bower_components/moment/min/moment.min.js"></script>
<script src="views/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

  
<!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
<script src="views/bower_components/raphael/raphael.min.js"></script>
<script src="views/bower_components/morris.js/morris.min.js"></script>  

<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script> -->

<!-- ChartJS http://www.chartjs.org/-->
<script src="views/bower_components/Chart.js/Chart.js"></script>




</head>

<body class="hold-transition skin-purple sidebar-collapse sidebar-mini login-page">


<!-- Site wrapper -->
<?php

if(isset($_SESSION["startSession"]) && $_SESSION["startSession"] == "ok"){

  echo '<div class="wrapper">';

  /*=============================================
  =            header          =
  =============================================*/  

  include "modules/header.php";

  /*=============================================
  =            sidebar          =
  =============================================*/ 

  include "modules/menu.php";

  /*=============================================
  =            Content          =
  =============================================*/ 

  if(isset($_GET["route"])){

    if ($_GET["route"] == 'home' || 
        $_GET["route"] == 'users' ||
        $_GET["route"] == 'categories' ||
        $_GET["route"] == 'parts' ||
        $_GET["route"] == 'partsUser' ||

        $_GET["route"] == 'withdrawn' ||
        $_GET["route"] == 'createWithdrawal' ||
        $_GET["route"] == 'editWithdrawal' ||
        
        $_GET["route"] == 'reports' ||
        $_GET["route"] == 'logout'){

      include "modules/".$_GET["route"].".php";

    }else{

       include "modules/404.php";
    
    }

  }else{

    include "modules/home.php";
  
  }
  
   /*=============================================
      =            Footer          =
    =============================================*/ 

  include "modules/footer.php";
    
  echo '</div>';
  
  } else {
    include "modules/login.php";
  }

?>



</div>
<!-- ./wrapper -->


<script src="views/js/template.js"></script>
<script src="views/js/users.js"></script>
<script src="views/js/categories.js"></script>
<script src="views/js/parts.js"></script>
<script src="views/js/partsUser.js"></script>
<script src="views/js/withdrawal.js"></script>
<script src="views/js/reports.js"></script>
</body>
</html>
