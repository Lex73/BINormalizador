<div class="container">
<div class="row">
  <div class="col-xs-8">
            <div class="alert alert-success">
                <i class="fa fa-btc fa-fw fa-2x"></i>
                <?php
                  if(isset($clientes))
                  {
                      foreach ($clientes as $row)
                      {
                          echo 'Modificar: '.$row->IDCliente.'-'.$row->NombreCliente;
                      }
                  }
                  else
                  {
                    echo 'Agregar nuevo cliente';
                  }
                ?>
            </div>
        </div>
</div>
<div class="row">
  <form class="form-horizontal" role="form" name="Form_Agregar_Clientes" action="<?php echo base_url(); ?>clientes/operaciones_clientes" method="POST">
    <?php
        if(isset($clientes))
        {
            foreach ($clientes as $row)
            {
                echo '<div class="form-group">';
                echo '<label for="IDCliente" class="col-lg-2 control-label">ID Cliente</label>';
                echo '<div class="col-lg-4">';
                echo '<input type="text" class="form-control" name ="IDCliente" id="IDCliente"';
                echo ' value="'.$row->IDCliente.'" readonly';
            }
            echo '>';
            echo '</div>';
            echo '</div>';
        }
    ?>
      <div class="form-group">
      <label for="NombreUsuario" class="col-lg-2 control-label">Nombre</label>
      <div class="col-lg-6">
        <input type="text" class="form-control" name ="NombreCliente" id="NombreCliente"
        <?php
            if(isset($clientes))
            {
                foreach ($clientes as $row)
                {
                  echo ' value="'.$row->NombreCliente.'"';
                }
            }
            else
            {
                echo ' value="'.@set_value('NombreCliente').'" placeholder="Nombre Cliente"';
            }
        ?>
        >
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-offset-2 col-lg-10">
       <input class="btn btn-lg btn-primary" type="submit" id="submit"
         <?php
            if(!isset($clientes))
            {
                echo 'name="submit_Agregar_Cliente"';
            }
            else
            {
                echo 'name="submit_Modificar_Cliente"';
            }
          ?>
        value="Aceptar"/>
        <a class="btn btn-lg btn-primary" href="<?php echo base_url(); ?>clientes/">Volver</a>
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
