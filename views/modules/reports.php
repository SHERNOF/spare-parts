<div class="content-wrapper">
    
    <section class="content-header">
      
      <h1>

        Parts Withdrawal Reports

        <!-- <small>Manage Sales Reports</small> -->

      </h1>

      <ol class="breadcrumb">

        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Dashboard</li>

      </ol>
      
    </section>


    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          
              <div class="input-group">

                <button type="button" class="btn btn-default" id="daterange-btn2">
                
                    <span>
                        <i class="fa fa-calendar"></i> Date Range
                    </span>

                    <i class="fa fa-caret-down"></i>

                </button>

              </div>

                <div class="box-tools pull-right">

                <?php

                if(isset($_GET["inicialDate"])){

                  echo '<a href="views/modules/download-report.php?reports=report&inicialDate='.$_GET["inicialDate"].'&finalDate='.$_GET["finalDate"].'">';

                }   else {

                  echo '<a href="views/modules/download-report.php?report=report">';

                }

                ?>
                    <button class="btn btn-success" style="margin-top:5px">Export to Excel</button>
                  </a>
                
                </div>

            </div>
            
            <div class="box-body">
          
              <div class="row">

                  <div class="col-xs-12">
                  
                    <?php

                        include "reports/sales-graph.php";

                    ?>

                  </div>

                  <div class="col-md-6 col-xs-12">

                  <?php

                     include "reports/bestseller-products.php";

                  ?>

                  </div>

                  <div class="col-md-6 col-xs-12">
           
                    <?php

                       include "reports/issuers.php";

                    ?>

                </div>

                <div class="col-md-6 col-xs-12">
           
                  <?php

                      include "reports/partsUserG.php";

                  ?>

                </div>
              
              </div>

            </div>
       
      </div>

    </section>
    
  </div>
  