<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viajes extends CI_Controller {
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
	public function c($direccion)
	{
		
			$address = $direccion; // Google HQ
	        $prepAddr = str_replace(' ','+',$address);
	        $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
	        $output= json_decode($geocode);
	 		if ($output->status == 'OK'){
	        $cord[0] = $output->results[0]->geometry->location->lat;
	        $cord[1] = $output->results[0]->geometry->location->lng;
	    	}else{
	    	$cord[0] = "";
    		$cord[1] = "";	
	    	}
    
        return $cord;	
	}

	public function SolicitarViaje(){
		$id_pasajero = $this->input->post("ID_PASAJERO");
		$origen 	 = $this->input->post("ORIGEN");
		$destino 	 = $this->input->post("DESTINO");
		$co 		 = $this->c($origen.', Salta, Argentina');
		$cd 		 = $this->c($destino.', Salta, Argentina');
		$this->load->model("Remises_model");
		$remisera = $this->Remises_model->RemiseraCercana($co[0], $co[1]);
		$remisera = $remisera->ID_REMISERA;
		$data = array("ID_PASAJERO"       => $id_pasajero,
					  "ORIGEN" 		      => $origen,
					  "DESTINO"		      => $destino,
					  "ESTADO"		      => 0,
					  "MOMENTO"		      => date("Y-m-d H:i:s"),
					  "LATITUD_ORIGEN"    => $co[0],
					  "LONGITUD_ORIGEN"   => $co[1],
					  "LATITUD_DESTINO"   => $cd[0],
					  "LONGITUD_DESTINO"  => $cd[1],
					  "ID_REMISERA"		  => $remisera
					 );
		$this->load->model('Viajes_model');
		echo $this->Viajes_model->SolicitarViaje($data);
	}
function sendGCM($token, $idViaje, $origen, $destino, $fecha) {


    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array (
            'registration_ids' => array (
                    $token
            ),
            'data' => array (
            		
                    "accion"    => 'Imprimir',
                    "Agencia"   => "Profesional Remises",
                    "Fecha"     => $fecha,
                    "Origen"    => $origen,
                    "id_viaje"  => $idViaje,
                    "Destino"   => $destino
                   
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

public function SolicitarViajeWeb(){
		$origen 	 = $this->input->post("origen");
		$destino 	 = $this->input->post("destino");
		$co 		 = $this->c($origen.', Salta, Argentina');
		$cd 		 = $this->c($destino.', Salta, Argentina');
		$remisera  = $this->session->ID_REMISERA;
		$movil	   = $this->input->post("ocID_REMIS");
		$id_chofer = $this->input->post("ocID_CHOFER");
		$data = array("ID_PASAJERO"       => 0,
					  "ORIGEN" 		      => $origen,
					  "DESTINO"		      => $destino,
					  "ESTADO"		      => 0,
					  "MOMENTO"		      => date("Y-m-d H:i:s"),
					  "LATITUD_ORIGEN"    => $co[0],
					  "LONGITUD_ORIGEN"   => $co[1],
					  "LATITUD_DESTINO"   => $cd[0],
					  "LONGITUD_DESTINO"  => $cd[1],
					  "ID_REMISERA"		  => $remisera,
					  "ID_MOVIL"		  => $movil,
					  "ID_CHOFER"		  => $id_chofer
					 );

		$this->load->model('Viajes_model');
		$idViaje = $this->Viajes_model->SolicitarViajeWeb($data);
		$this->load->model("Choferes_model");
		$chofer = $this->Choferes_model->Datos_chofer($id_chofer);
		$this->load->model("Remises_model");
		$this->Remises_model->Setocupado($movil);
		$this->sendGCM($chofer->TOKEN,  $idViaje, $origen, $destino, date("Y-m-d H:i:s"));
	//	redirect('panel');
		
	}


	public function ConsultarSolicitud(){
		$this->load->model('Viajes_model');
		echo $this->Viajes_model->ConsultarSolicitud($this->input->post("ID_VIAJE"));
	}



	public function ConsultaNuevo(){
		$this->load->model('Viajes_model');
		$Viaje = $this->Viajes_model->ConsultaNuevo();
		echo $Viaje;
	}
	
	public function Rechaza($id_viaje, $lf, $lngf){
		$this->load->model('Viajes_model');
		$Viaje = $this->Viajes_model->RechazaViaje($id_viaje, $lf, $lngf);
		//redirect('panel');
	}
	public function Rechazar($id_viaje, $lf="", $lngf=""){
		$this->load->model('Viajes_model');
		$this->Viajes_model->Rechazar($id_viaje, $lf, $lngf);
		
	}
	public function Tomar($viaje, $remis){
		$this->load->model('Viajes_model');
		$this->load->model('Remises_model');
		$this->Viajes_model->Aceptar($viaje, $remis);
		$this->Remises_model->Setocupado($remis);
		
		redirect('panel');
	}
}


