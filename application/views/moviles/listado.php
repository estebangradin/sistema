<div class="col-xs-12">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Listado de remises</h3>
              </div>

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>Patente</th>
                  <th>Licencia</th>
                  <th>Vehiculo</th>
                  <th>Color</th>
                  <th>Estado</th>
                  <th></th>
                </tr>
                <?php foreach($remises as $remis){
                 echo ' <tr>
                        <td>'.$remis->PATENTE.'</td>
                        <td>'.$remis->LICENCIA.'</td>
                        <td>'.$remis->MARCA.' '.$remis->MODELO.' '.$remis->ANIO.'</td>
                        <td>'.$remis->COLOR.'</td>';
                         switch($remis->ESTADO) {
                          case -1: 
                              echo '<td><span class="label label-primary">Sin choferes asignados</span></td>';
                          break;
                          case 0: 
                              echo '<td><span class="label label-success">Libre</span></td>';
                          break;
                          case 1: 
                              echo '<td><span class="label label-danger">Ocupado</span></td>';
                          break;
                          case 2: 
                              echo '<td><span class="label label-warning">Fuera de servicio</span></td>';
                          break;            
                        }
                        echo'
						
                        <td>
						<a href="AsignarChofer/'.$remis->ID_REMIS.'"/><img width="16" height="16" src="'.$this->config->base_url().'admlte/imagenes/plus.png"/>Asignar un chofer</a>
						<a href="ver_detalle/'.$remis->ID_REMIS.'"/><img width="16" height="16" src="'.$this->config->base_url().'admlte/imagenes/lupa.png"/>Ver detalles</a>
                        <a href="editar/'.$remis->ID_REMIS.'"/><img width="16" height="16" src="'.$this->config->base_url().'admlte/imagenes/editar.png"/>Editar</a>   
						<a href="eliminar/'.$remis->ID_REMIS.'"/><img width="16" height="16" src="'.$this->config->base_url().'admlte/imagenes/delete.png"/>Eliminar</a>

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