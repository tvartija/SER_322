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
      $user = 'book_inv_user';
      $password = 'user123';
      $db = 'book_inventory';
      $host = 'localhost';
      $port = 8889;

      $connect = mysql_connect(
         "$host:$port", 
         $user, 
         $password
      );

      $db = mysql_select_db('mysql');

      $query = "SELECT * FROM books";

      $result = mysql_query( $query );
      
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
          <a class="navbar-brand" href="#">Brand</a>
        </div> 
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <!-- Page Title -->
      <div class="row">
        <h1>Hello, World</h1>
      </div>
      <!-- end title -->

      <!-- Example of a form -->
      <div class="row">
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group">
            <p class="help-block">Example block-level help text here.</p>
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox"> Check me out
            </label>
          </div>
        </form>
      </div>
      <!-- end form -->

      <!-- example of buttons -->
      <div class="row">
        <button type="button" class="btn btn-default">I'm a button</button>
        <button type="button" class="btn btn-primary">Button</button>
        <button type="button" class="btn btn-danger">Add Function Here</button>
      </div>
      <!-- end buttons -->

      <!-- Example of building a table off a SQL query -->
      <div class="row">
        <table class="table table-bordered table-hover">
          <thead>
            <td>ProductID</td>
            <td>Edition</td>
            <td>Stock</td>
          </thead>
          <tbody>
            <?php
              // fetch each record in result set
              // Loop through each row in DB
              for ( $counter = 0; $row = mysql_fetch_row( $result );
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