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
 
        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tables" width="100%"> 

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

          $item = null;
          $value = null;

          $answer = ControllerWithdrawal::ctrShowWithdrawal($item, $value);

          // var_dump($answer);

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
                        
                      <button class="btn btn-info"><i class="fa fa-print"></i></button>

                        <button class="btn btn-warning btnEditSale" idSale="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnDeleteSale" idSale="'.$value["id"].'"><i class="fa fa-times"></i></button>
                   </div>  

                  </td>

                </tr>';

        

        

            }

        ?>

                  <tbody>

           
                      
                  </tbody>
            </table>
        </div>
      </div>
    </section>
  </div>
