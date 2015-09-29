<div class="container">
  <div class="row">
    <div class="col-xs-8">
      <div class="alert alert-success">
        <i class="fa fa-credit-card fa-fw fa-2x"></i>
        <?php
          if(isset($user))
          {
            foreach ($user as $row)
            {
              echo 'Modificar: '.$row->IDCuenta.'-'.$row->DESCCuenta;
            }
          }
          else
          {
            echo 'Agregar nueva cuenta';
          }
        ?>
      </div>
    </div>
  </div>
<div class="row">
  <form class="form-horizontal" role="form" name="Form_Agregar_Cuenta" action="<?php echo base_url(); ?>Usuarios/operaciones_cuenta" method="POST" enctype="multipart/form-data">
        <?php
            if(isset($user))
            {
                foreach ($user as $row)
                {
                    echo '<div class="form-group">';
                    echo '<label for="IDCuenta" class="col-lg-2 control-label">ID Cuenta</label>';
                    echo '<div class="col-lg-4">';
                    echo '<input type="text" class="form-control" name ="IDCuenta" id="IDCuenta"';
                    echo ' value="'.$row->IDCuenta.'" readonly';
                }
                echo '>';
                echo '</div>';
                echo '</div>';
            }
        ?>
      <div class="form-group">
      <label for="DESCCuenta" class="col-lg-2 control-label">Descripción de cuenta</label>
      <div class="col-lg-6">
        <input type="text" class="form-control" name ="DESCCuenta" id="DESCCuenta"
        <?php
            if(isset($user))
            {
                foreach ($user as $row)
                {
                  echo ' value="'.$row->DESCCuenta.'"';
                }
            }
            else
            {
                echo ' value="'.@set_value('DESCCuenta').'" placeholder="Descripción Cuenta"';
            }
        ?>
        >
      </div>
    </div>
    <div class="form-group">
      <label for="IDCliente" class="col-lg-2 control-label">Cliente</label>
      <div class="col-lg-4">
              <select class="input-large form-control" name="IDCliente">
                <?php
                  if(!isset($user))
                  {
                    echo '<option value="">Seleccione un Cliente</option>';
                    foreach ($query as $row)
                    {
                      echo '<option value="'.$row->IDCliente.'">'.$row->DESCCliente.'</option>';
                    }
                  }
                  else
                  {
                    foreach ($query as $row)
                    {
                      foreach ($user as $rowAux)
                      {
                        if($rowAux->IDCliente == $row->IDCliente)
                        {
                          echo '<option selected value="'.$row->IDCliente.'">'.$row->DESCCliente.'</option>';
                        }
                        else
                        {
                          echo '<option value="'.$row->IDCliente.'">'.$row->DESCCliente.'</option>';
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
            if(!isset($user))
            {
                echo 'name="submit_Agregar_Cuentas"';
            }
            else
            {
                echo 'name="submit_Modificar_Cuentas"';
            }
          ?>
        value="Aceptar"/>
         <a class="btn btn-sm btn-primary mitooltip" title="Salir sin salvar" href="<?php echo base_url(); ?>Cuentas/">Volver</a>
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
