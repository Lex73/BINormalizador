<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <?php if(isset($mens))
          {
            echo $mens;
            echo 'OK';
          }
      ?>
   </div>
    <div class="row">
      <div class="col-sm-12">
      <form class="form-horizontal" role="form" name="Form_Agregar_Usuarios"
            action="<?php echo base_url(); ?>welcome/do_upload"
            method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="Archivo" class="col-lg-2 control-label">Archivo:</label>
            <div class="col-sm-4">
              <input class="btn btn-sm btn-primary" type="file" name="userfile" size="20" />
            </div>
        </div>
          <br/>
            <div class="form-group">
              <label for="FormatoEntrada" class="col-lg-2 control-label">Formato de Entrada:</label>
              <div class="col-sm-4">
                <select class="input-sm form-control" name="Tipo">
                  <option value="">Seleccione el formato de entrada</option>
                  <option value="txt">Archivo plano</option>';
                  <option value="xls">Archivo Excel</option>';
                </select>
              </div>
            </div>
            <br/>
            <div class="form-group">
              <label for="FormatoSalida" class="col-lg-2 control-label">Formato de Salida:</label>
              <div class="col-sm-4">
                <select class="input-sm form-control" name="TipoS">
                  <option value="">Seleccione el formato de salida</option>
                  <option value="csv">Archivo CSV</option>';
                  <option value="txt">Archivo txt</option>';
                  <option value="xls">Archivo Excel</option>';
                </select>
              </div>
            </div>
            <br>
            <div class="form-group">
              <div class="col-lg-offset-2 col-lg-10">
                <input class="btn btn-sm btn-primary" type="submit" value="upload" />
              </div>
            </div>
            <br>
            <div class="form-group">
              <label for="bajar" class="col-lg-2 control-label">Bajar Archivo</label>
              <div class="col-sm-4">
                <input type="radio" name="bajar" id="bajar" value="medium" />
              </div>
            </div>
      </form>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
    </div>
  </div>
</div>
