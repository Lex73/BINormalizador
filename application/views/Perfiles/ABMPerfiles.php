<div class="container">
  <div class="row">
    <div class="col-xs-8">
      <div class="alert alert-success">
        <i class="fa fa-graduation-cap fa-fw fa-2x"></i>
        <?php
          if(isset($perfiles))
          {
            foreach ($perfiles as $row)
            {
              echo 'Modificar: '.$row->IDPerfiles.'-'.$row->NombrePerfil;
            }
          }
          else
          {
            echo 'Agregar nuevo perfil';
          }
        ?>
      </div>
    </div>
  </div>
<div class="row">
  <form class="form-horizontal" role="form" name="Form_Agregar_Perfiles" action="<?php echo base_url(); ?>perfiles/operaciones_perfil" method="POST">
    <div class="form-group">
      <label for="IDPerfiles" class="col-lg-2 control-label">ID Perfil</label>
      <div class="col-lg-4">
        <input type="text" class="form-control" name ="IDPerfiles" id="IDPerfiles"
        <?php
            if(isset($perfiles))
            {
                foreach ($perfiles as $row)
                {
                  echo ' value="'.$row->IDPerfiles.'" readonly';
                }
            }
            else
            {
                echo ' value="'.@set_value('IDPerfiles').'" placeholder="ID Perfil"';
            }
        ?>
        >
      </div>
    </div>
      <div class="form-group">
      <label for="NombrePerfil" class="col-lg-2 control-label">Nombre</label>
      <div class="col-lg-6">
        <input type="text" class="form-control" name ="NombrePerfil" id="NombrePerfil"
        <?php
            if(isset($perfiles))
            {
                foreach ($perfiles as $row)
                {
                  echo ' value="'.$row->NombrePerfil.'"';
                }
            }
            else
            {
                echo ' value="'.@set_value('NombrePerfil').'" placeholder="Nombre Perfil"';
            }
        ?>
        >
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-offset-2 col-lg-10">
       <input class="btn btn-lg btn-primary" type="submit" id="submit"
         <?php
            if(!isset($perfiles))
            {
                echo 'name="submit_Agregar_Perfiles"';
            }
            else
            {
                echo 'name="submit_Modificar_Perfiles"';
            }
          ?>
        value="Aceptar"/>
        <a class="btn btn-lg btn-primary" href="<?php echo base_url(); ?>perfiles/">Volver</a>
      </div>
    </div>
  </form>
  <div class="col-xs-12">
    <div class="col-xs-4"></div>
    <div class="col-xs-4">
      <p class="text-center text-danger">  <?php echo validation_errors(); ?> </p>
    </div>
    <div class="col-xs-4"></div>
  </div>
  <br>
  </div>
</div> <!-- /container -->
