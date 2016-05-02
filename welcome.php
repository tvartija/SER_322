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
    <div class="container">
      <!-- Page Title -->
      <div class="row">
        <?php
		    $name=$_SESSION['name'];
			echo "<h1>Welcome $name</h1>"
		?>
      </div>
      <!-- end title -->
	  <!-- Search form -->
      <div class="row">
        <form action="search.php" method="POST">
          <label for="searchString">Search</label>
          <div class="input-group">
            <input type="textfield" class="form-control" id="searchString" name="searchString" placeholder="Search">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-default">Search</button>
            </span>
          </div>
        </form>
      </div>
      <!-- end form -->
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

      $custID = $_SESSION['CustID'];
      $query = "SELECT * FROM title, book, genre WHERE title.TitleID = book.TitleID AND title.GenreID = genre.GenreID AND title.GenreID IN (SELECT genre.GenreID FROM title, book, genre WHERE title.TitleID = book.TitleID AND title.GenreID = genre.GenreID AND book.ProductID IN (SELECT ProductID FROM transactions WHERE CustID='$custID')) AND book.ProductID NOT IN (SELECT book.ProductID FROM title, book, genre WHERE title.TitleID = book.TitleID AND title.GenreID = genre.GenreID AND book.ProductID IN (SELECT ProductID FROM transactions WHERE CustID='$custID'))";
  		$result=$mysqli->query("$query");

      // if no purchases display all books
      if(mysqli_num_rows($result)==0) {
        echo "<h2>Books for Sale:</h2>";
        $query = "SELECT * FROM title, book WHERE title.TitleID = book.TitleID LIMIT 5";
        $result=$mysqli->query("$query");
      } else {
        echo "<h2>Recommended Books from recent purchases:</h2>";
      }
    ?>
      <?php
        while($row=$result->fetch_assoc()) {
      ?>
        <div class="row" style="margin-top: 25px; border-bottom: 1px solid #ccc; padding: 15px">
          <div class="col-md-6">
            <?php echo '<img style="max-width: 150px; heigh: auto;" src="'. $row['ImageFile'] . '" alt="' . $row['Name'] . '">'; ?>
          </div>
          <div class="col-md-6">
            <h4><?php echo $row['Name']; ?></h4>
            <p class="help-block"><?php echo $row['Author']; ?></p>
            <p class="help-block"><?php echo $row['Publisher']; ?></p>
            <form action="purchase.php" method="POST">
              <button type="submit" name="bookID" value="<?php echo $row['ProductID']; ?>" class="btn btn-success">Buy $<?php echo $row['Price']; ?></button>
            </form>
          </div>
        </div>
      <?php
        }
      ?>
      
    </div>
	  

  </body>
</html>