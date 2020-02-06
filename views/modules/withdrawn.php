<?php

if($_SESSION["profile"] == "Special"){

  echo '<script>

    window.location = "home";

  </script>';

  return;

}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

        Parts Withdrawal Management

        <!-- <small>Manage Users</small> -->

      </h1>

      <ol class="breadcrumb">

        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Spare Parts Management</li>

      </ol>
      
    </section>


    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

        <a href="createWithdrawal">
            <button class="btn btn-primary">
              Withdraw Part
            </button>
        </a>

        
        <button type="button" class="btn btn-default pull-right" id="daterange-btn">
           
            <span>
              <i class="fa fa-calendar"></i> Date Range
            </span>

            <i class="fa fa-caret-down"></i>

        </button>

        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tables WithdrawalTable" width="100%"> 

                <thead> 

                    <tr>  

                        <th style="width:10px">#</th>
                        <th>Bill code</th>
                        <th>Customer</th>
                        <th>Seller</th>
                        <th>Payment method</th>
                        <th>Net cost</th>
                        <th>Total cost</th>
                        <th>Date</th>
                        <th>Actions</th>

                    </tr>

                </thead>

              <tbody> 
            <?php

          if(isset($_GET["initialDate"])){

            $initialDate = $_GET["initialDate"];
            $finalDate = $_GET["finalDate"];

          }else{

            $initialDate = null;
            $finalDate = null;
          }

          $answer = ControllerWithdrawal::ctrWithdrawalDatesRange($initialDate, $finalDate);

          foreach ($answer as $key => $value) {
           

           echo 

        '<td>'.($key+1).'</td>

                  <td>'.$value["code"].'</td>';

                  $itempartsUser = "id";
                  $valuepartsUser = $value["idPartsUser"];

                  $partsUserAnswer = ControllerpartsUser::ctrShowpartsUser($itempartsUser, $valuepartsUser);

                  echo '<td>'.$partsUserAnswer["name"].'</td>';

                  $itemUser = "id";
                  $valueUser = $value["idIssuer"];

                  $userAnswer = ControllerUsers::ctrShowUsers($itemUser, $valueUser);

                  echo '<td>'.$userAnswer["name"].'</td>

                  <td>'.$value["paymentMethod"].'</td>

                  <td>$ '.number_format($value["netPrice"],2).'</td>

                  <td>$ '.number_format($value["totalPrice"],2).'</td>

                  <td>'.$value["withdrawalDate"].'</td>

                  <td>

                    <div class="btn-group">
                        
                      <div class="btn-group">
                        
                      <button class="btn btn-info btnPrintBill" withdrawalCode="'.$value["code"].'">
                      
                      <i class="fa fa-print"></i>
                      
                      </button>';

                      if($_SESSION["profile"] =="Administrator"){

                        echo '<button class="btn btn-warning btnEditWithdrawal" idWithdrawal="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
                        
                        <button class="btn btn-danger btnDeleteWithdrawal" idWithdrawal="'.$value["id"].'"><i class="fa fa-times"></i></button>';

                      }
                        
                   echo '</div>  

                  </td>

                </tr>';
            }
        ?>

                  </tbody>
            </table>

         <?php

          $deleteWithdrawal = new ControllerWithdrawal();
          $deleteWithdrawal -> ctrDeleteWithdrawal();

          ?>

        </div>
      </div>
    </section>
  </div>
