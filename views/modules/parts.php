<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

        <!-- User Management -->

        <medium>Spare Parts Management</medium>

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

            <button class="btn btn-primary" data-toggle="modal" data-target="#addPart" >
              Add Part
            </button>
      
        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tableProducts" width="100%"> 

                <thead> 


                    <tr>  

                        <th style="width:10px">#</th>
                        
                        <th>Image</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Buying Price</th>
                        <th>Selling Price</th>
                        <th>Date Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>
          </table>
        </div>
      </div>
    </section>
  </div>


    <!--=====================================
    =     Module Add Parts            =
    ======================================-->

<div class="modal fade" id="addPart" role="dialog">

  <div class="modal-dialog">

  
    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">

      <!-- Modal Header -->
      <div class="modal-header" style="background: #3c8dbc; color: #fff">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Product</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="box-body">

            <!-- Categories -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" id="newCategory" name="newCategory" required>
                <option value="">Select Category</option>

                <?php
                $item = null;
                $values = null;
                $categories = ControllerCategory::ctrShowCategories($item, $values);

                foreach($categories as $key => $value){
                  echo '<option value="'.$value["id"].'">'.$value["category"].'</option>';
                }
                ?>
                </select>
              </div>
          </div>

          <!-- for Id number -->

          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                <!-- <input type="text" class="form-control input-lg" name="newId" placeholder="Add Id Number" required> -->
                <input class="form-control input-lg" type="text" id="newCode" name="newCode" placeholder="Add Code" required readonly>
              </div>
          </div>    

              <!-- Description Entry -->
          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                <input type="text" class="form-control input-lg" name="newDescription" placeholder="Add Description" required>
              </div>
          </div>

              <!-- Stock Entry -->
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                <input type="number" class="form-control input-lg" name="newStock" min="0" placeholder="Stock" required>
              </div>
          </div>

              <!-- Buying Prince Entry -->
              <div class="form-group row">

              <div class="col-xs-6">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                      <input type="number" class="form-control input-lg" name="newPriceBuy" id="newPriceBuy" name="newPriceBuy" min="0" placeholder="Buying Price" required>
                    </div>
                  </div>
                
              <!-- Selling Price Entry -->
              <div class="col-xs-6">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                      <input type="number" class="form-control input-lg" name="newPriceSell" id="newPriceSell" min="0" placeholder="Selling Price" required>
                  </div>

                  <br>

              <!-- Percentage Checkbox -->

              <div class="col-xs-6">
                <div class="form-group">
                  <label>
                    <input type="checkbox" class="minimal percentage" checked>
                    Use PerCentage
                  </label>
                </div>
              </div>

              <div class="col-xs-6" style="padding:0">
                <div class="input-group"> 
                  <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>
                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>
              </div>                  
            </div>
          </div>

            <!-- Picture entry -->
              <div class="form-group">
                <div class="panel">Upload Profile Photo</div>
                <input type="file" id="newPhoto" name="newPhoto">
                <p class="help-block">Only max of 2MB per Photo</p>
                <img src="views/img/parts/anonymous.png" class="img-thumbnail" width="100px">
              </div>          
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default oull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Part</button>
          </div>

          <?php
              $createPart = new ControllerParts();
              $createPart -> ctrCreatePart();
          ?> 
          
      </form>
    </div>
  </div>
</div>
