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
		$query = "SELECT * FROM transactions WHERE CustID = $_SESSION['CustID']} " ;
		if($result=$mysqli->query("$query")){
			echo <'table align="left" cellspacing="5" cellpadding="8">;
			<tr><td align="left"><b>CustID</b></td>
			<td align="left"><b>ProductID</b></td>
			<td align="left"><b>PurchaseDate</b></td>
			<td align="left"><b>PurchasePrice</b></td>
			<td align="left"><b>Qty</b></td>
			<td align="left"><b>TransactionID</b></td></tr>';
			
			while($row = mysqli_fetch_array($result)){
				echo '<tr><td align="left">' .
				$row['CustID'] . '</td><td align="left">'.
				$row['ProductID'] . '</td><td align="left">'.
				$row['PurchaseDate'] . '</td><td align="left">'.
				$row['PurchasePrice'] . '</td><td align="left">'.
				$row['Qty'] . '</td><td align="left">'.
				$row['TransactionID'] . '</td><td align="left">';
				
				echo '</tr>';
			}
			
			echo '</table>';
			
			
		} else {
			echo "Transaction Log search failed.";
		}
		
		
      ?>
    </div>
	  

  </body>
</html>