<div class="col-xs-12">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Asignar moviles</h3>
              </div>

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>Patente</th>
                  <th>Licencia</th>
                  <th>Vehiculo</th>
                  <th>Color</th>
                  <th></th>
                  <th></th>
                </tr>
                <?php foreach($remises as $remis){
                 echo ' <tr>
                        <td>'.$remis->PATENTE.'</td>
                        <td>'.$remis->LICENCIA.'</td>
                        <td>'.$remis->MARCA.' '.$remis->MODELO.' '.$remis->ANIO.'</td>
                        <td>'.$remis->COLOR.'</td>';
                   
                        echo'
						
                        <td>
						<a href="'.$this->config->base_url().'Moviles/AsignaC/'.$remis->ID_REMIS.'/'.$id.'"/><img width="16" height="16" src="'.$this->config->base_url().'admlte/imagenes/plus.png"/>Asignar</a>
					

                        </td>

                        </tr>
                       ';
                     }
                ?>      
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>