      
<div class="col-xs-12">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Detalles del remis</h3>
              </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table>
              <tr>
            
               <td>
               <table>
                  <tr>
                     <td><strong>Patente: </strong></td><td style="padding-left: 10px;"><?= $remis->PATENTE; ?></td>
                  </tr>
                  <tr>
                     <td><strong>Licencia: </strong></td><td style="padding-left: 10px;"><?= $remis->LICENCIA; ?></td>
                  </tr>
                  <tr>
                     <td><strong>Vehículo: </strong></td><td style="padding-left: 10px;"><?= $remis->MARCA.' '.$remis->MODELO.' '.$remis->COLOR.' '.$remis->ANIO; ?></td>
                  </tr>

                       <?php $hoy     = new DateTime("now"); ?>
                       <?php $revesa  = new DateTime($remis->VENCEREVESA); ?>
                       <?php $seguro  = new DateTime($remis->VENCESEGURO); ?>
                       <?php $oblea   = new DateTime($remis->VENCEOBLEA); ?>
                       <?php $service = new DateTime($remis->PROXSERVICE); ?>
              <tr>
                    <td><strong>Vencimiento de revesa:</strong></td><td style="padding-left: 10px;"><?= '  '.date_format($revesa, 'd/m/Y'); ?>
             <?php
                $interval = $hoy->diff($revesa);
                if ($interval->d <= 7 ){
                  $dias=  $interval->d + 1;
                  echo '<span class="label label-warning">La revisión técnica vence en '.$dias.' dias.</span>';
                }
             ?></td>
             </tr>
             <tr>
             <td><strong>Vencimiento del seguro:</strong></td><td style="padding-left: 10px;"><?= date_format($seguro, 'd/m/Y'); ?>
              <?php
                $interval = $hoy->diff($seguro);
                if ($interval->d <= 7 ){
                  $dias=  $interval->d + 1;
                  echo '<span class="label label-warning">El seguro vence en '.$dias.' dias.</span>';
                }
             ?></td>
             </tr>
            <tr>
             <td><strong>Vencimiento de la oblea de GNC:</strong></td><td style="padding-left: 10px;"><?= date_format($oblea, 'd/m/Y'); ?>
              <?php
                $interval = $hoy->diff($oblea);
                if ($interval->d <= 7 ){
                  $dias=  $interval->d + 1;
                  echo '<span class="label label-warning">La oblea vence en '.$dias.' dias.</span>';
                }
             ?></td>
             </tr>
              <tr>
             <td><strong>Proximo service:</strong></td><td style="padding-left: 10px;"><?= date_format($service, 'd/m/Y'); ?>
              <?php
                $interval = $hoy->diff($service);
                if ($interval->d <= 7 ){
                  $dias=  $interval->d + 1;
                  echo '<span class="label label-warning">El proximo service es en '.$dias.' dias.</span>';
                }
             ?></td>
             </tr>
             <?php if ($revesa <= $hoy || $seguro <= $hoy){  ?>
             <tr>
             <td><strong>Condición: </strong></td><td style="padding-left: 10px;"><span class="label label-danger">El vehículo no esta en condiciones de operar.</span></td>
             </tr>
          
             <?php }else{ ?>
            
             <tr>
              <td><strong>Condición: </strong></td><td style="padding-left: 10px;"><span class="label label-success">El vehículo esta en condiciones de operar.</span></td>
             </tr>
              <?php } ?>
             </table>
              </td>

               <td style="padding-left: 30px;">
                  <table>
                  <?php foreach ($choferes as $chofer){
                    echo ' <tr>
                              <td><strong>Chofer: </strong></td><td><a href="'.$this->config->base_url().'choferes/ver_detalle/'.$chofer->ID_CHOFER.'">'.$chofer->NOMBRE.'</a></td>                     
                           </tr>';
                  }
                  ?>
                  </table>
               </td>
               </tr>
              </table>

            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
