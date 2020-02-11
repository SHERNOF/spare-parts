



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

        <!-- Home -->

        <medium>Cognex Spare Parts Management</medium>

      </h1>

      <ol class="breadcrumb">

        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Dashboard</li>

      </ol>
      
    </section>


    <!-- Main content -->
    <section class="content">

    <div class="row">
      
      <?php

        if($_SESSION["profile"] =="Administrator"){

          include "home/top-boxes.php";

        }

      ?>
    
    </div>

        <div class="row">

          <div class="col-lg-12">

            <?php

              if($_SESSION["profile"] =="Administrator"){

                include "reports/sales-graph.php";
              
              }

            ?>
          
          </div>
              
        </div>

        <div class="row">
        
        <div class="col-lg-6">

          <?php

            if($_SESSION["profile"] =="Administrator"){

              include "reports/bestseller-products.php";

            }

          ?>
        
        </div>

        <div class="col-lg-6">

          <?php

            if($_SESSION["profile"] =="Administrator"){

              include "home/recent-products.php";

            }

          ?>

          </div>


          <div class="col-lg-12">
           
           <?php
   
           if($_SESSION["profile"] =="Special" || $_SESSION["profile"] =="Seller"){
   
              echo '<div class="box box-success">
   
              <div class="box-header">
   
              <h1>Welcome ' .$_SESSION["name"].'</h1>
   
              </div>
   
              </div>';
   
           }
   
           ?>
   
         </div>
            
      </div>

    </section>
  
  </div>
  