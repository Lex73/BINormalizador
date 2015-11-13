<div class="container">
<div class="row">
  <div class="col-xs-8">
            <div class="alert alert-success">
                <i class="fa fa-server fa-fw fa-2x"></i>
                <?php
                  if(isset($campo))
                  {
                      foreach ($campo as $row)
                      {
                          echo 'Modificando el campo:'.$row->IDCampo.' : '.$row->NOMCampo.' de la tabla: '.$row->IDTabla;
                      }
                      foreach ($tablas as $row)
                      {
                          echo ' : '.$row->NOMTabla;
                      }
                  }
                  else
                  {
                    foreach ($tablas as $row)
                    {
                        echo 'Agregar nuevo campo para la tabla:'.$row->IDTabla.' : '.$row->NOMTabla;
                    }
                  }
                ?>
            </div>
        </div>
</div>
<div class="row">
<form class="form-horizontal" role="form" name="Form_Agregar_Campos" action="<?php echo base_url(); ?>tablas/operaciones_tablas" method="POST">
      <?php
          foreach ($tablas as $row)
          {
              echo '<div class="form-group">';
              echo '<label for="IDTabla" class="col-lg-2 control-label">ID Tabla</label>';
              echo '<div class="col-lg-2">';
              echo '<input type="text" class="form-control" name ="IDTabla" id="IDTabla"';
              echo ' value="'.$row->IDTabla.'" readonly';
          }
            echo '>';
            echo '</div>';
            echo '</div>';
      ?>
      <?php
          if(isset($campo))
          {
              foreach ($campo as $row)
              {
                  echo '<div class="form-group">';
                  echo '<label for="IDCampo" class="col-lg-2 control-label">ID Campo</label>';
                  echo '<div class="col-lg-2">';
                  echo '<input type="text" class="form-control" name ="IDCampo" id="IDCampo"';
                  echo ' value="'.$row->IDCampo.'" readonly>';
                  echo '</div>';
                  echo '</div>';
              }
          }
    ?>
    <div class="form-group">
      <label for="NOMCampo" class="col-lg-2 control-label">Nombre del Campo</label>
      <div class="col-lg-6">
        <input type="text" class="form-control" name ="NOMCampo" id="NOMCampo"
        <?php
            if(isset($campo))
            {
                foreach ($campo as $row)
                {
                  echo ' value="'.$row->NOMCampo.'" readonly';
                }
            }
            else
            {
                echo ' value="'.@set_value('Nombre del Campo').'" placeholder="Nombre del Campo"';
            }
        ?>
        >
      </div>
    </div>
    <div class="form-group">
      <label for="TYPCampo" class="col-lg-2 control-label">Tipo de dato</label>
      <div class="col-lg-2">
              <select class="input-large form-control" name="TYPCampo" id="TYPCampo">
                <?php
                      if(!isset($campo))
                      {
                        echo '<option value="">Seleccione un tipo</option>';
                        echo '<option value="Fecha">Fecha</option>';
                        echo '<option value="Cadena">Cadena</option>';
                        echo '<option value="Entero">Entero</option>';
                        echo '<option value="Flotante">Flotante</option>';
                      }
                      else
                      {
                        foreach ($campo as $row)
                        {
                            if( $row->TYPCampo == 'Fecha')
                            {
                              echo '<option selected value="Fecha">Fecha</option>';
                              echo '<option value="Cadena">Cadena</option>';
                              echo '<option value="Entero">Entero</option>';
                              echo '<option value="Flotante">Flotante</option>';
                            }
                            else if ( $row->TYPCampo == 'Cadena')
                            {
                              echo '<option selected value="Cadena">Cadena</option>';
                              echo '<option value="Fecha">Fecha</option>';
                              echo '<option value="Entero">Entero</option>';
                              echo '<option value="Flotante">Flotante</option>';
                            }
                            else if ( $row->TYPCampo == 'Entero')
                            {
                              echo '<option selected value="Entero">Entero</option>';
                              echo '<option value="Cadena">Cadena</option>';
                              echo '<option value="Entero">Entero</option>';
                              echo '<option value="Flotante">Flotante</option>';
                            }
                            else if ( $row->TYPCampo == 'Flotante')
                            {
                              echo '<option selected value="Entero">Entero</option>';
                              echo '<option value="Cadena">Cadena</option>';
                              echo '<option value="Entero">Entero</option>';
                              echo '<option value="Flotante">Flotante</option>';
                            }
                        }
                      }
                ?>
              </select>
      </div>
    </div>
    <div class="form-group">
      <label for="LONGCampo" class="col-lg-2 control-label">Longitud de Campo</label>
      <div class="col-lg-2">
        <input type="text" class="form-control" name ="LONGCampo" id="LONGCampo"
        <?php
            if(isset($campo))
            {
                foreach ($campo as $row)
                {
                  echo ' value="'.$row->LONGCampo.'"';
                }
            }
            else
            {
                echo ' value="'.@set_value('Longitud de campo').'" placeholder="Longitud de campo"';
            }
        ?>
        >
      </div>
    </div>
    <div class="form-group">
      <label for="ORDER" class="col-lg-2 control-label">Orden</label>
      <div class="col-lg-2">
        <input type="text" class="form-control" name ="ORDER" id="ORDER"
        <?php
            if(isset($campo))
            {
                foreach ($campo as $row)
                {
                  echo ' value="'.$row->ORDER.'" readonly';
                }
            }
            else
            {
                echo ' value="'.@set_value('Ingrese el orden').'" placeholder="Orden"';
            }
        ?>
        >
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-offset-2 col-lg-10">
        <input class="btn btn-sm btn-primary" type="submit" id="submit"
         <?php
            if(!isset($campo))
            {
                echo 'name="submit_Agregar_Campo"';
            }
            else
            {
                echo 'name="submit_Modificar_Campo"';
            }
         ?>
         value="Aceptar"/>
         <?php
            foreach ($tablas as $row)
            {
                echo '<a class="btn btn-sm btn-primary" href="'.base_url().'tablas/modificar/'.$row->IDTabla.'">Volver</a>';
            }
         ?>
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
