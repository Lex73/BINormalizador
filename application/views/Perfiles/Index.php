<div class="container">

	<div class="row">
        <div class="col-xs-8">
            <div class="alert alert-success">
                <i class="fa fa-graduation-cap fa-fw fa-2x"></i> Perfiles
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
                    echo '<div> <a class="btn btn-sn btn-info mitooltip" title="Agregar Perfil" href="'.base_url().'Perfiles/agregar"><i class="fa fa-plus fa-fw"></i></a></div>';
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
                <th><os-p>ID Perfil</os-p></th>
                <th><os-p>Nombre de perfil</os-p></th>
                <?php
                if($modificar == true)
                {
                    echo '<th><os-p>Acción</os-p></th>';
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
		              echo '<td><os-p>'.$row->IDPerfil.'</os-p></td>';
		              echo '<td><os-p>'.$row->NOMBPerfil.'</os-p></td>';
                      if($modificar == true)
                      {
                          echo '<td>
                                <os-p></os-p>
                                <a class="btn btn-xs btn-success mitooltip" title="Modificar este Perfil" href="'.base_url().'perfiles/modificar/'.$row->IDPerfil.'"><i class="fa fa-pencil-square-o"></i></a>
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
