<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: ../login.php');
}
?>

<?php
//including the database connection file
include_once("../connection.php");

//fetching data in descending order (lastest entry first)
 
$result = mysqli_query($link, "SELECT * FROM orders");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ManGo | Order</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Form Editor js
      <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>-->
  </head>
  <body>
  <div class="fh5co-loader"></div>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">ManGo</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="dashview.php">Dashboard</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="order.php">Orders</a></li>
            <li><a href="customerpage.php">Customers</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome,<?php echo $_SESSION['name'] ?> ! </a></li>
            <li><a href="../logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span><img src="mango.svg" alt="ManGo" width="40" height="40" aria-hidden="true"></span>&nbsp; ManGo <small>Manage Arrange Navigate </small></h1>
          </div>
          <div class="col-md-2">
            <div class="dropdown create">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Create Data
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a type="button" data-toggle="modal" data-target="#addPage">Add Product</a></li>
                <li><a type="button" data-toggle="modal" data-target="#addCustomer">Add Customer</a></li>
                <li><a href="#">Add Car</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="dashview.php">Dashboard</a></li>
          <li class="active">Orders</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="dashview.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="products.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Products <span class="badge">12</span></a>
              <a href="order.php" class="list-group-item"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Orders <span class="badge">33</span></a>
              <a href="customerpage.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Customers <span class="badge">3</span></a>
              <a href="pack.php" class="list-group-item"><span class="glyphicon glyphicon-th"aria-hidden="true"></span> Arrange <span class="badge"></span></a>
              <a href="maps/map.php" class="list-group-item"><span class="glyphicon glyphicon-map-marker"aria-hidden="true"></span> Navigate <span class="badge"></span></a>

            </div>

            <div class="well">
              <h4>Disk Space Used</h4>
              <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                      60%
              </div>
            </div>
            <h4>Bandwidth Used </h4>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                    40%
            </div>
          </div>
            </div>
          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            
              <!-- Latest Users -->
              <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                  <h3 class="panel-title">Orders List</h3>
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-hover">
                      <tr>
                        <th>Order</th> 
                        <th>Date</th> 
                        <th>Address</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Update</th>
                      </tr>
                      <?php
                         while($res = mysqli_fetch_array($result)) {		
                            echo "<tr>";
                            echo "<td>".$res['orderid']."</td>";
                            echo "<td>".$res['date']."</td>";
                            echo "<td>".$res['shipaddress']."</td>";
                            echo "<td>".$res['cusname']."</td>";
                            echo "<td>".$res['cusphone']."</td>";	
                            echo "<td><a href=\"editor.php?id=$res[orderid]\">Edit</a> | <a href=\"delete.php?id=$res[orderid]\"  onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";	
                            }
                      ?>
                    </table>
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Nadthapon Sukeewadthana 2020</p>
    </footer>

    <!-- Modals -->

    <!-- Add Product -->
    <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="add.php" method="post" name="form1" onSubmit="window.location.reload()">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Product</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Product Name</label>
          <input type="text" class="form-control" name="name" placeholder="Product Name">
        </div>
        <div class="form-group">
          <label>Quantity</label>
          <input type="text" class="form-control" name="qty" placeholder="Product Quantity">
        </div><div class="form-group">
          <label>Price</label>
          <input type="text" class="form-control" name="price" placeholder="Product Price">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="Submit" class="btn btn-primary">Add</button>
      </div>
    </form>
    </div>
  </div>
</div>


<!-- Add Customer -->
<div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="add.php" method="post" name="form1" onSubmit="window.location.reload()">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Product</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Product Name</label>
          <input type="text" class="form-control" name="name" placeholder="Product Name">
        </div>
        <div class="form-group">
          <label>Quantity</label>
          <input type="text" class="form-control" name="qty" placeholder="Product Quantity">
        </div><div class="form-group">
          <label>Price</label>
          <input type="text" class="form-control" name="price" placeholder="Product Price">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="Submit" class="btn btn-primary">Add</button>
      </div>
    </form>
    </div>
  </div>
</div>

    <script>
     CKEDITOR.replace( 'editor1' );
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
