<div class="col-md-12">
<div class="box box-primary">
  	<div class="box-header with-border">
              <h3 class="box-title">Insertar un nuevo chofer al sistema</h3>
    </div>
    <form class="form-horizontal" role="form" action='<?= $this->config->base_url(); ?>choferes/Guardar' method="POST">
     <div class="form-group">
        <label for="Nombre" class="col-lg-3 control-label">Nombre</label>
        <div class="col-lg-6">
          <input type="text" class="form-control" name="nombre" id="Nombre" >
        </div>
      </div> 
      <div class="form-group">
        <label for="DNI" class="col-lg-3 control-label">DNI</label>
        <div class="col-lg-6">
          <input type="text" class="form-control" name="dni" id="DNI">
        </div>
      </div>


	<div class="box-footer with-border">
              

     <div class="form-group">
        <div class="col-lg-offset-3 col-lg-10">
          <button type="submit" class="btn btn-success">Aceptar</button> <a href="<?= base_url();?>index.php/home" class="btn btn-primary">Cancelar</a>
        </div>
      </div>
    </form>
    </div>
 </div>
