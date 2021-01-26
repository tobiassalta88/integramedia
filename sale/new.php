<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $_SESSION['load'] = true;
} else {
  header('Location: login.html');
}

include '../conn.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM clients";
$result = mysqli_query($conn, $sql);

unset($_SESSION['tTemp']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Integramedia | Evaluation</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <!-- Datatables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
  <!-- Alertify -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/themes/bootstrap.min.css"/>
  <!-- Disable buttons in input[type=number] -->
  <!-- <style media="screen">
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
      }
    input[type=number] { -moz-appearance:textfield; }
  </style> -->
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="../logout.php" type="button" class="btn btn-sm btn-danger">Log out</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../dist/img/integramedia.png" alt="Integra Media Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">Integra Media S.R.L.</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['name']; ?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item active">
            <a href="../sales.php" class="nav-link active">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Sales
              </p>
            </a>
          </li>
          <li class="nav-item active">
            <a href="../clients.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Clients
              </p>
            </a>
          </li>
          <li class="nav-item active">
            <a href="../employees.php" class="nav-link">
              <i class="nav-icon fas fa-id-card"></i>
              <p>
                Employees
              </p>
            </a>
          </li>
          <li class="nav-item active">
            <a href="../products.php" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Products
              </p>
            </a>
          </li>
          <li class="nav-item active">
            <a href="../providers.php" class="nav-link">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Providers
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">NEW SALE</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">New Sale</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-10">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Enter the data:</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="formSale">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-sm-4">
                      <label for="inputCliente">Client:</label>
                      <select id="inputCliente" class="form-control select2" style="height: 100%;">
                        <option selected="true" disabled="disabled">Search...</option>
                        <?php while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['name'].' '.$row['last_name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-5">
                    </div>
                    <div class="col-sm-3">
                      <button data-toggle="modal" data-target="#modal-default" style="border-radius:25px" class="btn btn-sm btn-success" type="button" name="button">
                        <i class="fa fa-plus"></i> Add Product
                      </button>
                      <button onclick="restart()" style="border-radius:25px" class="btn btn-sm btn-circle btn-danger" type="button" name="button">
                        <i class="fa fa-trash"></i> Clean
                      </button>
                    </div>
                  </div>

                  <div class="row" id="contTable">

                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="../sales.php" class="btn btn-default" role="button" aria-pressed="true">Cancel</a>
                  <a onclick="send()" role="button" class="btn btn-primary float-right">Send</a>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version 1.0</b>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Search:</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
          $sql = "SELECT prod.*, prov.name AS 'name_provider'  FROM products AS prod INNER JOIN providers AS prov WHERE prod.id_provider = prov.id";
          $result = mysqli_query($conn, $sql);
         ?>
         <table id="example" class="table table-bordered table-hover table-sm" style="width:100%">
           <thead>
               <tr class="bg-gray">
                   <th>Name</th>
                   <th>Brand</th>
                   <th>Price</th>
                   <th>Expiration Date</th>
                   <th>Provider</th>
                   <th>Actions</th>
               </tr>
           </thead>
           <tbody>
             <?php
               while ($row = mysqli_fetch_assoc($result)) {
             ?>
               <tr>
                   <td><?php echo $row['name']; ?></td>
                   <td><?php echo $row['brand']; ?></td>
                   <td><?php echo '$ '.number_format($row['price'],2); ?></td>
                   <td><?php echo $row['expiration_date']; ?></td>
                   <td><?php echo $row['name_provider']; ?></td>
                   <td style="text-align:center">
                     <?php
                       $id = $row['id'];
                       $today = strtotime(date("d-m-Y H:i:00",time()));
                       if (strtotime($row['expiration_date'])>$today){
                       ?>
                       <a data-dismiss="modal" onclick="insertProduct(<?php echo $row['id']; ?>, '<?php echo $row['name']; ?>', <?php echo $row['price']; ?>)" class="btn btn-sm btn-success" role="button">
                         <i class="nav-icon fas fa-level-down-alt"></i>
                       </a>
                       <?php
                       } else {
                       ?>
                        Vencido
                        <?php
                        }
                        ?>
                   </td>
               </tr>
             <?php } ?>
           </tbody>
         </table>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- jquery-validation -->
<script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- InputMask -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Datatables -->
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<!-- Alertify -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/alertify.min.js"></script>
<!-- Integramedia -->
<script src="../dist/js/integramedia.js"></script>
<script>
$(document).ready(function(){
  $('#contTable').load("tableProducts.php");
})
</script>

</script>
</body>
</html>
<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
