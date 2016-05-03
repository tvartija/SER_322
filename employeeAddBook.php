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

    if( isset($_POST['bookName'])) {
      $titleID = rand();
      $query = "INSERT INTO title (ISBN, TitleID, Name, Author, Publisher, PubYear, GenreID, ImageFile) VALUES ('" . rand() . "', '". $titleID . "', '" .$_POST['bookName'] ."', '" . $_POST['author'] ."', '". $_POST['publisher'] ."', '". $_POST['publishYear'] . "', '". $_POST['genreID'] ."', '". $_POST['imgLink']."')";
      $result=$mysqli->query("$query");

      $query = "INSERT INTO book (Stock, Edition, TitleID, Price) VALUES ('10', '1', '". $titleID."', '". $_POST['price'] ."')";
      $result=$mysqli->query("$query");
    }
    //$query = "INSERT INTO transactions (PurchaseDate, Qty, PurchasePrice, ProductID, CustID) VALUES ('" . date("Y-m-d") . "', '1','". $row['Price'] ."','". $_POST['bookID'] . "','" . $_SESSION['CustID'] . "')";
    
    //$result=$mysqli->query("$query");
    ?>
    <div class="container">
      <!-- Page Title -->
      <div class="row">
        <form action="employeeAddBook.php" method="POST">
          <div class="form-group">
            <label for="bookName">Book Name</label>
            <input class="form-control" name="bookName" placeholder="Book Name">
          </div>
          <div class="form-group">
            <label for="author">Author</label>
            <input class="form-control" name="author" placeholder="Author">
          </div>
          <div class="form-group">
            <label for="publisher">Publisher</label>
            <input class="form-control" name="publisher" placeholder="Publisher">
          </div>
          <div class="form-group">
            <label for="publishYear">Publish Year</label>
            <input class="form-control" name="publishYear" placeholder="Publish Year">
          </div>
          <div class="form-group">
            <label for="imageLink">Image Link</label>
            <input class="form-control" name="imgLink" placeholder="Image Link">
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input class="form-control" name="price" placeholder="Price">
          </div>
          <div class="form-group">
            <label>Genre</label>
            <select name="genreID" class="form-control">
            <?php
                $query = "SELECT * FROM genre";
                $result=$mysqli->query("$query");

                while($row=$result->fetch_assoc()) {
              ?>
                  <option value="<?php echo $row['GenreID']; ?>"><?php echo $row['Name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
      <!-- end title -->
    </div>
  </body>
</html>