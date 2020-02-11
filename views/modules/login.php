<div id="back"></div>

<div class="login-box">
  <div class="login-logo">
    <!-- <a href="../../index2.html"><b>Admin</b>LTE</a> -->
    <a href="../../index2.html"><img class="img-rounded" src="views/img/template/cog-yellow.jpg" style="width: 150px; height: 50px"></a>
  </div>

  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in</p>

    <form method="post">

      <div class="form-group has-feedback">

        <!-- <input type="email" class="form-control" placeholder="Email"> -->
        <input type="text" class="form-control" placeholder="User" name="loginUser" required>

        <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
        <span class="glyphicon glyphicon-user form-control-feedback"></span>       

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Password" name="loginPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>

      <div class="row">
        
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>

<?php 

  $login = new ControllerUsers();
  $login -> ctrUserLogin();

 ?>

    </form>


  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->