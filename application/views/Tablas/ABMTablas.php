<div class="container">
<div class="row">
  <div class="col-xs-8">
            <div class="alert alert-success">
                <i class="fa fa-bookmark-o fa-fw fa-2x"></i>
                <?php
                  if(isset($tablas))
                  {
                      foreach ($tablas as $row)
                      {
                          echo 'Modificar: '.$row->IDTabla.'-'.$row->NOMTabla;
                      }
                  }
                  else
                  {
                    echo 'Agregar nueva tabla';
                  }
                ?>
            </div>
        </div>
</div>
<div class="row">
  <form class="form-horizontal" role="form" name="Form_Agregar_Tablas" action="<?php echo base_url(); ?>tablas/operaciones_tablas" method="POST">
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

  <div class="row">
    <div class="col-xs-2"></div>
      <div class="col-xs-4">
        <?php
          if(isset($tablas))
          {
              echo '<h4>Campos de la tabla</h4>';
          }
        ?>
      </div>
      <div class="col-xs-4">
        <?php
          if(isset($tablas))
          {
            foreach ($tablas as $row)
            {
              echo '<a class="btn btn-sm btn-info mitooltip" title="Agregar campos a esta Tabla" href="'.base_url().'tablas/agregarCampos/'.$row->IDTabla.'"><i class="fa fa-plus fa-fw"></i></a>';
            }
          }
          else
          {

          }
        ?>
      </div>
      <div class="col-xs-2"></div>
    <div class="col-xs-4"></div>
  </div><!--row-->
  <div class="row">
    <div class="col-xs-2"></div>
    <div class="col-xs-4">
      <ul class="list-group">
        <?php
          if(isset($campos))
          {
            echo '<table class="table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>#</th>';
            echo '<th>Orden</th>';
            echo '<th>Campo</th>';
            echo '<th>Tipo</th>';
            echo '<th>Acciones</th>';
            echo '</tr>';
            echo '</thead>';
            foreach ($campos as $rowAux)
            {
              echo '<tbody>';
              echo '<tr>';
              echo '<td>'.$rowAux->IDCampo.'</td>';
              echo '<td>'.$rowAux->ORDER.'</td>';
              echo '<td>'.$rowAux->NOMCampo.'</td>';
              echo '<td>'.$rowAux->TYPCampo.'</td>';
              echo '<td><a class="btn btn-xs btn-success mitooltip" title="Modificar este Campo" href="'.base_url().'tablas/modificarCampo/'.$rowAux->IDTabla.'/'.$rowAux->IDCampo.'"><i class="fa fa-pencil-square-o"></i></a></td>';
              echo '</tr>';
            }
              echo '</tbody>';
              echo '</table>';
          }
        ?>
      </ul>
    </div>
    <div class="col-xs-4"></div>
  </div><!--row-->

</div> <!-- /container -->
