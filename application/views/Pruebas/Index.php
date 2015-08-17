<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <!--<?php
    if(!isset($upload_data))
      {
        foreach($upload_data as $value)
        {
          $dato = $value;
        }
        echo '<form class="" action="<?php echo base_url(); ?>welcome/procesar" method="post">';
        echo '<label for="">Archivo: </label>';
        echo '<input type="text" name="archivo" value="'.$dato .'">';
        echo '<input type="submit" name="submit" value="Procesar">';
        echo '</form>';
      }
    ?>-->

    <?=$error;?>
    <?=form_open_multipart('welcome/do_upload'); ?>
      <input type="file" name="userfile" size="20" />
      <br /><br />
      <input type="submit" value="upload" />
    </form>

  </body>
</html>
