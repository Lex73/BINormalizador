<div class="container">

	<div class="row">
        <div class="col-xs-8">
            <div class="alert alert-success">
							<i class="fa fa-btc fa-fw fa-2x"></i> Clientes
            </div>
        </div>
        <div class="col-xs-2">
            <p class="text-success">
                <?php
                        echo $mensaje;
                ?>
            </p>
        </div>
        <div class="col-xs-1"></div>
        <div class="col-xs-1">
            <?php
                if($agregar == true)
                {
                    echo '<div> <a class="btn btn-sn btn-info mitooltip" title="Agregar Cliente" href="'.base_url().'Clientes/agregar"><i class="fa fa-plus fa-fw"></i></a></div>';
                }
            ?>
        </div>
    </div><!--row-->

    <div class="row">
        <div class="col-xs-12">
          <table class="table">
            <thead>
              <tr>
                <th><os-p>ID Cliente</os-p></th>
                <th><os-p>Nombre de cliente</os-p></th>
                <?php
                if($modificar == true)
                {
                    echo '<th><os>Acción</os-p></th>';
                }
                ?>
              </tr>
            </thead>
            <tbody>
            	<?php
					foreach ($query as $row)
					{
		              echo '<tr>';
		              echo '<td><os-p>'.$row->IDCliente.'</os-p></td>';
		              echo '<td><os-p>'.$row->DESCCliente.'</os-p></td>';
                      if($modificar == true)
                      {
                          echo '<td>
                                <os-p></os-p>
                                <a class="btn btn-xs btn-success  mitooltip" title="Modificar este Cliente" href="'.base_url().'Clientes/modificar/'.$row->IDCliente.'"><i class="fa fa-pencil-square-o"></i></a>
                                </td>';
                      }
		              echo '</tr>';
              		}
				?>
            </tbody>
          </table>
    	</div>
	</div>
</div> <!-- /container -->
