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
$result = mysqli_query($link, "SELECT * FROM products WHERE login_id=".$_SESSION['id']." ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <script src="main.js">

  </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ManGo | Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Form Editor js
      <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>-->
      <style>
.colour{
    width:20px;
    height:20px;
    margin: 5px;
    float:left;
}
.colour_d{
    height:20px;
    margin: 5px;
    float:left;       
}
.center {
position: absolute;
left: 0;
top: 50%;
width: 100%;
text-align: center;
font-size: 18px;
}
</style>
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
            <li><a href="pack.php">Orders</a></li>
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
          <li class="active">Dashboard</li>
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
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Website Overview</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-12">
                  <div class="well dash-box" >
                 <h2><img src = truck.svg width=40 height=34 aria-hidden="true"></h2>
                    <h3>Truck</h3>
                    <h4>Size : 250 cm x 174.5 cm</h4>
                  </div>
                </div>
              
              </div>
              </div>

              <!-- Latest Users -->
              <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Product List</h3>
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-hover">
                  <tr>
                        <th>Order</th> 
                        <th>Name</th> 
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Height</th>
                        <th>Width</th>
          
                  
                  </tr>
                  <?php
                        while($res = mysqli_fetch_array($result)) {
                          echo "<tr>";
                          echo "<td>".$res['id']."</td>";
                          echo "<td>".$res['name']."</td>";
                          echo "<td>".$res['qty']."</td>";
                          echo "<td>".$res['price']."</td>";
                          echo "<td>".$res['height']."</td>";
                          echo "<td>".$res['width']."</td>";
                        }
                      ?>
                    </table>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Configuration</h3>
                </div>
                <div class="panel-body">
                <div id="message"></div>
                <table class="table">
                  <tr>
                        <th>Truck info</th> 
                        <td>Toyota Vigo กค4262</td>
                        <td><input id="tank_h" name="tank_height" value="" placeholder="Height(cm)"></td> 
                        <td>x</td>
                        <td><input id="tank_w" name="tank_width"  value="" placeholder="Width(cm)"></td>
                        <td> <button name="add_tank" id="add_tank">Add truck</button></td>
   
                  </tr>

                  <tr>
                        <th>Add Product</th>
                        <td><input id="box_name" name="box_name" value="" placeholder="Product Name"></td>
                        <td><input id="box_h" name="box_height" value="" placeholder="Height(cm)"></td>
                        <td>x</td>
                        <td><input id="box_w" name="box_width"  value="" placeholder="Weight(cm)"></td>
                        <td><button name="add_box" id="add_box">Add product</button></td>
                  </tr>

                  <tr>
                        
                        <td colspan="6"><button name="prepare" id="prepare" disabled="true"> Prepare space</button></td>
                  </tr>
                  <tr>
                        <td colspan="6">Truck size:<span id="container_dimensions"></span> cm</td>
                  </tr>

                  <tr>
                        <td colspan="6">List Products <ul id="boxes_list"></th>

                  </tr>

                  <tr>
                        <td colspan="6"><button class="btn btn-warning" type="button" name="insert_boxes" id="insert_boxes" disabled="true">ARRANGE</button></td>
                  </tr>

                  <tr>
                        <td colspan="6">Oversized:<ul id="oversized_boxes_list"></ul></td>
                  </tr>
                  </table>
                      <div id="select_box">
                          <select id="select-method" name="select-method" disabled="true">
                          </select>
                      </div>
                      <div>
                          <canvas id="show_filled_container"></canvas>
                          </div>
                    
                      <div class="description" id="description0">
                          <div class="colour" id="square0"></div>
                          <div class="colour_d" id="colour_d0"></div>
                      </div>
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
<div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="addcus.php" method="post" name="form2" onSubmit="window.location.reload()">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Customer</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" class="form-control" name="fname" placeholder="Customer Name">
        </div>
        <div class="form-group">
          <label>Address</label>
          <input type="text" class="form-control" name="address" placeholder="Customer Address">
        </div><div class="form-group">
          <label>Phone</label>
          <input type="text" class="form-control" name="phone" placeholder="Customer Phone">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="Submit2" class="btn btn-primary">Add</button>
      </div>
    </form>
    </div>
  </div>
</div>




<!-- Add Customer -->
<div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="addcustomer.php" method="post" name="form2" onSubmit="window.location.reload()">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Customer</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" class="form-control" name="cusname" placeholder="Customer Name">
        </div>
        <div class="form-group">
          <label>Address</label>
          <input type="text" class="form-control" name="cusaddress" placeholder="Customer Address">
        </div><div class="form-group">
          <label>Phone</label>
          <input type="text" class="form-control" name="cusphone" placeholder="Customer Phone">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="Submit2" class="btn btn-primary">Add</button>
      </div>
    </form>
    </div>
  </div>
</div>
<script type="text/javascript">
    
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;    
}

var ctx = [];


var table_of_squares = [];
var table_of_description = [];
var i = 0;
//var przesuniecie = freeBoxes[i].width + 100;


function duplicate(name) {
    var original = document.getElementById(name + i);
    var clone = original.cloneNode(true);
    clone.id = name + (i + 1);
    original.parentNode.appendChild(clone);
}


function show_cargo(chosenCargo){
    i = 0;
    var canvas = document.getElementById("show_filled_container");
    canvas.width = container.width;
    canvas.height = container.height;
    canvas.style.backgroundColor = '#E8EDF2';
    document.getElementById('description0').innerHTML = '<div class="colour" id="square0"></div>'+
        '<div class="colour_d" id="colour_d0"></div>';
   // table_of_squares.length = 0;
   // table_of_description.length = 0;
	for(i; i < chosenCargo.length; i++){
        ctx[i] = canvas.getContext("2d");

       // if(ctx[0]) {ctx[0].rotate(20*Math.PI/180);}
        let box_kolor = getRandomColor(); 
        ctx[i].fillStyle = box_kolor;
        
        ctx[i].fillRect(chosenCargo[i].x, chosenCargo[i].y, chosenCargo[i].width, chosenCargo[i].height);
       // ctx[i].fillStyle = 'white';
      // ctx[i].font = "20px Arial";
      //  ctx[i].fillText(chosenCargo[i].name,chosenCargo[i].x, chosenCargo[i].y);
        
       
      
        duplicate('square');
        duplicate('colour_d');
     
        table_of_squares[i] = document.getElementById('square' + i);
        table_of_squares[i].style.backgroundColor = box_kolor; 
        
        table_of_description[i] = document.getElementById('colour_d' + i);
        table_of_description[i].innerHTML = chosenCargo[i].name + ": " + chosenCargo[i].width +" x "+chosenCargo[i].height;
        
    };

}	



var select_method = document.getElementById("select-method");
    select_method.addEventListener("change", function(){
        show_cargo(cargo[select_method.value].usedBoxes);
    }
);


</script>



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
