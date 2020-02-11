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

                <?php

                  $item = "id";
                  $value = $_GET["idWithdrawal"];

                  $withdrawal = ControllerWithdrawal::ctrShowWithdrawal($item, $value);
                  
                  $itemUser = "id";
                  $valueUser = $withdrawal["idIssuer"];

                  $issuer = ControllerUsers::ctrShowUsers($itemUser, $valueUser);

                  $itempartsUser = "id";
                  $valuepartsUser = $withdrawal["idPartsUser"];

                  $partsUser = ControllerpartsUser::ctrShowpartsUser($itempartsUser, $valuepartsUser);

                  // $taxPercentage = round($withdrawal["tax"] * 100 / $withdrawal["netPrice"]);
                  $discPercentage = round($withdrawal["disc"] * 100 / $withdrawal["totalPrice"]);



                  // var_dump($withdrawal);
                
                ?>

                   <!--=====================================
                      Issuance Input
                    ======================================-->

                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="newIssuer" name="newIssuer" value="<?php echo $issuer["name"]; ?>" readnly>
                        <input type="hidden" name="idIssuer" value="<?php echo $issuer["id"]; ?>">
                      </div>
                    </div>

                    <!--=====================================
                      CODE INPUT
                    ======================================-->

                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control" id="newWithdrawal" name="editWithdrawal" value="<?php echo $withdrawal["code"]; ?>" readonly>

                      </div>
                    </div>

                     <!--=====================================
                      Parts User Input
                     ======================================-->

                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                          <select type="text" class="form-control" id="selectpartsUser" name="selectpartsUser" required>
                            <option value="<?php echo $partsUser["id"]; ?>"><?php echo $partsUser["name"]; ?></option>  

                            <?php
                            $item = null;
                            $value = null;
                            $order = "id";

                            $PartsUser = ControllerpartsUser::ctrShowpartsUser($item, $value, $order);

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

                     <?php

                     $partList = json_decode($withdrawal["parts"], true);
                    

                    foreach($partList as $key => $value){

                      $item = "id";
                      $valuePart = $value["id"];
                      $order = "id";

                      $answer = ControllerParts::ctrShowparts($item, $valuePart, $order);

                      $lastStock = $answer["stock"] + $value["quantity"];
                    

                      echo '<div class="row" style="padding:5px 15px">
  
                      <div class="col-xs-6" style="padding-right:0px">
  
                          <div class="input-group">
  
                              <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removePart" idPart="'.$value["id"].'"><i class="fa fa-times"></i></button></span>
  
                              <input type="text" class="form-control newPartDescription" idPart="'.$value["id"].'" name="addPartsButton" value="'.$value["description"].'" readonly required>
                              
                              
  
                          </div>
  
                      </div>
  
                      <div class="col-xs-3">
                          
                          <input type="number" class="form-control newPartQty" name="newPartQty" min="1" value="'.$value["quantity"].'" stock="'.$lastStock.'" newStock="'.$value["stock"].'" required>
                          
                      </div>
  
                      <div class="col-xs-3 enterPrice" style="padding-left:0px">
                          <div class="input-group" >
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                              <input type="text" class="form-control newPartPrice" name="newPartPrice" realPrice="'.$answer["sellingPrice"].'" value="'.$value["totalPrice"].'" readonly required>
                          </div>
                      </div>
                      </div>';
                      
                    }

                    ?>

                    </div>

                    <input type="hidden" name="partsList" id="partsList">

                      <!--=====================================
                      Add Parts Button
                     ======================================-->

                      <button type="button" class="btn btn-default hidden-lg btnAddPart">Add Parts</button>

                      <hr>

                      <div class="row">

                      <!--=====================================
                      Discount and Total Price
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

                                    <!-- <input type="number" class="form-control input-lg" min="0" id="newTaxSale" name="newTaxSale" value="<?php echo $taxPercentage; ?>" placeholder="0" required> -->
                                    <input type="number" class="form-control input-lg" min="0" id="newDiscSale" name="newDiscSale" value="<?php echo $discPercentage; ?>" placeholder="0" required>
                                    
                                    <!-- <input type="hidden" name="newTaxPrice" id="newTaxPrice" value="<?php echo $withdrawal["tax"]; ?>" required> -->
                                    <input type="hidden" name="newDiscPrice" id="newDiscPrice" value="<?php echo $withdrawal["disc"]; ?>" required>
                                    
                                    <input type="hidden" name="newNetPrice" id="newNetPrice" value="<?php echo $withdrawal["netPrice"]; ?>" required>
                                    
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                  </div>
                                </td>

                                <td style="width:50%">
                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                    <!-- <input type="text" class="form-control input-lg" name="newPartsTotalSell" id="newPartsTotalSell" placeholder="00000" totalSale="<?php echo $withdrawal["netPrice"]; ?>"  value="<?php echo $withdrawal["totalPrice"]; ?>" readonly required> -->
                                    <input type="text" class="form-control input-lg" name="newPartsTotalSell" id="newPartsTotalSell" placeholder="00000" totalSale="<?php echo $withdrawal["totalPrice"]; ?>"  value="<?php echo $withdrawal["netPrice"]; ?>" readonly required>

                                    <!-- <input type="hidden" name="saleTotal" id="saleTotal" value="<?php echo $withdrawal["totalPrice"]; ?>" required> -->
                                    <input type="hidden" name="saleTotal" id="saleTotal" value="<?php echo $withdrawal["netPrice"]; ?>" required>
                                    
                                  </div>
                                </td>
                              
                              </tr>
                            
                            </tbody>
                        
                        </table>
                          
                      </div>
                  
                  </div>

                  <hr>

                <!--=====================================
                  Payment Method
                  ======================================-->

                  <div class="form-group row">
                  
                    <div class="col-xs-6" style="padding-right:0px"> 
                    
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
              
              <!-- </form> -->              
          
            </div>

            <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Save Changes</button>

            </div>

            </form>

            <?php

            $editWithdrawal = new ControllerWithdrawal();
            $editWithdrawal -> ctrEditWithdrawal();
            
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

