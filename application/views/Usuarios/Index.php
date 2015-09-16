<div class="container">
	<div class="row">
        <div class="col-xs-8">
            <div class="alert alert-success">
							  <i class="fa fa-users fa-fw fa-2x"></i> Usuarios del sistema
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
                    echo '<div> <a class="btn btn-sn btn-info mitooltip" title="Agregar Usuario" href="'.base_url().'Usuarios/agregar"><i class="fa fa-plus fa-fw"></i></a></div>';
                }
            ?>
        </div>
    </div><!--row-->
    <div class="row">
        <div class="col-xs-12">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>ID Usuario</os-p></th>
                <th><os-p>Nombre de usuario</os-p></th>
                <th><os-p>Perfil</os-p></th>
                <?php
                if($modificar == true)
                {
                    echo '<th"><os-p>Acción</os-p></th>';
                }
                ?>
              </tr>
            </thead>
            <tbody>
            	<?php
            		$i = 1;
					foreach ($query as $row)
					{
		              echo '<tr>';
		              echo '<td>'.$i++.'</td>';
		              echo '<td><os-p>'.$row->IDUsuarios.'</os-p></td>';
		              echo '<td><os-p>'.$row->NOMBUsuario.'</os-p></td>';
		              echo '<td><os-p>'.$row->NOMBPerfil.'</os-p></td>';
                      if($modificar == true)
                      {
                          echo '<td>
                                <os-p></os-p>
                                <a class="btn btn-xs btn-success mitooltip" title="Modificar este Usuario" href="'.base_url().'Usuarios/modificar/'.$row->IDUsuarios.'"><i class="fa fa-pencil-square-o"></i></a>
                                </td>';
                      }
		              echo '</tr>';
              		}
				?>
            </tbody>
          </table>
    	</div>
	</div><!--row-->
</div> <!-- /container -->
