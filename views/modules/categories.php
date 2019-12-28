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
              Add Category
            </button>

        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tables" width="100%"> 

                <thead> 

                    <tr>  

                        <th style="width:10px">#</th>
                        <th>Category</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                  <tbody> 
                  
                 <?php

                  $item = null;
                  $value = null;
                  $categories = ControllerCategory::ctrShowCategories($item, $value);

                  // var_dump($categories);

                  foreach ($categories as $key => $value) {

                    echo '<tr>
                            <td>'.($key+1).'</td>
                            <td class="text-uppercase">'.$value['category'].'</td>
                            <td>
  
                              <div class="btn-group">                                  
                                <button class="btn btn-warning btnEditCategory" idCategory="'.$value["id"].'" data-toggle="modal" data-target="#editCategory"><i class="fa fa-pencil"></i></button>  
                                <button class="btn btn-danger btnDeleteCategory" idCategory="'.$value["id"].'"><i class="fa fa-times"></i></button>
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
    =     module add Categories            =
    ======================================-->

<!-- The Modal -->
<div class="modal fade" id="addCategory" role="dialog">

  <div class="modal-dialog">

  
    <div class="modal-content">

      <form role="form" method="POST">

      <!-- Modal Header -->
      <div class="modal-header" style="background: #3c8dbc; color: #fff">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Category</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="box-body">

          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="newCategory" id="newCategory" placeholder="Add Category" style="autofocus" required>
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
      $createCategory = new ControllerCategory();
      $createCategory -> ctrCreateCategory();
      ?> 
    </form>
    </div>
  </div>
</div>

  <!--=====================================
    =     module add Categories            =
    ======================================-->

<!-- The Modal -->
<div class="modal fade" id="editCategory" role="dialog">

  <div class="modal-dialog">

  
    <div class="modal-content">

      <form role="form" method="POST">

      <!-- Modal Header -->
      <div class="modal-header" style="background: #3c8dbc; color: #fff">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Category</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="box-body">

          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="newCategory" id="newCategory" placeholder="Add Category" style="autofocus" required>
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
      $createCategory = new ControllerCategory();
      $createCategory -> ctrCreateCategory();
      ?> 
    </form>
    </div>
  </div>
</div>
