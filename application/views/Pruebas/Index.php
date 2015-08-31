<div class="container">
  <div class="row">
    <div class="row">
      <div class="col-sm-12">
      <form class="form-horizontal" role="form" name="Form_Upload" id="Form_Upload"
            action="<?php echo base_url(); ?>welcome/do_upload"
            method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="Archivo" class="col-lg-2 control-label">Archivo:</label>
              <div class="col-sm-4">
                <input class="btn btn-sm btn-primary" type="file" name="userfile" id="userfile" size="20" />
              </div>
              <div class="col-sm-2">
                <input class="btn btn-sm btn-primary" name="uploadDoc" id="uploadDoc" type="submit" value="upload" />
                <i class="fa fa-refresh fa-lg fa-spin think"></i>
              </div>
            </div>
        </form>
        <br/>
        <form class="form-horizontal bloq1" role="form" name="Form_Process" id="Form_Process"
              action="<?php echo base_url(); ?>welcome/procesar"
              method="POST" enctype="multipart/form-data">
            <div class="form-group">
            </div>
            <div class="form-group">
              <label for="FormatoEntrada" class="col-lg-2 control-label">Formato de Entrada:</label>
              <div class="col-sm-4">
                <select class="input-sm form-control bloq1" name="Tipo">
                  <option value="">Seleccione el formato de entrada</option>
                  <option value="txt">Archivo plano</option>';
                  <option value="xls">Archivo Excel</option>';
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="SeparadorE" class="col-lg-2 control-label sep">Separador:</label>
              <div class="col-sm-4">
                <select class="input-sm form-control sep" name="SeparadorE">
                  <option value="">Seleccione el separador de valores</option>
                  <option value="|">Barra vertical</option>';
                  <option value=",">Coma</option>';
                  <option value=";">Punto y Coma</option>';
                  <option value="$">Signo Pesos</option>';
                </select>
              </div>
            </div>
            <br/>
            <div class="form-group">
              <label for="FormatoSalida" class="col-lg-2 control-label">Formato de Salida:</label>
              <div class="col-sm-4">
                <select class="input-sm form-control bloq1" name="TipoS">
                  <option value="">Seleccione el formato de salida</option>
                  <option value="csv">Archivo CSV</option>';
                  <option value="txt">Archivo txt</option>';
                  <option value="xlsx">Archivo Excel</option>';
                </select>
              </div>
            </div>
            <br>
      </form>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
    </div>
  </div>
</div>
