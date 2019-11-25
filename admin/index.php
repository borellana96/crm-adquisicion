<?php
include "../configs/config.php";
include "../configs/funciones.php";

if(isset($logear)){
  $email = clear($email);
  $password = clear($password);

  $q = $mysqli->query("SELECT * FROM admins WHERE email = '$email' AND password = '$password'");

  if(mysqli_num_rows($q)>0){
    $r = mysqli_fetch_array($q);
    $_SESSION['id'] = $r['id'];
    redir("./");
  }else{
    alert("Los datos no son validos",0,'index');
  }


}

if(isset($cerrarsesion)){
  $email = clear($email);
  $password = clear($password);
  $q = $mysqli->query("SELECT * FROM admins WHERE email = '$email' AND password = '$password'");
  $r = mysqli_fetch_array($q);
  $id = $r['id'];
  $mysqli->query("UPDATE admins SET ultimo=CURRENT_TIMESTAMP WHERE id = '$id'");
    redir("proyecto\index.php");
  

}


if(!isset($_SESSION['id'])){
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>Admin Panel</title>
  </head>
  <body style="background: #08f;color:#fff">
     <center>
        <form style="padding-top:10%;" method="post" action="">
          <div class="centrar_login">
            <label><h2><i class="fa fa-key"></i> Iniciar Sesión Como Administrador</h2></label>
            <div class="form-group">
              <input style="padding:10px;color:#333;width:40%" type="text" class="form-control" placeholder="Usuario" name="email"/>
            </div>

            <div class="form-group">
              <input style="padding:10px;color:#333;width:40%" type="password" class="form-control" placeholder="Contraseña" name="password"/>
            </div>
            <br><br>

            <div class="form-group">
              <button name="logear" type="submit"><i class="fa fa-sign-in"></i> Ingresar</button>
            </div>
          </div>
        </form>
      </center>
  </body>
  </html>
  <?php
  die();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administrador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
   <!-- HighCharts -->
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <!-- Morris chart -->
  <!-- <link rel="stylesheet" href="plugins/morris/morris.css"> -->
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="../fontawesome/css/all.css"/>
  <script type="text/javascript" src="../fontawesome/js/all.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo" style="max-height: 100px; height: 45px;">
      <span class="logo-mini"><image src="https://scontent.flim5-4.fna.fbcdn.net/v/t1.15752-9/75394799_478964576045803_3773004915564085248_n.png?_nc_cat=102&_nc_oc=AQmAQxAWZTkwBpu17MbBvYNLItaykKJEQiUb-hEqlOmzXumMU6BFu6AhLh2eonWTHao&_nc_ht=scontent.flim5-4.fna&oh=ca2e8502c67c1e5262a7fd3bf777707b&oe=5E53EF75" weigth=30 width=30></image></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <b>Electro</b>FISI</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class=" navbar-static-top" style="height: 45px; background-color: #3c8dbc">
      <!-- Sidebar toggle button-->
      <!-- <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a> -->
      <div class="float-right">
        <ul class="list-inline">         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu"  >
            
            <a href=""></a>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?=admin_name_connected()?></span>
            </a>
            <ul class="dropdown-menu list-inline">
              <!-- Menu Footer-->
              <li class="user-footer list-inline-item" style="list-style: none;">
                <center>
                  <div>
                    <a href="?p=logout&id=<?$q=['id']?>" name="cerrarsesion" class="btn btn-default">Cerrar Sesion</a>
                  </div>
                </center>
              </li>
            </ul>
          </li>
          <li class="list-inline-item">
            <div> &nbsp;</div>                
          </li>         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu tree" data-widget="tree">
        <li>
          <a href="./">
            <i class="glyphicon glyphicon-home"></i> <span>Principal</span>
          </a>
        </li>
        <li id="treeview-crm" class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-indent-right"></i> <span>Módulos CRM</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="./?p=crm_clientes"><i class="fa fa-user"></i>&nbsp;&nbsp;
            Clientes</a></li>
            <li><a href="./?p=crm_productos"><i class="glyphicon glyphicon-qrcode"></i>
            Productos</a></li>
            <li><a href="./?p=crm_marketing"><i class="glyphicon glyphicon-signal"></i>
            Marketing</a></li>
            <li><a href="./?p=crm_modulo-fidelizacion"><i class="glyphicon glyphicon-gift"></i>
            Fidelización del Cliente</a>
            </li>
          </ul>
        </li> 

        <li id="treeview-sistema-ventas" class="treeview">
          <a href="#">
            <i class="fa fa-cart-plus"></i> <span>Módulos Sistema de Ventas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">            
            <li>
              <a href="./?p=agregar_producto">
                <i class="glyphicon glyphicon-qrcode"></i> <span>Administrar Productos</span>
              </a>
            </li>        
            <li>
              <a href="./?p=agregar_categoria">
                <i class="glyphicon glyphicon-tasks"></i> <span>Administrar Categorias</span>
              </a>
            </li>        
            <li>
              <a href="./?p=admin_clientes">
                <i class="fa fa-user"></i> <span>Clientes</span>
              </a>
            </li>
    <!--         <li>
              <a href="./?p=admin_admins">
                <i class="fa fa-user-plus"></i> <span>Administradores</span>
              </a>
            </li> -->
            <li>
              <a href="./?p=admin_pedidos">
                <i class="fa fa-bars"></i> <span>Pedidos</span>
              </a>
            </li>        
     <!--        <li>
              <a href="./?p=pagos">
                <i class="fa fa-th"></i> <span>Pagos</span>
              </a>
            </li> -->         
          </ul>
        </li> 
      </ul>        
    </section>
    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <?php

    if(!isset($p)){
    ?>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <center>
                <h3><sup style="font-size: 20px">S/.</sup><?=dinero_ventas()?></h3>
              </center>              
            </div>
            <a class="small-box-footer"><p>VENTAS</p></a>
          </div>         
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
            <center>
                <h3><?=num_categorias()?></h3>
              </center>
            </div>
            <a class="small-box-footer"><p>CATEGORIAS</p></a>
          </div>         
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-light-blue">
            <div class="inner">
              <center>
                <h3><?=num_productos()?></h3>
              </center>
            </div>
            <a class="small-box-footer"><p>PRODUCTOS</p></a>
          </div>         
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <center>
                <h3><?=num_clientes()?></h3>
              </center>
            </div>
            <a class="small-box-footer"><p>CLIENTES</p></a>
          </div>         
        </div>


      <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-lg-6">
          <div id="container" style="width:100%; height:400px;">
          </div>
        </div>
        <div class="col-lg-6">
          <div id="container2" style="width:100%; height:400px;">
          </div>
        </div>
      </div>
      <!-- /.row (main row) -->

      <?php
    }else{
      ?>
      <div style="padding:30px;">
      <?php
      if(file_exists("modulos/".$p.".php")){
        include "modulos/".$p.".php";
      }else{
        echo "El modulo solicitado no existe";
      }
      ?>
    </div>
      <?php
    }
    ?>

    </section>
    <!-- /.content -->
  </div>

<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script> -->
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="dist/js/principal.js"></script>
</body>
</html>
