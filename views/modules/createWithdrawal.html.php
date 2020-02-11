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

            <form role="form" method="POST">

              <div class="box-body">

              
              
                <div class="box">

                   <!--=====================================
                      Issuance Input
                    ======================================-->

                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="newIssuer" name="newIssuer" value="Administrator" readnly>
                      </div>
                    </div>

                    <!--=====================================
                      Billing Code
                    ======================================-->

                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="text" class="form-control" id="newWithdrawal" name="newWithdrawal" value="10002343" readnly>
                      </div>
                    </div>

                     <!--=====================================
                      Parts User Input
                     ======================================-->

                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <select type="text" class="form-control" id="newpartsUser" name="newpartsUser" placeholder="Parts User" required>
                            <option value="">Parts User Selection</option>  
                          </select>
                        <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addpartsUser" data-dismiss="modal">Add Parts User</button></span>
                      </div>
                     </div>

                     <!--=====================================
                      Parts Input
                     ======================================-->

                     <div class="form-group row newParts">

                        <!-- Parts Description -->

                        <div class="col-xs-6" style="padding-right:0px">
                          <div class="input-group">
                              <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></span>
                              <input type="text" class="form-control" id="addParts" name="addParts" placeholder="Parts Description" required>
                          </div>
                        </div>

                          <!-- Parts Quantity -->  

                          <div class="col-xs-3">
                            <input type="text" class="form-control" id="newPartsQty" name="newPartsQty" min="1" placeholder="0" required>
                          </div>    

                          <!-- Parts Price -->  
                          <div class="col-xs-3" style="padding-left:0px">
                            <div class="input-group" >
                              
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                              
                              <input type="number" min="1" class="form-control" id="newPartsPrice" name="newPartsPrice" placeholder="000000" readonly required>
                              
                            </div>
                          </div>

                      </div>

                      <!--=====================================
                      Add Parts Button
                     ======================================-->

                      <button type="button" class="btn btn-default hidden-lg">Add Parts</button>

                      <hr>

                      <div class="row">

                      <!--=====================================
                      Taxes and Total Price
                     ======================================-->
                      
                    <div class="col-xs-8 pull-right">
                    
                      <table class="table">
                      
                            <thead>
                              
                                <th>Taxes</th>
                                <th>Total</th>    
                            
                            </thead>

                            <tbody>

                              <tr>

                                <td style="width:50%">
                                  <div class="input-group">
                                    <input type="number" class="form-control" min="0" id="newPartsTax" name="newPartsTax" placeholder="0" required>
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                  </div>
                                </td>

                                <td style="width:50%">
                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                    <input type="number" class="form-control" min="0" id="newPartsTotal" name="newPartsTotal" placeholder="0000" readonly required>
                                    
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
                          <option value="Cash">Cash</option>
                          <option value="Credit Card">Credit Card</option>
                          <option value="Debit Card">Debit Card</option>
                        </select>
                  
                      </div>
                    
                    </div>


                    <div class="col-xs-6" style="padding-left:0px"> 
                    
                        <div class="input-group">

                          <input type="number" class="form-control" min="0" id="newPartsTotal" name="newPartsTotal" placeholder="0000" readonly required>

                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                        </div>

                    </div>
                    
                  </div>

                  <br>                  

                </div>
              
              <!-- </form> -->              
          
            </div>

            <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Save sale</button>

            </div>

            </form>
          
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

                <table class="table table-bordered table-striped dt-responsive tables"> 

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

                <tbody> 

                      <tr>  
                        <td>1</td>
                        <td><img src="views/img/parts/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                        <td>0001</td>
                        <td>Helical</td>
                        <td>1</td>
                        <td>
                          <div class="btn-group"> 
                                <button class="btn btn-primary">Add</button>
                          </div>
                        </td>
                     </tr> 

                </tbody>                 
                
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
              <!-- <input type="text" min="0" class="form-control input-lg" name="newPhone" placeholder="Add Contact Number" required data-inputmask="'mask':'(999) 999-99999'" required data-mask> -->
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

