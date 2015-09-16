<div class="container">
  <br>
  <br>
<div class="row">
  <div class="col-xs-12">
    <form class="form-horizontal" role="form" name="Form_Cambiar_Clave" action="<?php echo base_url(); ?>usuarios/operaciones_usuario" method="POST">
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
          <input class="btn btn-lg btn-primary" type="submit" name="submit_Cambiar_Clave" value="Aceptar" id="submit"/>
          <a class="btn btn-lg btn-primary mitooltip" title="Salir sin salvar" href="<?php echo base_url(); ?>home/">Volver</a>
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
