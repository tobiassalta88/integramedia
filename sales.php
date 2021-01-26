<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $_SESSION['load'] = true;
} else {
  header('Location: login.html');
}
include 'conn.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$conn->set_charset("utf8");
// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT s.*, c.name AS 'name_client', e.name as 'name_employee' FROM sales AS s INNER JOIN clients AS c ON s.id_client = c.id INNER JOIN employees AS e ON s.id_employee = e.id";
$result = mysqli_query($conn, $sql);
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
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- Datatables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
  <!-- Alertify -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/themes/bootstrap.min.css"/>
  <!-- Disable buttons in input[type=number] -->
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
        <a href="logout.php" type="button" class="btn btn-sm btn-danger">Log out</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/integramedia.png" alt="Integra Media Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">Integra Media S.R.L.</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['name']; ?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item active">
            <a href="sales.php" class="nav-link active">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Sales
              </p>
            </a>
          </li>
          <li class="nav-item active">
            <a href="clients.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Clients
              </p>
            </a>
          </li>
          <li class="nav-item active">
            <a href="employees.php" class="nav-link">
              <i class="nav-icon fas fa-id-card"></i>
              <p>
                Employees
              </p>
            </a>
          </li>
          <li class="nav-item active">
            <a href="products.php" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Products
              </p>
            </a>
          </li>
          <li class="nav-item active">
            <a href="providers.php" class="nav-link">
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
            <h1 class="m-0 text-dark">SALE LIST</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sale List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div id="divMessage" class="alert alert-warning alert-dismissible" style="display: none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> MESSAGE!</h5>
        <?php echo $_SESSION['message']; ?>
      </div>
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-body">
            <a href="sale/new.php" class="btn btn-info float-right" role="button" aria-pressed="true">
              <i class="nav-icon fas fa-plus"></i>
              New sale
            </a>
            <table id="example" class="table table-bordered table-hover table-sm" style="width:100%">
              <thead>
                  <tr>
                      <th>N°</th>
                      <th>Date and Time</th>
                      <th>Client</th>
                      <th>Employee</th>
                      <th>Total</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                  while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['datetime']; ?></td>
                      <td><?php echo $row['name_client']; ?></td>
                      <td><?php echo $row['name_employee']; ?></td>
                      <td><?php echo '$ ' . number_format($row['total'],2,',','.'); ?></td>
                      <td>
                        <?php
                          $id = $row['id'];
                         ?>
                        <a target="_blank" href="sale/pdf.php?i=<?php echo $id ?>" class="btn btn-sm btn-info" role="button" aria-pressed="true">
                          <i class="nav-icon fas fa-search"></i>
                        </a>
                      </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
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

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Datatables -->
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<!-- Alertify -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/alertify.min.js"></script>
<!-- Integramedia -->
<script src="dist/js/integramedia.js"></script>
<script type="text/javascript">
  function showMessage(){
    $('#divMessage').show();
  }
</script>
</body>
</html>
<?php
if (isset($_SESSION['message'])){
  echo "<script>";
  echo "showMessage();";
  echo "</script>";
  unset($_SESSION['message']);
}

mysqli_free_result($result);
mysqli_close($conn);
?>
