<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

        Parts Categories

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

            <button class="btn btn-primary" data-toggle="modal" data-target="#addCategory" >
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
                        <th>Total Parts Withdrawn</th>
                        <th>Last Withdrawn</th>
                        <th>Last login</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                  <tbody> 

                      <tr>  
                        <td>1</td>
                        <td>Jamal</td>
                        <td>8161123</td>
                        <td>jamaludding@pciltd.com.sg</td>
                        <td>+6281270068807</td>
                        <td>PCI Batam</td>
                        <th>2</th>
                        <td>2020-01-10 12:05:32</td>
                        <td>
                          <div class="btn-group"> 
                                <button class="btn btn-wwarning"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                          </div>
                        </td>
                     </tr> 
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
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="newPartsUser" placeholder="Add Parts User" required>
              </div>
          </div>    

          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="number" min="0" class="form-control input-lg" name="newDocumentId" placeholder="Add ID Number" required>
              </div>
          </div>    

          <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="email" min="0" class="form-control input-lg" name="newEmail" placeholder="Add Email Address" required>
              </div>
          </div> 

          <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" min="0" class="form-control input-lg" name="newPhone" placeholder="Add Contact Number" required data-inputmask="'mask':'(999) 999-9999'" data-mask>
              </div>
          </div>

        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default oull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Category</button>
      </div>

     <?php
      // $createUser = new ControllerUsers();
      // $createUser -> ctrCreateUser();
      ?> 

    </form>

    </div>
  </div>
</div>
