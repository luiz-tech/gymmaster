<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ Route::currentRouteName() }} | {{ env('APP_NAME') }}</title>

  <link rel="shortcut icon" href="resources/images/logo-white.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="adminlte/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="adminlte/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="adminlte/plugins/summernote/summernote-bs4.min.css">

  <!-- Datatables - Páginas de Consulta-->
  <link rel="stylesheet" href="adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake img-circle" src="resources/images/logo-white.png" alt="{{ env('APP_NAME') }} Logo" height="60" width="60">
  </div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars"></i>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('Painel') }}" class="nav-link">Painel</a>
    </li>
    <li class="nav-item">
      <a href="https://www.instagram.com/luiz_websolucoes/" target="_blank" class="nav-link">Sobre Nós</a>
    </li>
    <!-- Add more menu items as needed -->
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Add user profile, notifications, and other links here -->
  </ul>
</nav>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('Painel') }}" class="brand-link">
    <img src="resources/images/logo-white.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <?php $nomeCompleto = Auth::user()->nome; ?>
        <?php list($primeiroNome, $segundoNome) = explode(' ', $nomeCompleto); ?>
        <a href="#" class="d-block">{{ $primeiroNome }} {{ $segundoNome }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Alunos -->
        <li class="nav-item menu-close">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-users"></i>
            <p>Gerenciar Alunos<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('Lista de Alunos',['status'=>'all']) }}" class="nav-link">
                <i class="far fa-circle text-light nav-icon"></i>
                <p>Todos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('Lista de Alunos',['status'=>'a']) }}" class="nav-link">
                <i class="far fa-circle text-success nav-icon"></i>
                <p>Ativos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('Lista de Alunos',['status'=>'i']) }}" class="nav-link">
                <i class="far fa-circle text-danger nav-icon"></i>
                <p>Inativos</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Instrutores -->
        <li class="nav-item menu-close">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-users"></i>
            <p>Personal Trainers<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('Lista de Instrutores',['status'=>'all']) }}" class="nav-link">
                <i class="far fa-circle text-light nav-icon"></i>
                <p>Todos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('Lista de Instrutores',['status'=>'a']) }}" class="nav-link">
                <i class="far fa-circle text-success nav-icon"></i>
                <p>Ativos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('Lista de Instrutores',['status'=>'i']) }}" class="nav-link">
                <i class="far fa-circle text-danger nav-icon"></i>
                <p>Inativos</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="{{ route('Lista de Planos') }}" class="nav-link">
            <i class="nav-icon fa fa-bolt text-warning" aria-hidden="true"></i>
            <p>Gym Planos <span class="right badge badge-danger">{{ App\Models\Planos::count() }}</span></p>
          </a>
        </li>

        <!-- Financeiro -->
        <li class="nav-item">
          <a href="{{ route('Pagamentos') }}" class="nav-link">
           <i class="nav-icon fa fa-cart-arrow-down text-success" aria-hidden="true"></i>
            <p>Financeiro</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('Logout') }}" class="nav-link">
            <i class="nav-icon fa fa-power-off text-danger" aria-hidden="true"></i>
            <p>Sair<span class="right badge badge-danger"></p>
          </a>
        </li>
        

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
