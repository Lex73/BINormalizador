<div class="container">
  <div class="row">
       <label class="col-lg-12 control-label bloq0">Seleccione un archivo para subir:</label>
  </div>
  <div class="row">
    <div class="col-lg-2">
       <input class="btn btn-sm btn-primary control-label bloq0" type="file" id="archivo1" name="archivo1"/>
    </div>
    <div class="col-lg-2"></div>
    <div class="col-lg-2"></div>
    <div class="col-lg-2"></div>
    <div class="col-lg-2"></div>
    <div class="col-lg-2"></div>
  </div>
  <br>
  <div class="row">
      <div class="col-lg-2">
          <input class="btn btn-sm btn-primary control-label bloq0 mitooltip" title="Subir el archivo"  type="submit" value="Subir" id="enviar"/>
      </div>
      <div class="col-lg-2"></div>
      <div class="col-lg-2"></div>
      <div class="col-lg-2"></div>
      <div class="col-lg-2"></div>
      <div class="col-lg-2"></div>
  </div>
        <div class="row">
          <div class="col-lg-6">
              <label class="control-label bloq1">Archivo subido correctamente. Continue con el proceso:</label>
          </div>
          <div class="col-lg-2"></div>
          <div class="col-lg-2"></div>
          <div class="col-lg-2"></div>
        </div>
        <div class="row">
        <form class="form-horizontal bloq1" role="form" name="Form_Process" id="Form_Process"
              action="<?php echo base_url(); ?>Procesos/procesar"
              method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="Archivo" class="col-lg-2 control-label">Archivo:</label>
              <div class="col-lg-4">
                  <!-- <div id="mensaje"></div> -->
                  <input class="mitooltip" title="Archivo que se ha subido" id="mensaje" type="text" class="form-control" name ="Archivo">
              </div>
            </div>
            <div class="form-group">
              <label for="FormatoEntrada" class="col-lg-2 control-label">Formato de Entrada:</label>
              <div class="col-sm-4">
                <select class="input-sm form-control bloq1 mitooltip" title="Seleccione el formato de entrada"  name="Tipo" id="tipo">
                  <option value="">Seleccione el formato de entrada</option>
                  <option value="txt">Archivo plano</option>';
                  <option value="xls">Archivo Excel</option>';
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="SeparadorE" class="col-lg-2 control-label sep">Separador:</label>
              <div class="col-sm-4">
                <select class="input-sm form-control sep mitooltip" title="Seleccione el tipo de separador" name="SeparadorE">
                  <option value="">Seleccione el separador de valores</option>
                  <option value="|">Barra vertical</option>';
                  <option value=",">Coma</option>';
                  <option value=";">Punto y Coma</option>';
                  <option value="$">Signo Pesos</option>';
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="FormatoSalida" class="col-lg-2 control-label">Formato de Salida:</label>
              <div class="col-sm-4">
                <select class="input-sm form-control bloq1  mitooltip" title="Seleccione el formato de salida"  name="TipoS">
                  <option value="">Seleccione el formato de salida</option>
                  <option value="csv">Archivo CSV</option>';
                  <option value="txt">Archivo txt</option>';
                  <option value="xlsx">Archivo Excel</option>';
                </select>
              </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <input class="btn btn-sm btn-primary mitooltip" title="Procesar el archivo"  type="submit" id="submit" value="Aceptar" name="submit_Procesar"/>
                </div>
            </div>
      </form>
      </div>
  <div class="row">
    <div class="col-xs-12">
    </div>
  </div>
</div>
