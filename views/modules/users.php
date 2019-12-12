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

            <button class="btn btn-primary" data-toggle="modal" data-target="#modelAddUser" >
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

            <table class="table table-bordered table-striped"> 
                <thead> 
                    <tr>  
                        <th>#</th>
                        <th>Number</th>
                        <th>User</th>
                        <th>Photo</th>
                        <th>Profile</th>
                        <th>Status</th>
                        <th>Last Login</th>
                        <th>Action</th>
                    </tr>
                </thead>
                  <tbody> 
                      <tr>  
                        <td>1</td>
                        <td>User Administrator</td>
                        <td>admin</td>
                        <td><img src="views/img/users/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                        <td>Administrator</td>
                        <td><button class="btn btn-success btn-xs">Activate</button></td>
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

                  </tbody>

            </table>
          <!-- Start creating your amazing application! -->
        </div>
      </div>
    </section>
  </div>


<!-- Modal -->

<!-- The Modal -->
<div class="modal fade" id="modelAddUser" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Nice Sherwin</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
