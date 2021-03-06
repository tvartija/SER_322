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
          </ul>
        </div>
      </div>
    </nav>

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

    $book = "SELECT * FROM book WHERE ProductID='" . $_POST['bookID'] . "'";

    $result=$mysqli->query("$book");
    $row=$result->fetch_assoc();

    $query = "INSERT INTO transactions (PurchaseDate, Qty, PurchasePrice, ProductID, CustID) VALUES ('" . date("Y-m-d") . "', '1','". $row['Price'] ."','". $_POST['bookID'] . "','" . $_SESSION['CustID'] . "')";

    $result=$mysqli->query("$query");
    ?>
    <div class="container">
      <!-- Page Title -->
      <div class="row">
        <h1>Thank You for your purchase!</h1>
        <a href="welcome.php">Return Home</a>
      </div>
      <!-- end title -->
    </div>
  </body>
</html>