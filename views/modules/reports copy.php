<div class="content-wrapper">
    
    <section class="content-header">
      
      <h1>

        Sales Reports

        <small>Manage Sales Reports</small>

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

                <button type="button" class="btn btn-default" id="daterange-btn2">
                
                    <span>
                        <i class="fa fa-calendar"></i> Date Range
                    </span>

                    <i class="fa fa-caret-down"></i>

                </button>

                <div class="box-tools pull-right"></div>

            </div>
            
            <div class="box-body">
          
              <div class="row">

                  <div class="col-xs-12">
                  
                    <?php

                        include "reports/sales-graph.php";

                    ?>

                  </div>
              
              </div>

            </div>
       
      </div>

    </section>
    
  </div>
  