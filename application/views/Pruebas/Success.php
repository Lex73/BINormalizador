<!DOCTYPE html>
  <body>
  <div class="container">
    <div class="row">
        <div class="col-sm-12"> <?php echo $mens;?></div>
    </div>
    <br>
    <!--<div class="row">
        <div class="col-sm-12"> <?php echo base_url().'welcome/do_download/'.$archivo.'/'.$salida ?></div>
    </div>-->
    <div class="row">
      <div class="col-sm-12">
        <form class="form-horizontal" role="form" name="Download" id="Download"
              action='<?php echo base_url().'welcome/do_download/'.$archivo.'/'.$salida ?>'
              method="POST" enctype="multipart/form-data">
          <div class="form-group">
              <div class="col-sm-4">
                <input class="btn btn-sm btn-primary mitooltip" title="Descargar el archivo"  name="downloadDoc" id="downloadDoc" type="submit" value="Download" />
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
