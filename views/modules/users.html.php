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
          <!-- <h3 class="box-title">Title</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div> -->
        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tables"> 

                <thead> 

                    <tr>  

                        <th style="width:10px">#</th>
                        <th>Number</th>
                        <th>User</th>
                        <th>Photo</th>
                        <th>Profile</th>
                        <th>Status</th>
                        <th>Last Login</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                  <tbody> 

                      <tr>  
                        <td>1</td>
                        <td>User Administrator</td>
                        <td>admin</td>
                        <td><img src="views/img/users/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                        <td>Administrator</td>
                        <td><button class="btn btn-success btn-xs">Activated</button></td>
                        <td>2019-12-25 12:00:00</td>
                        <td>
                          <div class="btn-group"> 
                                <button class="btn btn-wwarning"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                          </div>
                        </td>
                     </tr> 

                      <tr>  
                        <td>1</td>
                        <td>User Administrator</td>
                        <td>admin</td>
                        <td><img src="views/img/users/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                        <td>Administrator</td>
                        <td><button class="btn btn-danger btn-xs">Deactivated</button></td>
                        <td>2019-12-25 12:00:00</td>
                        <td>
                          <div class="btn-group"> 
                                <button class="btn btn-wwarning"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                          </div>
                        </td>
                     </tr> 


                     <tr>  
                        <td>1</td>
                        <td>User Administrator</td>
                        <td>admin</td>
                        <td><img src="views/img/users/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                        <td>Administrator</td>
                        <td><button class="btn btn-success btn-xs">Activated</button></td>
                        <td>2019-12-25 12:00:00</td>
                        <td>
                          <div class="btn-group"> 
                                <button class="btn btn-wwarning"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                          </div>
                        </td>
                     </tr> 

                  </tbody>

            </table>
          <!-- Start creating your amazing application! -->
        </div>
      </div>
    </section>
  </div>


<!-- Modal -->

<!-- The Modal -->
<div class="modal fade" id="addUser" role="dialog">

  <div class="modal-dialog">

  
    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">

      <!-- Modal Header -->
      <div class="modal-header" style="background: #3c8dbc; color: #fff">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add User</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="box-body">

          <!-- for entry fir number -->
          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="newName" placeholder="Add Name" required>
              </div>
          </div>    

              <!-- user entry -->
          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" name="newUser" placeholder="Add username" required>
              </div>
          </div>

          <!-- password entry -->
          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="newPasswd" placeholder="Input password" required>
              </div>
          </div>

            <!-- user profile entry -->
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
            <input type="file" id="newPhoto" name="newPhoto">
            <p class="help-block">Only max of 200MB per Photo</p>
            <img src="views/img/users/default/anonymous.png" class="img-thumbnail" width="100px">
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
