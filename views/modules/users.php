
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

        User Management

        <!-- <small>Manage Users</small> -->

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
            <button class="btn btn-primary" data-toggle="modal" data-target="#addUser" >
              Add User
            </button>
        </div>

        <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive tables" width="100%"> 
                <thead> 
                    <tr>  
                        <th style="width:10px">#</th>
                        <th>Number</th>
                        <th>Username</th>
                        <th>Photo</th>
                        <th>Profile</th>
                        <th>Status</th>
                        <th>Last Login</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                  <tbody> 
                  <?php

                  $item = null;
                  $value = null;

                  $users = ControllerUsers::ctrShowUsers($item, $value);
                  // var_dump($users);

                  foreach ($users as $key => $value) {
                    
                    echo 
                    
                    '<tr>  
                      <td>'.($key+1).'</td>
                      <td>'.$value["name"].'</td>
                      <td>'.$value["user"].'</td>';

                    if ($value["photo"] != ""){

                      echo '<td><img src="'.$value["photo"].'" class="img-thumbnail" width="40px"></td>';
                      
                    } else {

                      echo '<td><img src="views/img/users/default/anonymous.png" class="img-thumbnail" width="40px"></td>';

                    }

                      echo '<td>'.$value["profile"].'</td>';

                      if($value["status"] != 0){

                        echo '<td><button class="btn btn-success btnActivate btn-xs" userId="'.$value["id"].'" userStatus="0">Activated</button></td>';
                        
                      }else {

                        echo '<td><button class="btn btn-danger btnActivate btn-xs" userId="'.$value["id"].'" userStatus="1" >Deactivated</button></td>';

                      }
                      
                      echo '<td>'.$value["lastLogin"].'</td>

                      <td>
                      
                        <div class="btn-group"> 
                              <button class="btn btn-warning btnEditUser" idUser="'.$value["id"].'" data-toggle="modal" data-target="#editUser"><i class="fa fa-pencil"></i></button>  
                              <button class="btn btn-danger btnDeleteUser" userId="'.$value["id"].'" username="'.$value["user"].'" userPhoto="'.$value["photo"].'"><i class="fa fa-times"></i></button>
                        </div>
                      </td>
                   </tr>';
                         

                  }


                  ?>      
                  </tbody>

            </table>
          <!-- Start creating your amazing application! -->
        </div>
      </div>
    </section>
  </div>


<!--=====================================
=            module add user            =
======================================-->

<!-- The Modal -->
<div class="modal fade" id="addUser" role="dialog">

  <div class="modal-dialog">

  <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">

      
      <!--=====================================
                    HEADER
      ======================================-->

    
      <div class="modal-header" style="background: #3c8dbc; color: #fff">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add User</h4>
      </div>

        <!--=====================================
                      BODY
        ======================================-->

      <div class="modal-body">

        <div class="box-body">

          <!-- Name Entry-->
          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="newName" placeholder="Add Name" required>
              </div>
          </div>    

              <!-- Username entry -->
          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" name="newUser" id="newUser" placeholder="Add username" required>
              </div>
          </div>

          <!-- password entry -->
          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="newPasswd" placeholder="Input password" required>
              </div>
          </div>

            <!-- user profile  -->

          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="newProfile">
                
                  <option value="">Select Profile</option>
                  <option value="Administrator">Administrator</option>
                  <option value="Special">Special</option>
                  <option value="Seller">Seller</option>

                </select>
              </div>
          </div>

            <!-- pictures entry -->
          <div class="form-group">
            <div class="panel">Upload Profile Photo</div>
            <input type="file" class="newPics" name="newPhoto">
            <p class="help-block">Only max of 3MB per Photo</p>
            <img src="views/img/users/default/anonymous.png" class="img-thumbnail preview" width="100px">
          </div>          


  
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default oull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>

     <?php
      $createUser = new ControllerUsers();
      $createUser -> ctrCreateUser();
      ?> 

    </form>

    </div>
  </div>
</div>


<!--=====================================
=            module edit user            =
======================================-->

<!-- The Modal -->
<div class="modal fade" id="editUser" role="dialog">

  <div class="modal-dialog">

  <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">

      
      <!--=====================================
                    HEADER
      ======================================-->

    
      <div class="modal-header" style="background: #3c8dbc; color: #fff">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit User</h4>
      </div>

        <!--=====================================
                      BODY
        ======================================-->

      <div class="modal-body">

        <div class="box-body">

          <!-- Name Entry-->
          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editName" name="editName" value="" required>
              </div>
          </div>    

              <!-- Username entry -->
          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" id="EditUser" name="EditUser" placeholder="Edit username" readonly>
              </div>
          </div>

          <!-- password entry -->
          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="editPasswd" placeholder="Add new Password">
                <input type="hidden" id="currentPasswd" name="currentPaswd">
              </div>
          </div>

            <!-- user profile  -->

          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg"  name="editProfile">
                  <option value="" id="editProfile"></option>
                  <option value="Administrator">Administrator</option>
                  <option value="Special">Special</option>
                  <option value="Seller">Seller</option>

                </select>
              </div>
          </div>

            <!-- pictures entry -->
          <div class="form-group">
            <div class="panel">Upload Profile Photo</div>
            <input type="file" class="newPics" name="editPhoto">
            <p class="help-block">Only max of 2MB per Photo</p>
            <img src="views/img/users/default/anonymous.png" class="img-thumbnail preview" width="100px">
            <input type="hidden" id="currentPhoto" name="currentPhoto">
          </div>          


  
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Modify Changes</button>
      </div>

    <!-- PHP objects that invokes the method of saving new user -->

     <?php
      $editUser = new ControllerUsers();
      $editUser -> ctrEditUser();
      ?> 

    </form>

    </div>
  </div>
</div>

<?php

  $deleteUser = new ControllerUsers();
  $deleteUser -> ctrDeleteUser();

?> 
