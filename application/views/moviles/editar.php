
<div class="col-md-12">
<div class="box box-primary">
  	<div class="box-header with-border">
              <h3 class="box-title">Modificar un movil del sistema</h3>
    </div>
    <form class="form-horizontal" role="form" action='<?= $this->config->base_url(); ?>moviles/Modificar' method="POST">
        <div class="form-group">
        <label for="Licencia" class="col-lg-3 control-label">Simbologia</label>
        <div class="col-lg-6">
          <input type="text" class="form-control" name="simb" id="simb">
        </div>
      </div>
     <div class="form-group">
        <label for="patente" class="col-lg-3 control-label">Patente</label>
        <div class="col-lg-6">
          <input type="text" class="form-control" name="patente" value="<?= $remis->PATENTE; ?>" id="patente" >
        </div>
      </div> 
      <div class="form-group">
        <label for="Licencia" class="col-lg-3 control-label">Licencia</label>
        <div class="col-lg-6">
          <input type="text" class="form-control" value="<?= $remis->LICENCIA; ?>" name="licencia" id="Licencia">
        </div>
      </div>

      <div class="form-group">
        <label for="Licencia" class="col-lg-3 control-label">Marca</label>
        <div class="col-lg-6">
         <select name="marca" onchange="cambiar($(this).val());" class="form-control" id="marca">
		<option value="-1">Seleccione una marca</option>
			<option value="Fiat"    <?php if($remis->MARCA=="Fiat") echo "selected";?>>Fiat</option>
			<option value="VW"	    <?php if($remis->MARCA=="VW") echo "selected";?>>VW</option>
			<option value="Ford"    <?php if($remis->MARCA=="Ford") echo "selected";?>>Ford</option>
			<option value="Peugeot" <?php if($remis->MARCA=="Peugeot") echo "selected";?>>Peugeot</option>
			<option value="Toyota"  <?php if($remis->MARCA=="Toyota") echo "selected";?>>Toyota</option>
			<option value="Renault" <?php if($remis->MARCA=="Renault") echo "selected";?>>Renault</option>
			<option value="Chevrolet" <?php if($remis->MARCA=="Chevrolet") echo "selected";?>> Chevrolet</option>
			<option value="Citroën" <?php if($remis->MARCA=="Citroën") echo "selected";?>>Citroën</option>
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
		 	<option value="2000" <?php if($remis->ANIO=="2000") echo "selected";?>>2000</option>
			<option value="2001" <?php if($remis->ANIO=="2001") echo "selected";?>>2001</option>
			<option value="2002" <?php if($remis->ANIO=="2002") echo "selected";?> >2002</option>
			<option value="2003" <?php if($remis->ANIO=="2003") echo "selected";?>>2003</option>
			<option value="2004" <?php if($remis->ANIO=="2004") echo "selected";?>>2004</option>
			<option value="2005" <?php if($remis->ANIO=="2005") echo "selected";?>>2005</option>
			<option value="2006" <?php if($remis->ANIO=="2006") echo "selected";?>>2006</option>
			<option value="2007" <?php if($remis->ANIO=="2007") echo "selected";?>>2007</option>
			<option value="2008" <?php if($remis->ANIO=="2008") echo "selected";?>>2008</option>	
			<option value="2009" <?php if($remis->ANIO=="2009") echo "selected";?>>2009</option>
			<option value="2010" <?php if($remis->ANIO=="2010") echo "selected";?>>2010</option>
			<option value="2011" <?php if($remis->ANIO=="2011") echo "selected";?>>2011</option>	
			<option value="2012" <?php if($remis->ANIO=="2012") echo "selected";?>>2012</option>
			<option value="2013" <?php if($remis->ANIO=="2013") echo "selected";?>>2013</option>
			<option value="2014" <?php if($remis->ANIO=="2014") echo "selected";?>>2014</option>
			<option value="2015" <?php if($remis->ANIO=="2015") echo "selected";?>>2015</option>
			<option value="2016" <?php if($remis->ANIO=="2016") echo "selected";?>>2016</option>	
			<option value="2017" <?php if($remis->ANIO=="2017") echo "selected";?>>2017</option>	
		  </select>
        </div>
      </div>

     

      <div class="form-group">
        <label for="Anio" class="col-lg-3 control-label">Color</label>
        <div class="col-lg-6">
  		<select name="color" class="form-control">
		  <option value="-1">Seleccione un color</option>
		  <option value="Negro"  <?php if($remis->COLOR=="Negro") echo "selected";?>>Negro</option>
		  <option value="Blanco" <?php if($remis->COLOR=="Blanco") echo "selected";?>>Blanco</option>
		  <option value="Gris"   <?php if($remis->COLOR=="Gris") echo "selected";?>>Gris</option>
		  <option value="Rojo"   <?php if($remis->COLOR=="Rojo") echo "selected";?>>Rojo</option>
		  <option value="Verde"  <?php if($remis->COLOR=="Verde") echo "selected";?>>Verde</option>
		  <option value="Azul"   <?php if($remis->COLOR=="Azul") echo "selected";?>>Azul</option>	
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
                  <input type="text" name="vrevesa" value="<?= date("d/m/Y", strtotime($remis->VENCEREVESA)); ?>" class="form-control pull-right" id="vrevesa">
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
                  <input type="text" value="<?= date("d/m/Y", strtotime($remis->VENCEOBLEA)); ?>" name="vgnc" class="form-control pull-right" id="vgnc">
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
                  <input type="text" value="<?= date("d/m/Y", strtotime($remis->VENCESEGURO)); ?>" name="vseguro" class="form-control pull-right" id="vseguro">
                </div>
        </div>
      </div>
	<div class="box-footer with-border">
              

     <div class="form-group">
        <div class="col-lg-offset-3 col-lg-10">
          <input type="hidden" name="id" value="<?= $remis->ID_REMIS; ?>"/>
          <button type="submit" class="btn btn-success">Aceptar</button> <a href="<?= base_url();?>" class="btn btn-primary">Cancelar</a>
        </div>
      </div>
    </form>
    </div>
 </div>
<?= "<script>cambiar('".$remis->MARCA."');
$('#modelo').val('".$remis->MODELO."');
</script>"; ?>

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