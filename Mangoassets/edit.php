<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: ../login.php');
}
?>

<?php
    require_once '../connection.php';
    $name = $qty = $price = $height = $width ="";
    $name_err = $qty_err = $price_err = $height_err = $width_err = ""; 
    //check
    if(isset($_POST["id"]) && !empty($_POST["id"])) {

        //get hidden input value
        $id = $_POST["id"];

        //validate name
        $input_name = trim($_POST["name"]);
        if(empty($input_name)) {
            $name_err = "Please enter a name.";
        } else {
            $name = $input_name;
        }

         //Validate qty
         $input_qty = trim($_POST["qty"]);
         if(empty($input_qty)) {
             $qty_err = "Please enter an qty";
         } else {
             $qty = $input_qty;
         }

         //Validate price
         $input_price = trim($_POST["price"]);
         if(empty($input_price)) {
             $price_err = "please enter the price amount";
         } else {
             $price = $input_price;
         }

         //validate height
        $input_height = trim($_POST["height"]);
        if(empty($input_name)) {
            $height_err = "Please enter a height.";
        } else {
            $height = $input_height;
        }
        //validate width
        $input_width = trim($_POST["width"]);
        if(empty($input_width)) {
            $width_err = "Please enter a width.";
        } else {
            $width = $input_width;
        }

         //check input error before insert into database
         if(empty($name_err) && empty($qty_err) && empty($price_err)  && empty($height_err)  && empty($width_err)) {
            //prepare an insert statement
            $sql = "UPDATE products SET name=?, qty=?, price=?, height=?, width=? WHERE id=?";

            if($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "sssssi", $param_name, $param_qty, $param_price, $param_height, $param_width, $param_id);

                $param_name = $name;
                $param_qty = $qty;
                $param_price = $price;
                $param_height = $height;
                $param_width = $width;
                $param_id = $id;

                if(mysqli_stmt_execute($stmt)) {
                    header("location: products.php");
                    exit();
                } else {
                    echo "Something went wrong";
                }
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);
        }  else {

        //check existing id
        if(isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
            //get url parameter
            $id = trim($_GET["id"]);

            //prepare a select statement
            $sql = "SELECT * FROM products WHERE id = ?";
            if($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "i", $param_id);

                //set parametres
                $param_id = $id;

                if(mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);

                    if(mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                        $name = $row["name"];
                        $qty = $row["qty"];
                        $price = $row{"price"};
                        $height = $row{"height"};
                        $width = $row{"width"};

                    } else {
                        exit();
                    }
                } else {
                    echo "oops! soething went wrong";
                }
            
            }
            //Close statement
            mysqli_stmt_close($stmt);

            //close connection
            mysqli_close($link); 
        } else {
            //URL doesn't contain id parameter redirect to error.php
            exit();
        }

    }


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ManGo | Edit Page</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>

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
            <li><a href="dashview.php">Dashboard</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="order.php">Orders</a></li>
            <li><a href="customerpage.php">Customers</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome,<?php echo $_SESSION['name'] ?> ! </a></li>
            <li><a href="../index1.php">Logout</a></li>
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
                <li><a href="#">Add Customer</a></li>
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
          <li><a href="products.php">Products</a></li>
          <li class="active">Edit Page</li>
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
              <a href="orders.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Orders <span class="badge">33</span></a>
              <a href="customerpage.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Customers <span class="badge">203</span></a>
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
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Edit Page</h3>
              </div>
              <div class="panel-body">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                                <span class="help-block"><?php echo $name_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($qty_err)) ? 'has-error' : ''; ?>" >
                                <label>Quantity</label>
                                <textarea type="text" name="qty" class="form-control"><?php echo $qty; ?></textarea>
                                <span class="help-block"><?php echo $qty_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>">
                                <label>Price</label>
                                <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                                <span class="help-block"><?php echo $price_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($height_err)) ? 'has-error' : ''; ?>">
                                <label>Height</label>
                                <input type="text" name="height" class="form-control" value="<?php echo $height; ?>">
                                <span class="help-block"><?php echo $height_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($width_err)) ? 'has-error' : ''; ?>">
                                <label>Width</label>
                                <input type="text" name="width" class="form-control" value="<?php echo $width; ?>">
                                <span class="help-block"><?php echo $width_err; ?></span>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="products.php" class="by=tn btn-default">Cancel</a>
                        </form>
              </div>
              </div>

          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Nadthapon 2020</p>
    </footer>

    <!-- Modals -->

    <!-- Add Page 
    <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Page</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Page Title</label>
          <input type="text" class="form-control" placeholder="Page Title">
        </div>
        <div class="form-group">
          <label>Page Body</label>
          <textarea name="editor1" class="form-control" placeholder="Page Body"></textarea>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox"> Published
          </label>
        </div>
        <div class="form-group">
          <label>Meta Tags</label>
          <input type="text" class="form-control" placeholder="Add Some Tags...">
        </div>
        <div class="form-group">
          <label>Meta Description</label>
          <input type="text" class="form-control" placeholder="Add Meta Description...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>-->

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
