<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= $this->config->base_url(); ?>admlte/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?= $this->config->base_url(); ?>admlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $this->config->base_url(); ?>admlte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= $this->config->base_url(); ?>admlte/dist/css/skins/_all-skins.min.css">
  <!-- jQuery 2.2.3 -->
<script src="<?= $this->config->base_url(); ?>admlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= $this->config->base_url(); ?>admlte/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= $this->config->base_url(); ?>admlte/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= $this->config->base_url(); ?>admlte/dist/js/demo.js"></script>

  <script src="<?= $this->config->base_url(); ?>admlte/dist/js/moviles.js"></script>
  <script src="<?= $this->config->base_url(); ?>admlte/plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
     <!--   <script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3&sensor=false&language=en"></script>-->
        

</head>
<body class="hold-transition skin-blue sidebar-mini">


<script>
function eventFire(el, etype){
  if (el.fireEvent) {
    el.fireEvent('on' + etype);
  } else {
    var evObj = document.createEvent('Events');
    evObj.initEvent(etype, true, false);
    el.dispatchEvent(evObj);
  }
}
</script>
    <form action="<?= $this->config->base_url(); ?>Moviles/EnServicio" method="POST">
      <div class="modal modal-default fade" id="modal-tomaviaje" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="titulo"><i class="fa fa-car"></i>Nueva solicitud de viaje codigo &nbsp; <strong><span id="codigo"></span></strong></h4>
          </div>
          <div class="modal-body">
            <div class="box-body table-responsive">
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-12">
                    <input type="hidden" id="ID_VIAJE" name="ID_VIAJE" />
                    <input type="hidden" id="delete-title" name="delete-title" />
                    <input type="hidden" id="lf" name="delete-title" />
                    <input type="hidden" id="lngf" name="delete-title" />
                    <p><strong>Pasajero</strong><span id="pasajero"></span></p>
                    <p><strong>Dirección de origen  </strong><span id="origen"></span></p>
                    <p><strong>Dirección de destino </strong><span id="destino"></span></p>
                    <p><strong>Asigne el remis</strong></p>
                    <div class="callout callout-primary">
                      <select class="form-control" name="remis" id="id_remis"></select>
                    </div>
                    <p><strong>Chofer </strong><span id="id_fercho"></span></p>
                  </div>
                </div>
              </div>
            </div><!-- /.box-body -->
          </div>
          <div class="modal-footer">
            <button type="button" onclick="rech();" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
            <button id="btn-delete" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Aceptar</button>
          </div>
        </div>
      </div>
    </div>
    </form>

<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>T</b>R</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Tu</b>Remis</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
             <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">3</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tienes 3 notificaciones</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Revesa de FAS-007 proxima a vencer
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-red"></i> ¡Revesa de ASD-123 VENCIDA!
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> El seguro la concha de tu madre!
                    </a>
                  </li>
 
                </ul>
              </li>
              <li class="footer"><a href="#">Ver todo</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= $this->config->base_url(); ?>admlte/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Gradín</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= $this->config->base_url(); ?>admlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= $this->config->base_url(); ?>admlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENÚ DE NAVEGACION</li>
        <li class="active">
          <a href="pages/widgets.html">
            <i class="fa fa-th"></i> <span>Inicio</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Moviles</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= $this->config->base_url(); ?>moviles/nuevo"><i class="fa fa-circle-o"></i>Nuevo movil</a></li>
            <li class="active"><a href="<?= $this->config->base_url(); ?>moviles/mis_moviles"><i class="fa fa-circle-o"></i> Listado de moviles</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Choferes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= $this->config->base_url(); ?>choferes/nuevo"><i class="fa fa-circle-o"></i>Nuevo chofer</a></li>
            <li class="active"><a href="<?= $this->config->base_url(); ?>choferes/mis_choferes"><i class="fa fa-circle-o"></i> Listado de choferes</a></li>
          </ul>
        </li>
        
        <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentación</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
<div id="caja">

</div>
<script>
$("document").ready(function(){
        /*  $.ajax({
            type: "GET",
            url: 'Moviles/Get_New',
            success: function(data) {
             
                $("#caja").html(data);
            }
          });*/
  });
var refresca = true;/*
setInterval(function(){ 
if (refresca){
      $.ajax({
            type: "GET",
            url: 'Viajes/ConsultaViaje2/COD35DD5CC4E12B7FC',
            success: function(data) {
              if (data.length > 1){
         //       $("#caja").html(data);
                var viaje = jQuery.parseJSON(data);
                $("#ID_VIAJE").val(viaje.ID_VIAJE);
                $("#codigo").html(viaje.CODIGO_VIAJE);
                $("#lf").val(viaje.LATITUD_FORMAL);
                $("#lngf").val(viaje.LONGITUD_FORMAL);
                $("#pasajero").html(' '+viaje.PASAJERONOMBRE);
                $("#origen").html(' '+viaje.DIRECCION_ORIGEN);
                $("#destino").html(' '+viaje.DIRECCION_DESTINO);
                $('#modal-tomaviaje').modal('show');
                }else{
              //        $("#caja").html('no hay viajes');
                     $('#modal-tomaviaje').modal('hide');
                }
              }
               
          
            
        });
}


 }, 10000);
*/
function rech(){
  location.href="<?= $this->config->base_url(); ?>Viajes/Rechaza/"+$("#ID_VIAJE").val()+"/"+$("#lf").val()+"/"+$("#lngf").val();
}  
 </script>


