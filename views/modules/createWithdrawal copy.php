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

        Parts Withdrawal

        <!-- <small>Manage Users</small> -->

      </h1>

      <ol class="breadcrumb">

        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Spare Parts Management</li>

      </ol>
      
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">

      <!--=====================================
                      FORM
      ======================================-->

      <div class="col-lg-5 col-xs-12">
      
        <div class="box box-success">
        
          <div class="box-header with-border">

            <form role="form" method="POST" class="formWithdrawal">

              <div class="box-body">

                <div class="box">

                   <!--=====================================
                      Issuance Input
                    ======================================-->

                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="newIssuer" name="newIssuer" value="<?php echo $_SESSION["name"]; ?>" readnly>
                        <input type="hidden" name="idIssuer" value="<?php echo $_SESSION["id"]; ?>">
                      </div>
                    </div>

                    <!--=====================================
                      CODE INPUT
                    ======================================-->

                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>

                        <?php

                          $item = null;
                          $value = null;

                          $withdrawal = ControllerWithdrawal::ctrShowWithdrawal($item, $value);

                          if(!$withdrawal){
                            echo '<input type="text" class="form-control" id="newWithdrawal" name="newWithdrawal" value="10001" readonly>';
                          } else {
                            foreach ($withdrawal as $key => $value){
                            }
                            $code = $value["code"] + 1;
                            echo '<input type="text" class="form-control" id="newWithdrawal" name="newWithdrawal" value="'.$code.'" readonly>';
                          }
                        ?>
                      </div>
                    </div>

                     <!--=====================================
                      Parts User Input
                     ======================================-->

                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <select type="text" class="form-control" id="selectpartsUser" name="selectpartsUser" required>
                            <option value="">Select Parts User</option>  

                            <?php
                            $item = null;
                            $value = null;

                            $PartsUser = ControllerpartsUser::ctrShowpartsUser($item, $value);

                            foreach($PartsUser as $key => $value){
                              echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
                            }
                            ?>

                          </select>
                        <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addpartsUser" data-dismiss="modal">Add Parts User</button></span>
                      </div>
                     </div>

                     <!--=====================================
                      Parts Input
                     ======================================-->

                     <div class="form-group row newPart">


                    </div>

                    <input type="hidden" name="partsList" id="partsList">

                      <!--=====================================
                      Add Parts Button
                     ======================================-->

                      <button type="button" class="btn btn-default hidden-lg btnAddPart">Add Parts</button>

                      <hr>

                      <div class="row">

                      <!--=====================================
                      Taxes and Total Price
                     ======================================-->
                      
                    <div class="col-xs-8 pull-right">
                    
                      <table class="table">
                      
                            <thead>

                                <th>Discount</th>
                                <!-- <th>Taxes</th> -->
                                <th>Total</th>    
                            
                            </thead>

                            <tbody>

                              <tr>

                              <td style="width:50%">
                                  <div class="input-group">
                                    <input type="number" class="form-control input-lg" min="0" id="newDiscSale" name="newDiscSale" placeholder="0" required>
                                    
                                    <input type="hidden" name="newNetPrice" id="newNetPrice" required>
                                    <input type="hidden" name="newDiscPrice" id="newDiscPrice" required>
                                    
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                  </div>
                                </td>

                                <!-- <td style="width:30%">
                                  <div class="input-group">
                                    <input type="number" class="form-control input-lg" value="0" min="0" id="newTaxSale" name="newTaxSale" placeholder="0" required>
                                    
                                    <input type="hidden" name="newNetPrice" id="newNetPrice" required>
                                    <input type="hidden" name="newTaxPrice" id="newTaxPrice" required>
                                    
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                  </div>
                                </td> -->

                                <td style="width:50%">

                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                    <input type="number" class="form-control input-lg" id="newPartsTotalSell" totalSale="" name="newPartsTotalSell" placeholder="0000" readonly required>

                                    <input type="hidden" name="saleTotal" id="saleTotal" required>
                                    
                                    
                                    </div>
                                    
                                  </td>
                                
                                </tr>
                              
                              </tbody>
                          
                          </table>
                            
                        </div>

                      <hr>
                    
                    </div>

                  <hr>

                <!--=====================================
                  Payment Method
                  ======================================-->

                  <div class="form-group row">
                  
                    <div class="col-xs-6" style="padding-right: 0"> 
                    
                      <div class="input-group">
                      
                        <select class="form-control" id="newPaymentMethod" name="newPaymentMethod" required>
                        
                          <option value="">Select Payment Method</option>
                          <option value="cash">Cash</option>
                          <option value="CC">Credit Card</option>
                          <option value="DC">Debit Card</option>

                        </select>
                  
                      </div>
                    
                    </div>

                    <div class="paymentMethodBoxes"></div>

                    <input type="hidden" name="listPaymentMethod" id="listPaymentMethod" required>
                    
                  </div>

                  <br>                  

                </div>              
          
            </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Save Withdrawals</button>
              </div>

            </form>

            <?php

            $saveWithdrawal = new ControllerWithdrawal();
            $saveWithdrawal -> ctrCreateWithdrawal();
            
          ?>
          
          </div>

        </div>
      
      </div>

      <!--=====================================
                      Table Parts
        ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

            <div class="box-header with-border">
            
              <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tableWithdrawal" width="100%"> 

                <thead> 
                    <tr>  
                        <th style="width:10px">#</th>
                        <th>Image</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>

                </thead>          
                
                </table>
              
              </div>

            </div>
        
        </div>
      </div>

      </div>
     </div>
     
    </section>
    </div>
  

<!--=====================================
MODAL ADD PART USER
======================================-->

<div class="modal fade" id="addpartsUser" role="dialog">

<div class="modal-dialog">


  <div class="modal-content">

    <form role="form" method="POST">

    <!-- Modal Header -->
    <div class="modal-header" style="background: #3c8dbc; color: #fff">
      
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add Part User</h4>
    </div>

<!--=====================================
MODAL BODY
======================================-->

    <div class="modal-body">
      <div class="box-body">

        <!-- for entry fir number -->
        <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control input-lg" name="newpartsUser" placeholder="Add Parts User" required>
            </div>
        </div>    

        <div class="form-group">
        <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="number" min="0" class="form-control input-lg" name="newIdDocument" placeholder="Add ID Number" required>
            </div>
        </div>    

        <div class="form-group">
        <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
              <input type="email" min="0" class="form-control input-lg" name="newEmail" placeholder="Add Email Address" required>
            </div>
        </div> 

        <div class="form-group">
        <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="text" min="0" class="form-control input-lg" name="newPhone" placeholder="Add Contact Number" required required>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
              <input class="form-control input-lg" type="text" name="newAddress" placeholder="Address" required>
            </div>
          </div>

        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <input class="form-control input-lg" type="text" name="newBirthdate" placeholder="Birth Date" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
            </div>
        </div>



      </div>
    </div>

    <!-- Modal footer -->
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Save Parts User</button>
    </div>
  </form>

  <?php
    $createpartsUser = new ControllerpartsUser();
    $createpartsUser -> ctrCreatepartsUser();
    ?> 

  </div>
</div>
</div>

