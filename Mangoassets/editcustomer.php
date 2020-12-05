<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: ../login.php');
}
?>

<?php
    require_once '../connection.php';
    $cusname = $cusaddress = $cusphone ="";
    $cusname_err = $cusaddress_err = $cusphone_err = ""; 
    //check
    if(isset($_POST["cusid"]) && !empty($_POST["cusid"])) {

        //get hidden input value
        $id = $_POST["cusid"];

        //validate name
        $input_name = trim($_POST["cusname"]);
        if(empty($input_name)) {
            $cusname_err = "Please enter a name.";
        } else {
            $cusname = $input_name;
        }

         //Validate qty
         $input_address = trim($_POST["cusaddress"]);
         if(empty($input_address)) {
             $cusaddress_err = "Please enter an qty";
         } else {
             $cusaddress = $input_address;
         }

         //Validate price
         $input_phone = trim($_POST["cusphone"]);
         if(empty($input_phone)) {
             $cusphone_err = "please enter phone number";
         } else {
             $cusphone = $input_phone;
         }

         //check input error before insert into database
         if(empty($cusname_err) && empty($cusaddress_err) && empty($cusphone_err)) {
            //prepare an insert statement
            $sql = "UPDATE customers SET cusname=?, cusaddress=?, cusphone=? WHERE cusid=?";

            if($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_address, $param_phone, $param_id);

                $param_name = $cusname;
                $param_address = $cusaddress;
                $param_phone = $cusphone;
                $param_id = $id;

                if(mysqli_stmt_execute($stmt)) {
                    header("location: customerpage.php");
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
            $sql = "SELECT * FROM customers WHERE cusid = ?";
            if($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "i", $param_id);

                //set parametres
                $param_id = $id;

                if(mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);

                    if(mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                        $cusname = $row["cusname"];
                        $cusaddress = $row["cusaddress"];
                        $cusphone = $row{"cusphone"};
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
                            <div class="form-group <?php echo (!empty($cusname_err)) ? 'has-error' : ''; ?>">
                                <label>Name</label>
                                <input type="text" name="cusname" class="form-control" value="<?php echo $cusname; ?>">
                                <span class="help-block"><?php echo $cusname_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($cusaddress_err)) ? 'has-error' : ''; ?>" >
                                <label>Address</label>
                                <textarea type="text" name="cusaddress" class="form-control"><?php echo $cusaddress; ?></textarea>
                                <span class="help-block"><?php echo $cusaddress_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($cusphone_err)) ? 'has-error' : ''; ?>">
                                <label>Phone</label>
                                <input type="text" name="cusphone" class="form-control" value="<?php echo $cusphone; ?>">
                                <span class="help-block"><?php echo $cusphone_err; ?></span>
                            </div>
                            <input type="hidden" name="cusid" value="<?php echo $id; ?>">
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="customerpage.php" class="by=tn btn-default">Cancel</a>
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
