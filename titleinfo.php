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

    $user = 'book_inv_user';
    $password = 'user123';
    $db = 'book_inventory';
    $host = 'localhost';
    $port = 8889;

    $mysqli = new mysqli("$host","$user","$password","$db","$port");
    if($mysqli->connect_errno){
      echo "Connection to MySQL failed: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
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
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="Llgout.php">Logout</a></li>
		  </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="col-md-3" role="complementary">
        <nav class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix-top" style="">
          <h3>Browse By Genre</h3>
          <ul class="nav bs-docs-sidenav">
            <?php
              $query = "SELECT * FROM genre";
              $result=$mysqli->query("$query");

              while($row=$result->fetch_assoc()) {
            ?>
              <li><a class="genre" genreID="<?php echo $row['GenreID']; ?>" href="javascript:void(0)"><?php echo $row['Name']; ?></a></li>
            <?php } ?>
          </ul>
          <form style="display: none" action="genre.php" method="post" id='form'><input id="genre-form" type="hidden" name="genreID" /></form>
        </nav>
      </div>
      <!-- end genre sidebar -->

      <!-- Page Title -->
      <div class="col-md-6">
        <div class="row">
          <?php
  		    $name=$_SESSION['name'];
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
  		$query = "SELECT * FROM title, book WHERE title.TitleID = '" . $_POST['TitleID'] . "' AND title.TitleID = book.TitleID";
  		if($result=$mysqli->query("$query")){
  			$row=$result->fetch_assoc();
      ?>
      <div class="row">
        <div class="col-md-6">
          <?php echo '<img style="max-width: 150px; heigh: auto;" src="'. $row['ImageFile'] . '" alt="' . $row['Name'] . '">'; ?>
        </div>
        <div class="col-md-6">
          <h4><?php echo $row['Name']; ?></h4>
          <p class="help-block"><?php echo "Author: " . $row['Author']; ?></p>
          <p class="help-block"><?php echo "Publisher: " . $row['Publisher']; ?></p>
          <p class="help-block"><?php echo "Publication Year: " . $row['PubYear']; ?></p>
          <p class="help-block"><?php echo "ISBN: " . $row['ISBN']; ?></p>
          <p class="help-block"><?php echo "Product ID: " . $row['ProductID']; ?></p>
          <?php 
            $price = $row['Price'];
            $pID = $row['ProductID'];

            $query = "SELECT Name FROM Genre WHERE GenreID = " . $row['GenreID'];
            if($result=$mysqli->query("$query")){
              $row=$result->fetch_assoc();
          ?>

          <p class="help-block"><?php echo "Genre: " . $row['Name']; ?></p>
          <form action="purchase.php" method="POST">
            <button type="submit" name="bookID" value="<?php echo $pID; ?>" class="btn btn-success">Buy $<?php echo $price; ?></button>
          </form>
          <?php
            }
          ?>
        </div>
      </div>
      <?php
        }
      ?>
      </div>
	  </div>
    <script>
      $(".genre").click(function (e) {
          $("#genre-form").val($(this).attr('genreID'));
          $("#form").submit();
      });
    </script>
  </body>
</html>