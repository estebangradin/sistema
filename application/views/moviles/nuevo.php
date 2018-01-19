<div class="col-md-12">
<div class="box box-primary">
  	<div class="box-header with-border">
              <h3 class="box-title">Insertar un nuevo movil al sistema</h3>
    </div>
    <form class="form-horizontal" role="form" action='guardar' method="POST">
        <div class="form-group">
        <label for="Licencia" class="col-lg-3 control-label">Simbologia</label>
        <div class="col-lg-6">
          <input type="text" class="form-control" name="simb" id="simb">
        </div>
      </div>
     <div class="form-group">
        <label for="patente" class="col-lg-3 control-label">Patente</label>
        <div class="col-lg-6">
          <input type="text" class="form-control" name="patente" id="patente" >
        </div>
      </div> 
      <div class="form-group">
        <label for="Licencia" class="col-lg-3 control-label">Licencia</label>
        <div class="col-lg-6">
          <input type="text" class="form-control" name="licencia" id="Licencia">
        </div>
      </div>

      <div class="form-group">
        <label for="Licencia" class="col-lg-3 control-label">Marca</label>
        <div class="col-lg-6">
         <select name="marca" onchange="cambiar($(this).val());" class="form-control" id="marca">
		<option value="-1">Seleccione una marca</option>
							<option value="Fiat">Fiat</option>
							<option value="VW">VW</option>
							<option value="Ford">Ford</option>
							<option value="Peugeot">Peugeot</option>
							<option value="Toyota">Toyota</option>
							<option value="Renault">Renault</option>
							<option value="Chevrolet">Chevrolet</option>
							<option value="Citroën">Citroën</option>
		  </select>
        </div>
      </div>

      <div class="form-group">
        <label for="Modelo" class="col-lg-3 control-label">Modelo</label>
        <div class="col-lg-6">
          <select name="modelo" class="form-control" id="modelo">
		 	<option value="-1">Seleccione un modelo</option>
		  </select>
        </div>
      </div>

      <div class="form-group">
        <label for="Anio" class="col-lg-3 control-label">Año</label>
        <div class="col-lg-6">
          <select name="anio" class="form-control" id="anio">
		 	<option value="-1">Seleccione un año</option>
		 	<option value="2000">2000</option>
			<option value="2001">2001</option>
			<option value="2002">2002</option>
			<option value="2003">2003</option>
			<option value="2004">2004</option>
			<option value="2005">2005</option>
			<option value="2006">2006</option>
			<option value="2007">2007</option>
			<option value="2008">2008</option>		
			<option value="2009">2009</option>
			<option value="2010">2010</option>
			<option value="2011">2011</option>		
			<option value="2012">2012</option>
			<option value="2013">2013</option>
			<option value="2014">2014</option>
			<option value="2015">2015</option>
			<option value="2016">2016</option>									
			<option value="2017">2017</option>	
      <option value="2018">2018</option>  
		  </select>
        </div>
      </div>



      <div class="form-group">
        <label for="Anio" class="col-lg-3 control-label">Color</label>
        <div class="col-lg-6">
  		  <select name="color" class="form-control">
    			<option value="-1">Seleccione un color</option>
    			<option value="Negro">Negro</option>
    			<option value="Blanco">Blanco</option>
    			<option value="Gris">Gris</option>
    			<option value="Rojo">Rojo</option>
    			<option value="Verde">Verde</option>
    			<option value="Azul">Azul</option>	
	     	</select>
        </div>
      </div>


      <div class="form-group">
        <label for="vencimiento_revesa" class="col-lg-3 control-label">Vencimiento de revesa:</label>
        <div class="col-lg-6">
                 <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="vrevesa" class="form-control pull-right" id="vrevesa">
                </div>
        </div>
      </div>
       <div class="form-group">
        <label for="vencimiento_revesa" class="col-lg-3 control-label">Vencimiento de oblea de GNC:</label>
        <div class="col-lg-6">
                 <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="vgnc" class="form-control pull-right" id="vgnc">
                </div>
        </div>
      </div>
        <div class="form-group">
        <label for="vencimiento_revesa" class="col-lg-3 control-label">Vencimiento del seguro:</label>
        <div class="col-lg-6">
                 <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="vseguro" class="form-control pull-right" id="vseguro">
                </div>
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
<script>
    //Date picker
    $('#vrevesa').datepicker({
      autoclose: true
    });
    $('#vgnc').datepicker({
      autoclose: true
    });
    $('#vseguro').datepicker({
      autoclose: true
    });
</script>