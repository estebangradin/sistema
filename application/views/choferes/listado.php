<div class="col-xs-12">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Mis choferes</h3>
              </div>

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>DNI</th>
                  <th>Nombre</th>
                  <th>Vehículos asignados</th>
                  <th></th>
                </tr>
                <?php foreach($choferes as $chofer){
                 echo ' <tr>
                        <td>'.$chofer->DNI.'</td>
                        <td>'.$chofer->NOMBRE.'</td>';
                      if ($chofer->REMISES_ASIGNADOS == 0){
                      echo '<td><span class="label label-danger">Sin moviles asignados</span></td>';
                      }else{
                      echo '<td><span class="label label-primary">'.$chofer->REMISES_ASIGNADOS.' moviles asignados</span></td>';
                      }

                        echo'
                        <td>
						<a href="AsignarMovil/'.$chofer->ID_CHOFER.'"/><img width="16" height="16" src="'.$this->config->base_url().'admlte/imagenes/plus.png"/>Asignar un movil</a>
                        <a href="ver_detalle/'.$chofer->ID_CHOFER.'"/><img width="16" height="16" src="'.$this->config->base_url().'admlte/imagenes/lupa.png"/>Ver detalles</a>  
                        <a href="editar/'.$chofer->ID_CHOFER.'"/><img width="16" height="16" src="'.$this->config->base_url().'admlte/imagenes/editar.png"/>Editar</a>   
                           <a href="eliminar/'.$chofer->ID_CHOFER.'"/><img width="16" height="16" src="'.$this->config->base_url().'admlte/imagenes/delete.png"/>Eliminar</a>

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