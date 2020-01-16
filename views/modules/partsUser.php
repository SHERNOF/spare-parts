<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

        Parts Users

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

            <button class="btn btn-primary" data-toggle="modal" data-target="#addPartsUser" >
              Add Part User
            </button>
 
        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tables" width="100%"> 

                <thead> 

                    <tr>  

                        <th style="width:10px">#</th>

                        <th>Name</th>
                        <th>Document ID</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Birthday</th>
                        <th>Total Parts Withdrawn</th>
                        <th>Last Withdrawn</th>
                        <th>Last login</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                  <tbody> 

                  <?php

            $item = null;
            $valor = null;

            $partsUser = controllerpartsUser::ctrShowpartsUser($item, $valor);

            foreach ($partsUser as $key => $value) {
              

              echo '

                      <tr>  

                        <td>'.($key+1).'</td>

                        <td>'.$value["name"].'</td>
  
                        <td>'.$value["idDocument"].'</td>
  
                        <td>'.$value["email"].'</td>
  
                        <td>'.$value["phone"].'</td>
  
                        <td>'.$value["address"].'</td>
  
                        <td>'.$value["birthdate"].'</td>             
  
                        <td>'.$value["partsWithdrawn"].'</td>
  
                        <td>0000-00-00 00:00:00</td>
  
                        <td>'.$value["registerDate"].'</td>

                        <td>
                          <div class="btn-group"> 
                                <button class="btn btn-warning btnEditpartsUser" data-toggle="modal" data-target="#EditpartsUser" idpartsUser="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
                                
                                <button class="btn btn-danger btnDeletepartsUser" idpartsUser="'.$value["id"].'"><i class="fa fa-times"></i></button>
                          </div>
                        </td>
                     </tr>';

            }
            ?>

                  </tbody>
            </table>
        </div>
      </div>
    </section>
  </div>


<!--=====================================
MODAL ADD PART USER
======================================-->

<div class="modal fade" id="addPartsUser" role="dialog">

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


<!--=====================================
MODAL Edit PART USER
======================================-->

<div class="modal fade" id="EditpartsUser" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">

      <!-- Modal Header -->
      <div class="modal-header" style="background: #3c8dbc; color: #fff">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Part User</h4>
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
                <input type="text" class="form-control input-lg" name="editpartsUser" id="editpartsUser"  required>
              </div>
          </div>    

          <div class="form-group">
          <div class="form-group">
              <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="number" min="0" class="form-control input-lg" name="editIdDocument" id="editIdDocument" required>
              </div>
          </div>    

          <div class="form-group">
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" min="0" class="form-control input-lg" name="editEmail" id="editEmail" required>
              </div>
          </div> 

          <div class="form-group">
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <!-- <input type="text" min="0" class="form-control input-lg" name="newPhone" placeholder="Add Contact Number" required data-inputmask="'mask':'(999) 999-99999'" required data-mask> -->
                <input type="text" min="0" class="form-control input-lg" name="editPhone" id="editPhone" required required>
              </div>
          </div>

          <div class="form-group">
              <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input class="form-control input-lg" type="text" name="editAddress" id="editAddress" required>
              </div>
            </div>

          <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input class="form-control input-lg" type="text" name="editBirthdate" name="editBirthdate" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
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
      // $editpartsUser = new ControllerpartsUser();
      // $editpartsUser -> ctrEditpartsUser();
      ?> 

    </div>
  </div>
</div>
