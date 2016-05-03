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
		session_start();
		if($_SESSION['loggedin']!="YES"){
			echo "Successful login";
			$_SESSION['name']="";
			$url = "Location: index.php";
			header("$url");
			exit;
		}
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
          <a class="navbar-brand" href="index.php">BookStore</a>
        </div> 
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
          <ul class="nav navbar-nav">
            <li class="active"><a href="welcome.php">Home</a></li>
            <li><a href="#">Help</a></li>
            <li class="active"><a href="transaction.php">Transaction Log</a></li>
          </ul>
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="logout.php">Logout</a></li>
		  </ul>
        </div>
        </div>
      </div>
    </nav>
    <div class="container">
      <!-- Page Title -->
      <div class="row">
        <?php
		    $name=$_SESSION['name'];
			echo "<h1>Here is your transaction history, $name</h1>"
		?>
      </div>
      <!-- end title -->
	  <?php
		$user = 'book_inv_user';
		$password = 'user123';
		$db = 'book_inventory';
		$host = 'localhost';
		$port = 8889;

		$mysqli = new mysqli("$host","$user","$password","$db","$port");
		if($mysqli->connect_errno){
			echo "Connection to MySQL failed: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
		}
		$query = "SELECT * FROM transactions WHERE CustID = {$_SESSION['CustID']}";
		
		$result=$mysqli->query("$query");		
		
      ?>
	  <!--Transaction table-->      <div class="row">
        <table class="table table-bordered table-hover">
          <thead>
			<?php
				while($finfo = $result->fetch_field()){
					$column_name=$finfo->name;
					echo( "<td>$column_name</td>" );
				}
			?>
          </thead>
          <tbody>
            <?php
              // fetch each record in result set
              // Loop through each row in DB
              for ( $counter = 0; $row = $result->fetch_row();
                $counter++ )
              {
                // build table to display results
                echo( "<tr>" );

                // Loop through each column
                foreach ( $row as $key => $value )
                  echo( "<td>$value</td>" );

                echo( "</tr>" );
              } // end for
            ?><!-- end PHP script -->
          </tbody>
        </table>
      </div>
    </div>
	  

  </body>
</html>