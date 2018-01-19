<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moviles extends CI_Controller {
	public function index()
	{
		if($this->session->userdata('ID')){
			$this->load->view('header');
			$this->load->view('panel/index');	 
			$this->load->view('footer');
		}else{
			$this->load->view('login');	
		}
		
	}
	public function Nuevo(){
		if($this->session->userdata('ID')){
			$this->load->view('header');
			$this->load->view('moviles/nuevo');	 
			$this->load->view('footer');

		}else{
			$this->load->view('login');	
		}
	}
	public function Guardar(){
		if($this->session->userdata('ID')){
			$marca    = $this->input->post('marca');
			$modelo   = $this->input->post('modelo');
			$anio     = $this->input->post('anio');
			$color    = $this->input->post('color');
			$patente  = $this->input->post('patente');
			$licencia = $this->input->post('licencia');
			$simbologia = $this->input->post('simb');
			$vrevesa  = date("Y-m-d", strtotime($this->input->post('vrevesa')));
			$vseguro  = date("Y-m-d", strtotime($this->input->post('vseguro')));
			$vgnc     = date("Y-m-d", strtotime($this->input->post('vgnc')));
			$this->load->model('Remises_model');
            $this->Remises_model->Guardar_remis($patente, $marca, $modelo, $anio, $licencia, $simbologia, $color, $vrevesa, $vseguro, $vgnc);
            redirect('panel');
		}else{
			$this->load->view('login');	
		}
	}
	public function mis_moviles()
	{
		if($this->session->userdata('ID')){
			$this->load->model('Remises_model');
          	$remises = $this->Remises_model->Listar_remis();	
            $datos = 	array("remises" => $remises);
			$this->load->view('header');
			$this->load->view('moviles/listado', $datos);	 
			$this->load->view('footer');
		}else{
			$this->load->view('login');	
		}
		
	}
	public function Editar($id){
		if($this->session->userdata('ID')){
			$this->load->model('Remises_model');
			$remis = $this->Remises_model->Datos_remis($id);	
			$datos = array("remis" => $remis);	
			$this->load->view('header');
			$this->load->view('moviles/editar', $datos);	 
			$this->load->view('footer');
		}else{
			$this->load->view('login');	
		}
	}
	public function Modificar(){
		if($this->session->userdata('ID')){
			$marca    = $this->input->post('marca');
			$modelo   = $this->input->post('modelo');
			$anio     = $this->input->post('anio');
			$color    = $this->input->post('color');
			$patente  = $this->input->post('patente');
			$licencia = $this->input->post('licencia');
			$vrevesa  = $this->input->post('vrevesa');
			$simbologia  = $this->input->post('simb');
			$vrevesa  = str_replace('/', '-', $vrevesa);
			$vrevesa  = date("Y-m-d", strtotime($this->input->post('vrevesa')));
 			echo $vrevesa;
			$vseguro  = date("Y-m-d", strtotime($this->input->post('vseguro')));
			$vgnc     = date("Y-m-d", strtotime($this->input->post('vgnc')));
			$id  = $this->input->post('id');
			$this->load->model('Remises_model');
            $this->Remises_model->Modificar_remis($patente, $marca, $modelo, $anio, $licencia, $color, $id, $vrevesa, $simbologia, $vseguro, $vgnc);
		}else{
			$this->load->view('login');	
		}
	}
	public function ver_detalle($id)
	{
		if($this->session->userdata('ID')){
			$this->load->model('Remises_model');
			$remis 		= $this->Remises_model->Datos_remis($id);	
			$choferes 	= $this->Remises_model->Choferes_asignados($id);
			$this->load->view('header');
			if (count($remis) == 0){
				$this->load->view('404');	 
			}else{
				$datos  	= array('remis' => $remis, 'choferes' => $choferes);
				$this->load->view('moviles/ver_detalle', $datos);	 	
			}
			$this->load->view('footer');
		}else{
			$this->load->view('login');	
		}
		
	}

	public function Choferes_asignados($id)
	{
		$this->load->model('Remises_model');
		$choferes 		= $this->Remises_model->Choferes_asignados($id);	
		$datos  	= array('choferes' => $choferes);
		$this->load->view('moviles/choferes', $datos);	 	

	}
function sendGCM($id, $acc) {


	$this->load->model('Choferes_model');
	$datos_chofer 	   = $this->Choferes_model->Detalle_chofer($id);	
	print_r($datos_chofer);
		$token = 	$datos_chofer->TOKEN;
    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array (
            'registration_ids' => array (
                    $token
            ),
            'data' => array (
            		
                    "accion"    => $acc
                   
            )
    );
    $fields = json_encode ( $fields );

    $headers = array (
            'Authorization: key=' . "AAAAKwKJ3yw:APA91bEXC62xlMR01JixEnCIRTIQ_peMnZIIQW5LTh-JPi21oNgnt1Xc9Or1UI8wO7xWATBlUqfecGY8SWFaTG32aT3nhigsbbvDC_-XcbOrHEbb3kV8U8YstqGCnUPsQ75pNAXB3ceR",
            'Content-Type: application/json'
    );

    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, true );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

    $result = curl_exec ( $ch );
    echo $result;
    curl_close ( $ch );
}

	public function EnServicio()
	{
		$this->load->model('Remises_model');
        $this->Remises_model->En_Servicio($this->input->post('ID_CHOFER'), $this->input->post('ID_REMIS'));
        $this->load->model('Eventos_model');
        $this->Eventos_model->Sube_chofer($this->input->post('ID_CHOFER'), $this->input->post('ID_REMIS'));
        $this->sendGCM($this->input->post('ID_CHOFER'), 'online');
		//redirect('panel');
	}

	public function FueraDeServicio()
	{
		$this->load->model('Remises_model');
        $this->Remises_model->FueraDeServicio($this->input->post('fdsID_REMIS'));
        $this->load->model('Eventos_model');
        $this->Eventos_model->Baja_chofer($this->input->post('fdsID_CHOFER'), $this->input->post('fdsID_REMIS'));
        redirect('panel');
	}

	public function Ocupar()
	{
		$this->load->model('Remises_model');	
		////////////////////SETEAR PASAJERO/////////////////////////////////////////////////////////////////
		if ($this->input->post('nombre') == ''){
			$pasajero = "Pasajero externo"; 
			$pasajeroemail = "Pasajero externo";
			$latitud_dispositivo  = '';
			$longitud_dispositivo  = ''; 
		}else{
			$pasajero =      $this->input->post('nombre'); 
			$pasajeroemail = $this->input->post('EMAIL');
			$latitud_dispositivo =  $this->input->post('latitud_dispositivo');
			$longitud_dispositivo =  $this->input->post('longitud_dispositivo');
			if ($this->input->post('id_remisera') == ''){
			$remisera = $this->Remises_model->RemiseraCercana($latitud_dispositivo, $longitud_dispositivo);
			$remisera = $remisera->ID_REMISERA;
			}else{
				$remisera = $this->input->post('id_remisera');
				
			}
		}



		///////////////OBTENER COORDENADAS DE LA DIRECCION DE ORIGEN/////////////////////////////////////////
		$direccion_origen = $this->input->post('origen');
		$url_geo = 'http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($direccion_origen.', salta, argentina');
		$geo = file_get_contents($url_geo);
		$geo = json_decode($geo, true);
			try {
		$latitud_formal_origen  = $geo['results'][0]['geometry']['location']['lat'];
		$longitud_formal_origen = $geo['results'][0]['geometry']['location']['lng'];
		} catch (Exception $e)  {
				$latitud_formal_origen  = 0;
				$longitud_formal_origen = 0;
			}
		//////////////////OBTENER COORDENADAS DE DESTINO (SI SE ESPECIFICO)//////////////////////
		if ($this->input->post('destino') <> ''){
		$direccion_destino = $this->input->post('destino');
		$url_geo = 'http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($direccion_destino.', salta, argentina');
		$geo = file_get_contents($url_geo);
		$geo = json_decode($geo, true);
		try {
				$latitud_formal_destino  = $geo['results'][0]['geometry']['location']['lat'];
				$longitud_formal_destino = $geo['results'][0]['geometry']['location']['lng'];
			} catch (Exception $e) {
				$latitud_formal_destino  = 0;
				$longitud_formal_destino = 0;
			}
		}else{
			$direccion_destino = '';
			$latitud_formal_destino  = 0;
			$longitud_formal_destino = 0;
		}

		//////////////////GENERAR UN CODIGO DE VIAJE (APARENTEMENTE UNICO)////////////////////////////////////
		$momento  = date("d-m-Y H:i:s");
		$md5  =  substr($pasajero, 0, 4);
		$md5  =  $md5.substr($pasajeroemail, 0, 3);
		$md5  =  $md5.substr($direccion_origen, 0, 6);
		$md5  =  $md5.$momento;
		$md5  =  strtoupper(substr(md5($md5), 0, 15));
		$codigo =  'COD'.$md5;

        /////////////////////////////////INTENTO CALCULAR LA DISTANCIA (SI SE ESPECIFICO EL DESTINO)/////////
		/*if ($this->input->post('destino') <> ''){
			$point1 = array("lat" => "$latitud_formal_origen", "long" => "$longitud_formal_origen"); 
			$point2 = array("lat" => "$latitud_formal_destino", "long" => "$longitud_formal_destino"); 
			$distancia = distancia($point1['lat'], $point1['long'], $point2['lat'], $point2['long']); // Calcular la distancia en kilómetros (por defecto)
		}

								TAREA PARA LA CASA JUA JUA
		*/


		///////////////////////////////////GUARDO EL VIAJE ////////////////////////////////////////////////
	     
	     if (!isset($remisera)){
							
        $this->Remises_model->GuardoViaje(
            $this->input->post('ocID_REMIS'),
        	$codigo,
        	$longitud_formal_origen,
        	$latitud_formal_origen,
        	$longitud_formal_destino,
        	$latitud_formal_destino,
        	$direccion_origen,
        	$direccion_destino,
        	$pasajero,
        	$pasajeroemail,      
        	date("Y-m-d H:i:s"),
        	$latitud_dispositivo,
        	$longitud_dispositivo,
        	$this->session->userdata('ID_REMISERA')
        	);
         redirect('panel');
        }else{
          	$this->Remises_model->GuardoViaje(
        	NULL,
        	$codigo,
        	$longitud_formal_origen,
        	$latitud_formal_origen,
        	$longitud_formal_destino,
        	$latitud_formal_destino,
        	$direccion_origen,
        	$direccion_destino,
        	$pasajero,
        	$pasajeroemail,      
        	date("Y-m-d H:i:s"),
        	$latitud_dispositivo,
        	$longitud_dispositivo,
        	$remisera
        	);
			
			$evento1 =  "
							
							CREATE EVENT rech".$this->db->insert_id()."
							ON SCHEDULE AT NOW()
							ON COMPLETION PRESERVE
							ENABLE
							DO
							call buscaremisera(".$this->db->insert_id().");
							";				
			$this->db->simple_query($evento1);
			
          	echo $codigo;
			
        }
       
	}

	public function liberar($id)
	{
		$this->load->model('Remises_model');
        $this->Remises_model->Liberar($id);
        redirect('panel');
	}
	public function ApagarBoton($id)
	{
		$this->load->model('Remises_model');
        $this->Remises_model->ApagarBoton($id);
        redirect('panel');
	}
	public function Moviles_disponibles(){
	
			$this->load->model('Remises_model');
          	$remises = $this->Remises_model->Listar_remis2();	
           	echo json_encode($remises);
			
		
	}

		public function Libres(){
	
			$this->load->model('Remises_model');
          	$remises = $this->Remises_model->Libres();	
           	echo json_encode($remises);
			
		
	}
		public function desasociar($remis, $chofer){
	
			$this->load->model('Remises_model');
          	$this->Remises_model->Desasociar($remis, $chofer);	
            redirect('panel');
			
		
	}
		public function asociar($remis, $chofer){
	
			$this->load->model('Remises_model');
          	$this->Remises_model->asociar($remis, $chofer);	
            redirect('panel');
			
		
	}
	
	
	public function AsignaC($remis, $chofer){
		if($this->session->userdata('ID')){
	//		$remis    = $this->input->post('remis');
						//$chofer   = $this->input->post('chofer');
			$this->load->model('Remises_model');
            $this->Remises_model->AsignaC($remis, $chofer);
            redirect('panel');
		}else{
			$this->load->view('login');	
		}
	}

	public function AsignarChofer($id)
	{
		if($this->session->userdata('ID')){
			$this->load->model('Choferes_model');
          	$chofer = $this->Choferes_model->Listar_choferes_asoc($id);	
            $datos = 	array("choferes" => $chofer, "id" => $id);
			$this->load->view('header');
			$this->load->view('Choferes/Asignar', $datos);	 
			$this->load->view('footer');
		}else{
			$this->load->view('login');	
		}
	}

	public function ActualizarPosicion()
	{
			$id = $this->input->post("ID");
			$latitud =  $this->input->post("LATITUD");
			$longitud =  $this->input->post("LONGITUD");
			$this->load->model('Remises_model');
            $this->Remises_model->ActualizarPosicion($id, $latitud, $longitud);
			
	}
}






 ///SQL 
/*
SELECT ID_REMISERA, NOMBRE, ( 6371 * ACOS( COS( RADIANS(-24.7825422) ) * COS(RADIANS( LATITUD ) ) * COS(RADIANS( LONGITUD ) - RADIANS(-65.4256653) ) + SIN( RADIANS(-24.7825422) ) * SIN(RADIANS( LATITUD ) ) ) ) AS distance FROM remiseras WHERE ID_REMISERA IN (SELECT ID_REMISERA FROM REMISES WHERE ESTADO=0) AND ESTADO=1 HAVING distance < 1 ORDER BY distance ASC
*/