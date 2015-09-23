<div class="container">
<div class="row">
  <div class="col-xs-8">
            <div class="alert alert-success">
                <i class="fa fa-file fa-fw fa-2x"></i>
                <?php
                  //if(isset($registro))
                  //{
                      foreach ($registro as $row)
                      {
                          echo 'Viendo: '.$row->IDPro.'-'.$row->NOMOriginal.' Tipo MIME: '.$row->Tipo;
                      }
                  //}
                  //else
                  //{
                    //echo 'Agregar nuevo cliente';
                  //}
                ?>
            </div>
        </div>
</div>
<div class="row">
  <form class="form-horizontal" role="form" name="Download" id="Download"
        action='<?php echo base_url().'Procesos/do_download/'.$row->Archivo.'/'.$row->Tipo ?>'
        method="POST" enctype="multipart/form-data">
    <?php
        if(isset($registro))
        {
            foreach ($registro as $row)
            {
                echo '<div class="form-group">';
                echo '<label for="IDPro" class="col-lg-2 control-label">ID Proceso</label>';
                echo '<div class="col-lg-4">';
                echo '<input type="text" class="form-control" name ="IDPro" id="IDPro"';
                echo ' value="'.$row->IDPro.'" readonly';
            }
            echo '>';
            echo '</div>';
            echo '</div>';
        }
    ?>
      <div class="form-group">
      <label for="NombreUsuario" class="col-lg-2 control-label">Archivo</label>
      <div class="col-lg-4">
        <input type="text" class="form-control" name ="Archivo" id="Archivo"
        <?php
            //if(isset($registro))
            //{
                foreach ($registro as $row)
                {
                  echo ' value="'.$row->Archivo.'" readonly';
                }
            //}
            //else
            //{
                //echo ' value="'.@set_value('NombreCliente').'" placeholder="Nombre Cliente"';
            //}
        ?>
        >
        </div><!-- col-lg-4 -->
    </div>
    <div class="form-group">
    <label for="NombreUsuario" class="col-lg-2 control-label">Nombre Original</label>
    <div class="col-lg-4">
      <input type="text" class="form-control" name ="NOMOriginal" id="NOMOriginal"
      <?php
          //if(isset($registro))
          //{
              foreach ($registro as $row)
              {
                echo ' value="'.$row->NOMOriginal.'" readonly';
              }
          //}
          //else
          //{
              //echo ' value="'.@set_value('NombreCliente').'" placeholder="Nombre Cliente"';
          //}
      ?>
      >
    </div>
  </div>
  <div class="form-group">
  <label for="NombreUsuario" class="col-lg-2 control-label">Fecha de Creacion</label>
  <div class="col-lg-4">
    <input type="text" class="form-control" name ="FECCreacion" id="FECCreacion"
    <?php
        //if(isset($registro))
        //{
            foreach ($registro as $row)
            {
              echo ' value="'.$row->FECCreacion.'" readonly';
            }
        //}
        //else
        //{
            //echo ' value="'.@set_value('NombreCliente').'" placeholder="Nombre Cliente"';
        //}
    ?>
    >
  </div>
</div>
<div class="form-group">
<label for="NombreUsuario" class="col-lg-2 control-label">Ubicacion</label>
<div class="col-lg-4">
  <input type="text" class="form-control" name ="Ubicacion" id="Ubicacion"
  <?php
      //if(isset($registro))
      //{
          foreach ($registro as $row)
          {
            echo ' value="'.$row->Ubicacion.'" readonly';
          }
      //}
      //else
      //{
          //echo ' value="'.@set_value('NombreCliente').'" placeholder="Nombre Cliente"';
      //}
  ?>
  >
</div>
</div>
    <div class="form-group">
      <div class="col-lg-offset-2 col-lg-10">
        <input class="btn btn-sm btn-primary mitooltip" title="Descargar el archivo" name="downloadDoc" id="downloadDoc" type="submit" value="Download"/>
       <!-- <input class="btn btn-lg btn-primary" type="submit" id="submit"
         <?php
            // if(!isset($clientes))
            // {
            //     echo 'name="submit_Agregar_Cliente"';
            // }
            // else
            // {
            //     echo 'name="submit_Modificar_Cliente"';
            // }
          ?>
        value="Aceptar"/>-->
        <a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>Registros/">Volver</a>
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
