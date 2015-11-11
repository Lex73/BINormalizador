<div class="container">
  <?php     if(isset($cambia))
            {
                if ($cambia == 1)
                {
                    echo '<div class="row">';
                    echo '<div class="col-lg-12">';
                    echo '<div class="alert alert-success">';
                    echo 'Es obligatorio reestablecer la contraseña';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                else
                {
                    echo '<br>';
                    echo '<br>';
                }
            }
            else
            {
              echo '<br>';
              echo '<br>';
            }
  ?>
<div class="row">
  <div class="col-xs-12">
    <form class="form-horizontal" role="form" name="Form_Cambiar_Clave" action="<?php echo base_url(); ?>Usuarios/operaciones_usuario" method="POST">
  	 <div class="form-group">
          <label for="ClaveUsuario" class="col-lg-2 control-label">Password Anterior</label>
              <div class="col-lg-4">
                   <input type="password" class="form-control mitooltip" title="Clave anterior" name ="ClaveUsuario" id="ClaveUsuario" placeholder="Password Anterior">
              </div>
      </div>
      <div class="form-group">
          <label for="ClaveUsuario" class="col-lg-2 control-label">Nueva Password</label>
              <div class="col-lg-4">
                   <input type="password" class="form-control mitooltip" title="Clave nueva" name ="NuevaClaveUsuario" id="NuevaClaveUsuario" placeholder="Nueva Password">
              </div>
      </div>
      <div class="form-group">
          <label for="ClaveUsuario" class="col-lg-2 control-label">Repetir Password</label>
              <div class="col-lg-4">
                   <input type="password" class="form-control mitooltip" title="Repetición clave nueva" name ="RepetirClaveUsuario" id="RepetirClaveUsuario" placeholder="Repetir Password">
              </div>
      </div>
      <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
          <input class="btn btn-sm btn-primary" type="submit" name="submit_Cambiar_Clave" value="Aceptar" id="submit"/>
            <?php   if(isset($cambia))
                    {
                        if ($cambia == 0)
                        {
                            echo '<a class="btn btn-sm btn-primary mitooltip" title="Salir sin salvar" href="'.base_url().'Home/">Volver</a>';
                        }
                    }
                    else
                    {
                          echo '<a class="btn btn-sm btn-primary mitooltip" title="Salir sin salvar" href="'.base_url().'Home/">Volver</a>';
                    }
            ?>
        </div>
      </div>
  </form>
</div>
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
