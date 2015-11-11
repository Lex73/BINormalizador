<div class="container">

	<div class="row">
        <div class="col-xs-8">
            <div class="alert alert-success">
							<i class="fa fa-bookmark-o fa-fw fa-2x"></i> Tablas
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
                    echo '<div> <a class="btn btn-sn btn-info mitooltip" title="Agregar Tablas" href="'.base_url().'Tablas/agregar"><i class="fa fa-plus fa-fw"></i></a></div>';
                }
            ?>
        </div>
    </div><!--row-->

    <div class="row">
        <div class="col-xs-12">
          <table class="table">
            <thead>
              <tr>
                <th><os-p>ID Tabla</os-p></th>
                <th><os-p>Nombre tabla</os-p></th>
								<th><os-p>Cuenta</os-p></th>
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
		              echo '<td><os-p>'.$row->IDTabla.'</os-p></td>';
		              echo '<td><os-p>'.$row->NOMTabla.'</os-p></td>';
									echo '<td><os-p>'.$row->DESCCuenta.'</os-p></td>';
                      if($modificar == true)
                      {
                          echo '<td>
                                <os-p></os-p>
                                <a class="btn btn-xs btn-success  mitooltip" title="Modificar esta Tabla" href="'.base_url().'Tablas/modificar/'.$row->IDTabla.'"><i class="fa fa-pencil-square-o"></i></a>
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
