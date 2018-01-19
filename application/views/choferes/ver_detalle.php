<div class="col-xs-12">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Detalles del chofer</h3>
              </div>

            <!-- /.box-header -->
            <div class="box-body">
            <?php  if ($chofer->FOTO <> ''){ ?>
         <?php echo '<img  align="left" src="data:image/jpeg;base64,'.base64_encode($chofer->FOTO ).'" width=150 height=150>'; ?>
          <?php  }else{ ?>
               <img  align="left" src="<?= $this->config->base_url(); ?>admlte/imagenes/perfiles/default.png" width=100 height=100/>
              <?php } ?>
             <strong>DNI</strong> <?= $chofer->DNI; ?><BR/>
             <strong>Nombre</strong><?= $chofer->NOMBRE; ?><BR/>
             <strong>Apellido</strong><?= $chofer->APELLIDO; ?><BR/>
             <?php $hoy     = new DateTime("now"); ?>
             <?php $carnet  = new DateTime($chofer->VENCECARNET); ?>
             <strong>Vencimiento del carnet</strong> <?= date_format($carnet, 'd/m/Y'); ?><BR/>
               <?php
                $interval = $hoy->diff($carnet);
         
                if ($interval->format('%R') == '-' ){
                    echo '<span class="label label-danger">El carnet ya esta vencido.</span>';
                }else{
                  if ($interval->d <= 7 ){
                  $dias=  $interval->d + 1;
                  echo '<span class="label label-warning">El carnet vence en '.$dias.' dias.</span>';
                }  
                }
                
             ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
           <?php foreach($remises_asignados as $remis){      ?>
<div class="col-xs-6">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Remis asignado</h3>
              </div>

            <!-- /.box-header -->

            <div class="box-body">
            <?php
              
                 echo '<strong>Dominio </strong>'.$remis->PATENTE.'<br/>';
                 echo '<strong>Licencia </strong>'.$remis->LICENCIA.'<br/>';
                 echo '<strong>Vehículo </strong>'.$remis->MARCA.' '.$remis->MODELO.' '.$remis->COLOR.' '.$remis->ANIO.'<br/>';
                 echo '<a href="'.$this->config->base_url().'moviles/ver_detalle/'.$remis->ID_REMIS.'">Ver detalles</a>';	 
				 echo '<br/><button type="button" onclick="desasociar('.$remis->ID_REMIS.', '.$chofer->ID_CHOFER.');" class="btn btn-danger">Desasociar este movil</button>';
              
         echo '
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div> ';
           }
            ?>               
			<script>
				function desasociar(remis, chofer){
					location.href="<?= $this->config->base_url(); ?>moviles/desasociar/"+remis+"/"+chofer;
				}
			</script>