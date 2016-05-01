<!DOCTYPE html>
<html>
  <head>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap/js/jquery-2.2.3.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet" media="all" />

    <!-- connect to MySQL DB -->
    <?php
		$user = 'root';
		$password = 'root';
		$db = 'book_inventory';
		$host = 'localhost';
		$port = 8889;

		//$connect = mysql_connect(
		//   "$host:$port", 
		//   $user, 
		//  $password
		//);
		
		//$db = mysql_select_db('mysql');
		$mysqli = new mysqli("$host","$user","$password","$db","$port");
		if($mysqli->connect_errno){
			echo "Connection to MySQL failed: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
		}
		//echo $mysqli->host_info . "\n";
		$query = "SELECT * FROM book";
		//$result = mysql_query( $query );
		$result=$mysqli->query("$query");
      
    ?>
    
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
          <a class="navbar-brand" href="#">BookStore</a>
        </div> 
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Help</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <!-- Page Title -->
      <div class="row">
        <h1>Enter Login Information</h1>
      </div>
      <!-- end title -->

      <!-- Login form -->
      <div class="row">
        <form action="login.php" method="POST">
          <div class="form-group">
            <label for="userEmail">Email address</label>
            <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="userPassword">Password</label>
            <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-default">Login</button>
        </form>
      </div>
      <!-- end form -->
	  
	  <!-- Setup Account -->
      <div class="row">
        <h1>Setup Account</h1>
      </div>
      <!-- end title -->

      <!-- Login form -->
      <div class="row">
        <form action="signup.php" method="POST">
		  <div class="form-group">
            <label for="userName">Name</label>
            <input type="textfield" class="form-control" id="userName" name="userName" placeholder="Name">
          </div>
		  <div class="form-group">
            <label for="userShippingAddress">Shipping Address</label>
            <input type="textfield" class="form-control" id="userShippingAddress" name="userShippingAddress" placeholder="Shipping Address">
          </div>
		  <div class="form-group">
            <label for="userBillingAddress">Billing Address</label>
            <input type="textfield" class="form-control" id="userBillingAddress" name="userBillingAddress" placeholder="Billing Address">
          </div>
		  <div class="form-group">
            <label for="userDriversLicense">Drivers License</label>
            <input type="textfield" class="form-control" id="userDriversLicense" name="userDriversLicense" placeholder="Drivers License">
          </div>
          <div class="form-group">
            <label for="userEmail">Email address</label>
            <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="userPassword">Password</label>
            <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-default">Login</button>
        </form>
      </div>
      <!-- end form -->
    </div>
  </body>
</html>