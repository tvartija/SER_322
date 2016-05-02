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
        echo "<h1>Filtered by Genre:</h1>"
      ?>
        </div>
        <!-- end title -->

      <!-- Search form -->
        <div class="row">
          <form action="search.php" method="POST">
            <div class="form-group">
              <label for="searchString">Search</label>
              <input type="textfield" class="form-control" id="searchString" name="searchString" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Search</button>
          </form>
        </div>
        <!-- end form -->
      <?php
      $query = "SELECT * FROM genre, title WHERE genre.GenreID='" . $_POST['genreID'] . "' AND genre.GenreID = title.GenreID";
      if($result=$mysqli->query("$query")){
        while($row=$result->fetch_assoc()){
          $thisform='<form action="titleinfo.php" method="POST">' .
                '<input type="hidden" name="TitleID" value=' . $row["TitleID"] . '>' .
                '<button type="submit" class="btn btn-default">View this title</button>' .
                '</form>';
          echo '<div style="margin-top:50px;"> <img src="' . $row['ImageFile'] . 
          '" alt="' . $row['Name'] . 
          '" style="width:150px;height:250px;">' . 
          $row['Name'] . "$thisform" . '</div>';
        }
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