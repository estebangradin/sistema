<div class="col-xs-12">
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Asignar moviles</h3>
              </div>

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>DNI</th>
                  <th>Nombre</th>
                  <th></th>
                </tr>
                <?php foreach($choferes as $chofer){
                 echo ' <tr>
                        <td>'.$chofer->DNI.'</td>
                        <td>'.$chofer->Nombre.'</td>';
                   
                        echo'
						
                        <td>
						<a href="'.$this->config->base_url().'Choferes/AsignaC/'.$chofer->ID_CHOFER.'/'.$id.'"/><img width="16" height="16" src="'.$this->config->base_url().'admlte/imagenes/plus.png"/>Asignar</a>
					

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