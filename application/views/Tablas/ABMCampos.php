<div class="container">
<div class="row">
  <div class="col-xs-8">
            <div class="alert alert-success">
                <i class="fa fa-bookmark-o fa-fw fa-2x"></i>
                <?php
                  if(isset($campos))
                  {
                      foreach ($campos as $row)
                      {
                          echo 'Campos de la tabla: '.$row->IDTabla;
                      }
                  }
                  else
                  {
                    echo 'Tabla sin campos';
                  }
                ?>
            </div>
        </div>
</div>
<div class="row">
  <!-- <form class="form-horizontal" role="form" name="Form_Agregar_Tablas" action="<?php echo base_url(); ?>tablas/operaciones_tablas" method="POST"> -->
      <?php
          if(isset($tablas))
          {
               foreach ($tablas as $row)
               {
                 echo '<div class="form-group">';
                 echo '<label for="IDTabla" class="col-lg-2 control-label">ID Tabla</label>';
                 echo '<div class="col-lg-4">';
                 echo '<input type="text" class="form-control" name ="IDTabla" id="IDTabla"';
                 echo ' value="'.$row->IDTabla.'" readonly';
               }
               echo '>';
               echo '</div>';
               echo '</div>';
          }
      ?>
      <div class="form-group">
        <label for="NombreTabla" class="col-lg-2 control-label">Nombre Tabla</label>
        <div class="col-lg-6">
          <input type="text" class="form-control" name ="NombreTabla" id="NombreTabla"
          <?php
              if(isset($tablas))
              {
                  foreach ($tablas as $row)
                  {
                    echo ' value="'.$row->NOMTabla.'"';
                  }
              }
              else
              {
                  echo ' value="'.@set_value('NombreTabla').'" placeholder="Nombre Tabla"';
              }
          ?>
          >
      </div>
    </div>
    <div class="form-group">
      <label for="IDCuenta" class="col-lg-2 control-label">Cuenta</label>
      <div class="col-lg-4">
              <select class="input-large form-control" name="IDCuenta" id="IDCuenta">
                <?php
                      if(!isset($tablas))
                      {
                        echo '<option value="">Seleccione una cuenta</option>';
                        foreach ($cuentas as $row)
                        {
                          echo '<option value="'.$row->IDCuenta.'">'.$row->DESCCuenta.'</option>';
                        }
                      }
                      else
                      {
                        foreach ($cuentas as $row)
                        {
                          foreach ($tablas as $rowAux)
                          {
                            if($rowAux->IDCuenta == $row->IDCuenta)
                            {
                              echo '<option selected value="'.$row->IDCuenta.'">'.$row->DESCCuenta.'</option>';
                            }
                            else
                            {
                              echo '<option value="'.$row->IDCuenta.'">'.$row->DESCCuenta.'</option>';
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
       <input class="btn btn-sm btn-primary" type="submit" id="submit"
         <?php
            if(!isset($tablas))
            {
                echo 'name="submit_Agregar_Tablas"';
            }
            else
            {
                echo 'name="submit_Modificar_Tablas"';
            }
          ?>
        value="Aceptar"/>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>tablas/">Volver</a>
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
