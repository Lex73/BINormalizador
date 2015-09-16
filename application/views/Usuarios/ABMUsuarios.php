<div class="container">
  <div class="row">
    <div class="col-xs-8">
      <div class="alert alert-success">
        <i class="fa fa-users fa-fw fa-2x"></i>
        <?php
          if(isset($user))
          {
            foreach ($user as $row)
            {
              echo 'Modificar: '.$row->IDUsuario.'-'.$row->NombreUsuario;
            }
          }
          else
          {
            echo 'Agregar nuevo usuario';
          }
        ?>
      </div>
    </div>
  </div>
<div class="row">
  <form class="form-horizontal" role="form" name="Form_Agregar_Usuarios" action="<?php echo base_url(); ?>usuarios/operaciones_usuario" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="IDUsuario" class="col-lg-2 control-label">ID de Usuario</label>
      <div class="col-lg-4">
        <input type="text" class="form-control" name ="IDUsuario" id="IDUsuario"
        <?php
            if(isset($user))
            {
                foreach ($user as $row)
                {
                  echo ' value="'.$row->IDUsuario.'" readonly';
                }
            }
            else
            {
                echo ' value="'.@set_value('IDUsuario').'" placeholder="ID Usuario"';
            }
        ?>
        >
      </div>
    </div>
      <div class="form-group">
      <label for="NombreUsuario" class="col-lg-2 control-label">Nombre</label>
      <div class="col-lg-6">
        <input type="text" class="form-control" name ="NombreUsuario" id="NombreUsuario"
        <?php
            if(isset($user))
            {
                foreach ($user as $row)
                {
                  echo ' value="'.$row->NombreUsuario.'"';
                }
            }
            else
            {
                echo ' value="'.@set_value('NombreUsuario').'" placeholder="Nombre Usuario"';
            }
        ?>
        >
      </div>
    </div>
      <?php
      if(!isset($user))
      {
        echo '<div class="form-group">
              <label for="ClaveUsuario" class="col-lg-2 control-label">Password</label>
                <div class="col-lg-6">
                  <input type="password" class="form-control" name ="ClaveUsuario" id="ClaveUsuario" placeholder="Contraseña">
                </div>
              </div>';
      }
    ?>
    <div class="form-group">
      <label for="PerfilUsuario" class="col-lg-2 control-label">Perfil</label>
      <div class="col-lg-4">
              <select class="input-large form-control" name="IDProfile">
                <?php
                  if(!isset($user))
                  {
                    echo '<option value="">Seleccione un Perfil</option>';
                    foreach ($query as $row)
                    {
                      echo '<option value="'.$row->IDPerfiles.'">'.$row->NombrePerfil.'</option>';
                    }
                  }
                  else
                  {
                    foreach ($query as $row)
                    {
                      foreach ($user as $rowAux)
                      {
                        if($rowAux->IDProfile == $row->IDPerfiles)
                        {
                          echo '<option selected value="'.$row->IDPerfiles.'">'.$row->NombrePerfil.'</option>';
                        }
                        else
                        {
                          echo '<option value="'.$row->IDPerfiles.'">'.$row->NombrePerfil.'</option>';
                        }
                      }
                    }
                  }
                ?>
              </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-offset-2 col-lg-10">
       <input class="btn btn-lg btn-primary" type="submit" id="submit"
         <?php
            if(!isset($user))
            {
                echo 'name="submit_Agregar_Usuarios"';
            }
            else
            {
                echo 'name="submit_Modificar_Usuarios"';
            }
          ?>
        value="Aceptar"/>
          <?php
            if(isset($user))
            {
              echo '<input class="btn btn-lg btn-primary" type="submit" name="submit_Blanquear_Clave" value="Blanquear"/>';
            }
          ?>
         <a class="btn btn-lg btn-primary mitooltip" title="Salir sin salvar" href="<?php echo base_url(); ?>usuarios/">Volver</a>
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

<!--C:\Users\alopez\Pictures\cmontano.gif -->
