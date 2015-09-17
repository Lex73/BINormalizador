<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $titulo ?> : BINormalizador</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css//datepicker3.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" >
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/justified-nav.css" >
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"  media="all">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" >
  <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/barra.css" > -->
	<script src="<?php echo base_url(); ?>assets/js/ie-emulation-modes-warning.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
  <style>
      .think{
        display: none;
      }
      .lexHide{
        display: none;
      }
			.sep{
				display: none;
			}
			.bloq1{
				display: none;
			}
      #dateRangeForm .form-control-feedback {
          top: 0;
          right: -15px;
      }
  </style>
</head>
<body>
	<div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="col-xs-2">
          <img class="img-circle" src="<?php echo base_url(); ?>assets/Imagenes/Sistema/BINormalizador.jpg" alt="Generic placeholder image" width="80" height="80">
        </div>
        <div class="col-xs-4">
          <h2 class="text-muted">BINormalizador</h2>
        </div>
        <div class="col-md-6"></div>
      </div>
      <div class="col-md-6">
        <div class="col-xs-1"></div>
        <div class="col-xs-1"></div>
        <div class="col-xs-6">
            <h6 class="text-right text-muted">Usuario : <?php echo $usuario ?> </h6>
            <h6 class="text-right text-muted">Nombre : <?php echo  $nombre ?> </h6>
            <h6 class="text-right text-muted">Perfil : <?php echo  $perfil ?> </h6>
						<h6 class="text-right text-muted">Cuenta : <?php echo  $cuenta ?> </h6>
        </div>
        <div class="col-xs-2">
          <img class="img-circle" src="<?php echo base_url(); ?>assets/Imagenes/Usuarios/<?php echo $usuario.'.gif' ?> " alt="Generic placeholder image" width="80" height="80">
        </div>
      </div>
    </div><!--row-->

    <div class="row">
			<br>
      <div class="col-lg-12">
        <div class="btn-group">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-safari fa-fw"></i>Navegación
					</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo base_url(); ?>home/"><i class="fa fa-home fa-fw"></i> Home</a></a></li>
						</ul>
					</div>

				<?php
						if($cuenta == 'Adm sitio')
						{
								echo '<div class="btn-group">';
				          echo '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">';
				            echo '<i class="fa fa-university fa-lg fa-fw"></i>Administración';
				          echo '</button>';
				          echo '<ul class="dropdown-menu" role="menu">';
										echo '<li><a href="'.base_url().'Usuarios/"><i class="fa fa-users fa-fw"></i> Usuarios</a></li>';
										echo '<li><a href="'.base_url().'Perfiles/"><i class="fa fa-graduation-cap fa-fw"></i> Perfiles</a></li>';
										echo '<li><a href="'.base_url().'Clientes/"><i class="fa fa-btc fa-fw"></i> Clientes</a></li>';
										echo '<li><a href="'.base_url().'Cuentas/"><i class="fa fa-credit-card fa-fw"></i> Cuentas</a>';
				          echo '</ul>';
				        echo '</div>';
						}
				?>
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-list-ol fa-lg fa-fw"></i>Operaciones
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo base_url(); ?>Procesos/"><i class="fa fa-level-up fa-fw"></i> Procesar</a></li>
            <li><a href="<?php echo base_url(); ?>Registros/"><i class="fa fa-sort-amount-asc fa-fw"></i> Registros</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url(); ?>Usuarios/CambiaClave"><i class="fa fa-asterisk fa-fw"></i> Clave</a></li>
            <li><a href="<?php echo base_url(); ?>Login/"><i class="fa fa-user-times fa-fw"></i> Logout</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url(); ?>About/"><i class="fa fa-thumbs-up fa-fw"></i> About</a></li>
          </ul>
        </div>
      </div>

    </div><!--row-->

    <br>

    <div class="row">
      <div class="col-lg-12">
        <div class="alert alert-success">
							<i class="fa fa-magic fa-fw"></i> Sistema de Normalización de documentos de BI
        </div>
      </div>
    </div><!--row-->

</div><!--Container-->
