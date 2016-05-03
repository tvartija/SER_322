<!DOCTYPE html>
<?php
	session_start();
?>
<html>
  <head>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap/js/jquery-2.2.3.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet" media="all" />
    
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">BookStore</a>
        </div> 
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
          <ul class="nav navbar-nav">
            <li class="active"><a href="welcome.php">Home</a></li>
            <li><a href="#">Help</a></li>
          </ul>
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="#">Employee Login</a></li>
		</ul>
        </div>
        </div>
      </div>
    </nav>
    <div class="container">
      <!-- Page Title -->
      <div class="row">
        <h1>Enter Employee Login Information</h1>
      </div>
      <!-- end title -->

      <!-- Login form -->
      <div class="row">
        <form action="employeelogin.php" method="POST">
          <div class="form-group">
            <label for="empEmail">Email address</label>
            <input type="email" class="form-control" id="empEmail" name="empEmail" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="empPassword">Password</label>
            <input type="password" class="form-control" id="empPassword" name="empPassword" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-default">Login</button>
        </form>
      </div>
      <!-- end form -->
	  
	  <!-- Setup Account -->
      <div class="row">
        <h1>New Employee Account</h1>
      </div>
      <!-- end title -->

      <!-- Login form -->
      <div class="row">
        <form action="employeesignup.php" method="POST">
		  <div class="form-group">
            <label for="empName">Name</label>
            <input type="textfield" class="form-control" id="empName" name="empName" placeholder="Name">
          </div>
		  <div class="form-group">
            <label for="empAddress">Address</label>
            <input type="textfield" class="form-control" id="empAddress" name="empAddress" placeholder="Address">
          </div>
		  <div class="form-group">
            <label for="empDriversLicense">Drivers License</label>
            <input type="textfield" class="form-control" id="empDriversLicense" name="empDriversLicense" placeholder="Drivers License">
          </div>
          <div class="form-group">
            <label for="empEmail">Email address</label>
            <input type="email" class="form-control" id="empEmail" name="empEmail" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="empPassword">Password</label>
            <input type="password" class="form-control" id="empPassword" name="empPassword" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-default">Login</button>
        </form>
      </div>
      <!-- end form -->
    </div>
  </body>
</html>