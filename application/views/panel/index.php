<?php
$rem = json_encode($remises);
$chars = array("[", "]");
//$rem = str_replace($chars, "", $rem);
?>
<script>
var auxloc = {}
var locations = new Array();
var marcadores = new Array();
var marker, i;
 var uluru ;
 var map;
   function setMarkerPosition(marker) {
                marker.setPosition(
                    new google.maps.LatLng(
                                    -24.783876, -65.422860)
                );
            }
            </script>
  <style>
       #map {
        height: 400px;
        margin-bottom:2%;
        width: 96%;
        margin-left: 2%;
       }
    </style>

<div class="col-xs-12">
          <div class="box box-primary">
              <div class="box-header with-border">
              </div>
 <div class="box-body table-responsive no-padding">
    <div id="map"></div>
    <script>
      function initMap() {

         uluru = {lat: <?= $this->session->LATITUD;?>, lng: <?= $this->session->LONGITUD; ?>};
         map = new google.maps.Map(document.getElementById('map'), {
          zoom:15,
          center: uluru
        });
        
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiJHZBjjqtyU3P4pFh48VDznp6d_-lrIE&callback=initMap">
    </script>

 </div>
 </div>
 </div>

<div class="col-xs-12">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Hoja de moviles</h3>
              </div>

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>Patente</th>
                  <th>Licencia</th>
            	  <th>Chofer</th>
                  <th>Estado</th>
                  <th>Dirección de origen</th>
                  <th>Dirección de destino</th>
                  <th>Acciones</th>
                </tr>
                <?php foreach($remises as $remis){

                	if ($remis->ESTADO <> -1){
                 echo ' <tr>
                		 <td>'.$remis->LICENCIA.'</td>
                        <td><span  data-toggle="tooltip" title="'.$remis->MARCA.' '.$remis->MODELO.' '.$remis->ANIO.' '.$remis->COLOR.'">'.$remis->PATENTE.'</span></td>';
                         switch($remis->ESTADO) {
                          case 0: 
               
                              echo '<td>'.$remis->NOMBRE.'</td><td><span class="label label-success">Libre</span></td><td></td><td></td>';
                              echo '<td><button class="btn btn-primary" onclick="ocupar(\''.$remis->PATENTE.'\', '.$remis->ID_REMIS.', '.$remis->ID_CHOFER.');">Ocupar</button><button style="margin-left:10px;" onclick="fueradeservicio(\''.$remis->PATENTE.'\', '.$remis->ID_REMIS.', '.$remis->ID_CHOFER.');" class="btn btn-primary">Fuera de servicio</button></td>';
                          break;
                          case 1: 
                              echo '<td>'.$remis->NOMBRE.'</td><td><span class="label label-danger">Ocupado</span></td><td>'.$remis->ORIGEN.'</td><td>'.$remis->DESTINO.'</td>';
                              echo '<td><button onclick="liberar('.$remis->ID_REMIS.');" class="btn btn-primary">Liberar</button></td>';
                          break;
                          case 2: 
                              echo '<td></td><td><span class="label label-warning">Fuera de servicio</span></td><td></td><td></td><td>
                              <button onclick="servicio(\''.$remis->PATENTE.'\', '.$remis->ID_REMIS.');" class="btn btn-primary">En servicio</button></td>
                              ';
                          break;     
                          case 99: 
                              echo '<td>'.$remis->NOMBRE.'</td><td><span class="label label-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Boton antipanico activo</span></td><td></td><td></td><td>
                              <button onclick="ApagarBoton('.$remis->ID_REMIS.');" class="btn btn-primary">Apagar boton antipanico</button></td>
                              ';
                          break;            
                        }
                       echo '</tr>';

                   }
                  }
                ?>      
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      <form action="<?= $this->config->base_url(); ?>Moviles/EnServicio" method="POST">
      <div class="modal modal-default fade" id="modal-enservicio" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="titulo"></h4>
          </div>
          <div class="modal-body">
            <div class="box-body table-responsive">
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-12">
                    <input type="hidden" id="ID_REMIS" name="ID_REMIS" />
                    <input type="hidden" id="delete-title" name="delete-title" />
                    <p>Por favor seleccione el chofer</p>
                    <div class="callout callout-primary">
                      <select class="form-control" name="ID_CHOFER" id="selchofer"></select>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- /.box-body -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
            <button id="btn-delete" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Aceptar</button>
          </div>
        </div>
      </div>
    </div>
    </form>



  <form action="<?= $this->config->base_url(); ?>Moviles/FueraDeServicio" method="POST">
      <div class="modal modal-default fade" id="modal-fueradeservicio" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="titulo"></h4>
          </div>
          <div class="modal-body">
            <div class="box-body table-responsive">
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-12">
                    <input type="hidden" id="fdsID_REMIS" name="fdsID_REMIS" />
                    <input type="hidden" id="fdsID_CHOFER" name="fdsID_CHOFER" />
                    <p>¿Desea poner este remis fuera de servicio?</p>
         
                  </div>
                </div>
              </div>
            </div><!-- /.box-body -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
            <button id="btn-delete" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Aceptar</button>
          </div>
        </div>
      </div>
    </div>
    </form>


  <form action="<?= $this->config->base_url(); ?>Viajes/SolicitarViajeWeb" method="POST">
      <div class="modal modal-default fade" id="modal-ocupar" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="titulo"></h4>
          </div>
          <div class="modal-body">
            <div class="box-body table-responsive">
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-12">
                    <input type="hidden" id="ocID_REMIS" name="ocID_REMIS" />
                    <input type="hidden" id="ocID_CHOFER" name="ocID_CHOFER" />
                    <input type="hidden" id="delete-title" name="delete-title" />
                    <p>Ingrese la dirección de origen.</p>
         			<input type="text" name="origen" class="form-control"/>
         			<p>Ingrese la dirección de destino.</p>
         			<input type="text" name="destino" class="form-control"/>
                  </div>
                </div>
              </div>
            </div><!-- /.box-body -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
            <button id="btn-delete" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Aceptar</button>
          </div>
        </div>
      </div>
    </div>
    </form>
	
	
	  <form action="<?= $this->config->base_url(); ?>Viajes/Tomar" method="POST">
      <div class="modal modal-default fade" id="modal-tomar" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="titulo">Nuevo viaje pedido a traves de la app</h4>
          </div>
          <div class="modal-body">
            <div class="box-body table-responsive">
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-12">
                    <input type="hidden" id="toID_VIAJE" name="toID_VIAJE" />
                    <input type="hidden" id="toCODVIAJE" name="toCODVIAJE" />
					  <input type="hidden" id="tolf" name="tolf" />
					    <input type="hidden" id="tolng" name="tolng" />
              <p  style="margin-bottom:-3px;">Pasajero</p>
              <span id="toPasajero"></span>
              <hr>
                    <p style="margin-bottom:-3px;">Dirección de origen: </p>
					<span id="toorigen"></span>
         		<hr>
         			<p style="margin-bottom:-3px;">Dirección de destino.</p>
					
         			<span id="todestino"></span>
					 <p>Por favor seleccione el remis</p>
                    <div class="callout callout-primary">
                      <select class="form-control" name="toid_remis" id="toid_remis"></select>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- /.box-body -->
          </div>
          <div class="modal-footer">
            <button type="button" class="rec btn btn-danger" id="" data-dismiss="modal"><i class="fa fa-times"></i> Rechazar</button>
            <button id="btn-delete" type="button" class="acp btn btn-success"><i class="fa fa-check"></i> Aceptar</button>
          </div>
        </div>
      </div>
    </div>
    </form>
<audio id="player" src="http://upload.wikimedia.org/wikipedia/commons/f/f2/Median_test.ogg"> </audio>
<style>
 .labels {
   color: red;
   background-color: white;
   font-family: "Lucida Grande", "Arial", sans-serif;
   font-size: 10px;
   font-weight: bold;
   text-align: center;
   width: 60px;     
   border: 2px solid black;
   white-space: nowrap;
 }
</style>
<script>
$("document").ready(function(){
var refresca = true;
var init = true;
setInterval(function(){ 
if (refresca){

         $.ajax({
          url: "moviles/Moviles_disponibles",
          type: "post",
          data: 'asd' ,
          success: function (response) {
                  locations = [];

                $.each(JSON.parse(response), function(idx, obj) {
                     auxloc = {}
                    auxloc.ID_REMIS = obj.ID_REMIS;
                    auxloc.LATITUD = parseFloat(obj.LATITUD);
                    auxloc.LONGITUD = parseFloat(obj.LONGITUD);
                    auxloc.ESTADO = obj.ESTADO;
                    locations.push(auxloc);
      
                });

              if (init != true){
                for (i = 0; i < locations.length; i++){
                  if (locations[i].ID_REMIS = marcadores[i].id){
                    switch (locations[i].ESTADO){
                      case '0': 
                                marcadores[i].setPosition( new google.maps.LatLng(locations[i].LATITUD, locations[i].LONGITUD));  
                                marcadores[i].setIcon('<?= base_url();?>admlte/markers/libre.png');
                                if (marcadores[i].get('ESTADO') == 'NULL'){
                                marcadores[i].setMap(map);
                                 marcadores[i].setValues({ESTADO: '0'});
                              }
                              marcadores[i].setAnimation(null);
                      break;
                      case '1': 
                                marcadores[i].setPosition( new google.maps.LatLng(locations[i].LATITUD, locations[i].LONGITUD));  
                                marcadores[i].setIcon('<?= base_url();?>admlte/markers/ocupado.png');
                                
                                 if (marcadores[i].get('ESTADO') == 'NULL'){
                                    marcadores[i].setMap(map);
                                    marcadores[i].setValues({ESTADO: '0'});
                              }
                               marcadores[i].setAnimation(null); 
                      break;
                      case '99':
                        if (marcadores[i].get('ESTADO') == 'NULL'){
                               marcadores[i].setMap(map); 
                               marcadores[i].setValues({ESTADO: '0'});
                              }
                                
                                marcadores[i].setPosition( new google.maps.LatLng(locations[i].LATITUD, locations[i].LONGITUD));  
                                marcadores[i].setAnimation(google.maps.Animation.BOUNCE);
                                marcadores[i].setIcon('<?= base_url();?>admlte/markers/sos.png');
                      break;
                      default:
                                marcadores[i].setMap(null);
                                marcadores[i].setValues({ESTADO: 'NULL'});
                                marcadores[i].setAnimation(null);
                    }
                  }
                }
              }


             if (init == true){
                for (i = 0; i < locations.length; i++)
                {  
                    var anim;
                    if (locations[i].ESTADO == 99){
                      anim =  google.maps.Animation.BOUNCE;
                    }else{
                      anim =  null;
                    }
                    marker = new google.maps.Marker({
                      position: {lat: locations[i].LATITUD, lng: locations[i].LONGITUD},
                      
                          label: {
        text: 'aaa',
        color: 'red',
        fontSize: '20px',
        x: '200',
        y: '-100'
    },
                      icon: '<?= base_url();?>admlte/marcador.png',
                      animation:  anim,
                      id: locations[i].ID_REMIS,
                      map: map
                    });
                    marker.setValues({ESTADO: locations[i].ESTADO});
                    marcadores.push(marker);

                }
                init = false;
              }


        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });

	    $.ajax({
            type: "GET",
            url: 'Viajes/ConsultaNuevo',
            success: function(data) {
                console.log(data);
		if (data != 0){
			refresca = false;
			var obj = jQuery.parseJSON(data);
				
				 $.ajax({
					url: "moviles/Libres",
					type: "post",
					data: 'asd' ,
					success: function (response) {
						$.each($.parseJSON(response), function() {
							$('#toid_remis').append($('<option>', {
							value: this.ID_REMIS,
							text: this.PATENTE 
				}));
  		   });
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
				
				$("#toorigen").html("<STRONG>"+obj.ORIGEN+"</STRONG>");
        $("#toPasajero").html("<STRONG>"+obj.Nombre+ " " + obj.Apellido+"</STRONG>");
				$("#toID_VIAJE").val(obj.ID_VIAJE);
				if (obj.DESTINO == ""){
					$("#todestino").html("No se especificó la dirección de destino");
				}else{
					$("#todestino").html("<STRONG>"+obj.DESTINO+"</strong><hr>");
				}
				
				$('#modal-tomar').modal('show');
		}
            }
        });
}


 }, 3000);
});
function servicio(patente, id){
	$('#selchofer').children().remove().end();
    $("#ID_REMIS").val(id);
	
 $.ajax({
        url: "moviles/Choferes_asignados/"+id,
        type: "post",
        data: 'asd' ,
        success: function (response) {
          $.each($.parseJSON(response), function() {
        	$('#selchofer').append($('<option>', {
   				 value: this.ID_CHOFER,
   				 text: this.NOMBRE 
				}));
  		   });
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });
 $('#modal-enservicio').modal('show');
 $(".titulo").html('<i class="fa fa-car"></i> ' + patente + ' en servicio');
}


function fueradeservicio(patente, id, chofer){
    $("#fdsID_REMIS").val(id);
    $("#fdsID_CHOFER").val(chofer);
	$('#modal-fueradeservicio').modal('show');
	$(".titulo").html('<i class="fa fa-car"></i> ' + patente + ' fuera de servicio');
}

function ocupar(patente, id, CHOFER){
 $("#ocID_REMIS").val(id);
 
 $("#ocID_CHOFER").val(CHOFER);
 $('#modal-ocupar').modal('show');
 $(".titulo").html('<i class="fa fa-car"></i> ' + patente + ' ocupar');
}

function liberar(id){
location.href = 'moviles/liberar/'+id;
}

$(".rec").click(function(){
	location.href = 'Viajes/Rechazar/'+$("#toID_VIAJE").val()+'/'+$("#tolf").val()+'/'+$("#tolng").val();
});
$(".acp").click(function(){
	location.href = 'Viajes/Tomar/'+$("#toID_VIAJE").val()+'/'+$("#toid_remis").val();
});
function ApagarBoton(id){
location.href = 'moviles/ApagarBoton/'+id;
}

</script>

