<?php
  $ruta = './assets/documents/upload/';
  $mensaje = 'nada';

  foreach ($_FILES as $key)
  {
      if ($key['error'] == UPLOAD_ERR_OK)
      {
        $NombreOriginal = $key['name'];
        $temporal = $key['tmp_name'];
        $Destino = $ruta.$NombreOriginal;

        move_uploaded_file($temporal,$Destino);
      }

      if ($key['error'] == '')
      {
        $mensaje = 'OK';
      }

      if ($key['error'] != '')
      {
        $mensaje = 'KO';
      }
  }

  echo $mensaje;

 ?>
