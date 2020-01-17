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
          <div class="box-header with-border"></div>

            <form role="form" method="POST">
              
              <div class="box-body">
                <div class="box">

                   <!--=====================================
                      Parts User Input
                     ======================================-->

                     <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <select type="text" class="form-control" id="newpartsUser" name="newpartsUser" placeholder="Parts User" required>
                            <option value="">Parts User Selection</option>  
                          </select>
                        <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addpartsUser">Parts User</button></span>
                      </div>
                  </div>
            
                </div>

              </div>
                
            </form>
        


        </div>
      
      </div>

      <!--=====================================
                      Table Parts
        ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
                  
                
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

