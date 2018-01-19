<?php
class Viajes_model extends CI_Model{

    function __construct(){
        $this->load->database();
    }
    

    function ConsultaViaje2($codigo){
        $this->db->select('V.ID_VIAJE, C.NOMBRE as chofer, R.PATENTE, RMS.BANNER, CONCAT( R.MARCA, " ",  R.MODELO, " ",  R.COLOR) AS AUTO, R.LICENCIA, RMS.BANNER, RMS.NOMBRE as NOMBRE
, RMS.LATITUD, RMS.LONGITUD, RMS.DIRECCION AS DIRREMIS, RMS.TELEFONO AS TELREMIS');
        $this->db->from('CHOFERES AS C');
		$this->db->join('DET_REMISES as dr', 'c.id_chofer = dr.id_chofer');
		$this->db->join('REMISES as r', 'r.ID_REMIS = dr.ID_REMIS');		
		$this->db->join('REMISERAS as rms', 'R.ID_REMISERA = RMS.ID_REMISERA');
		$this->db->join('VIAJES AS V', 'R.ID_REMIS = V.ID_REMIS');
        $this->db->where('CODIGO_VIAJE', $codigo);
	    $consulta  = $this->db->get();
        $resultado = $consulta->row();
              if (count($resultado) == 0){
          return 0;
        }else
        {
          return ($resultado);
        }

    }
	  function ConsultaViaje3($codigo){
        $this->db->select('V.ID_VIAJE, C.NOMBRE as chofer, R.PATENTE, RMS.BANNER, CONCAT( R.MARCA, " ",  R.MODELO, " ",  R.COLOR) AS AUTO, R.LICENCIA, RMS.BANNER, RMS.NOMBRE as NOMBRE
		, RMS.LATITUD, RMS.LONGITUD, RMS.DIRECCION AS DIRREMIS, RMS.TELEFONO AS TELREMIS');
        $this->db->from('CHOFERES AS C');
		$this->db->join('DET_REMISES as dr', 'c.id_chofer = dr.id_chofer');
		$this->db->join('REMISES as r', 'r.ID_REMIS = dr.ID_REMIS');		
		$this->db->join('REMISERAS as rms', 'R.ID_REMISERA = RMS.ID_REMISERA');
		$this->db->join('VIAJES AS V', 'R.ID_REMIS = V.ID_REMIS');
        $this->db->where('V.CODIGO_VIAJE', $codigo);
	    $consulta  = $this->db->get();
        $resultado = $consulta->row();
		echo $this->db->last_query();
              if (count($resultado) == 0){
          return 0;
        }else
        {
          return ($resultado);
        }
	
    }
	
	 function ConsultaNuevo(){
       // $this->db->select(' ID_VIAJE, CODIGO_VIAJE, PASAJERONOMBRE, DIRECCION_ORIGEN, LATITUD_FORMAL, LONGITUD_FORMAL, DIRECCION_DESTINO, estado');
        $this->db->select('v.ID_VIAJE ,v.ORIGEN, v.DESTINO, p.Nombre, p.Apellido' );
        $this->db->from('viajesn as v');
        $this->db->join('pasajeros as p', 'v.ID_PASAJERO = p.ID_PASAJERO');
        $this->db->where('v.ID_REMISERA', $this->session->userdata('ID_REMISERA'));
        $this->db->where('v.ESTADO', 0);
		    $this->db->order_by('ID_VIAJE', 'DESC');
	      $consulta  = $this->db->get();
        if ($consulta->num_rows() > 0)
        {
        $resultado = $consulta->row();
          return json_encode($resultado);
        }else{
          return 0;
        }
        
        
        
    }
	
	
    function ConsultaViaje12($codigo){
        $this->db->select('*');
        $this->db->from('viajes');
        $this->db->where('CODIGO_VIAJE', $codigo);
		 $this->db->where('ESTADO', '1');
        $consulta  = $this->db->get();
        $resultado = $consulta->row();
        if (count($resultado) == 0){
          return 0;
        }else
        {
          return ($resultado);
        }
    }

    function buscaremisera(){
        $this->db->select('ID_REMISERA');
        $this->db->from('remiseras');
        $this->db->where('ESTADO', 1);
        $this->db->where('NOT ID_REMISERA IN (SELECT ID_REMISERA FROM rechazos)
        AND 
        ( 6371 * ACOS( 
                                 COS( RADIANS(LF) ) 
                                 * COS(RADIANS( LATITUD ) ) 
                                 * COS(RADIANS( LONGITUD ) 
                                 - RADIANS(LNGF) ) 
                                 + SIN( RADIANS(LF ) ) 
                                 * SIN(RADIANS( LATITUD ) ) 
                                )
              )
              < 1');
        $this->db->limit(1);
        $consulta  = $this->db->get();
        $resultado = $consulta->row();
        return $resultado->ID_REMISERA;
    }
    function Rechazar($id_viaje, $latitud_formal, $longitud_formal){
     
       $data = array('ID_REMISERA' => $this->session->userdata('ID_REMISERA'),
                     'ID_VIAJE' => $id_viaje
        ); 
        $this->db->insert('rechazos', $data); 
       
        $this->db->select("ID_REMISERA");
		$this->db->from("remiseras");
		$this->db->where("ESTADO", 1);
		//$this->db->where('NOT ID_REMISERA IN (SELECT ID_REMISERA FROM rechazos)');
		$this->db->where('NOT ID_REMISERA IN (SELECT ID_REMISERA FROM rechazos) and ( 6371 * ACOS( 
                                 COS( RADIANS("'.$latitud_formal.'") ) 
                                 * COS(RADIANS( LATITUD ) ) 
                                 * COS(RADIANS( LONGITUD ) 
                                 - RADIANS("'.$longitud_formal.'") ) 
                                 + SIN( RADIANS("'.$latitud_formal.'" ) ) 
                                 * SIN(RADIANS( LATITUD ) ) 
                                )
							)', NULL, FALSE );
	//	$this->db->where('');
                        
        $consulta  = $this->db->get();
        $resultado = $consulta->row();
      
        if (count($resultado) > 0){
           $data = array('ID_REMISERA' => $resultado->ID_REMISERA); 
            $this->db->update('viajesn', $data, array('ID_VIAJE' => $id_viaje)); 
        }else{
           $data = array('ESTADO' => 2); 
            $this->db->update('viajesn', $data, array('ID_VIAJE' => $id_viaje)); 
        }
     echo $this->db->last_query(); 
    }
    
	  function Aceptar($Viaje, $Remis){
     $data = array(
                   'ID_MOVIL' => $Remis,
				   'estado' => 1
                  );
				  
        $this->db->update('Viajesn', $data, array('ID_VIAJE' => $Viaje));
    }


    function SolicitarViaje($data) {

      $this->db->insert("viajesn", $data);
          return $this->db->insert_id();
    }

   function SolicitarViajeWeb($data) {

      $this->db->insert("viajesn", $data);
      return $this->db->insert_id();
    }
/*
    function ConsultarSolicitud($id_viaje){
        $this->db->select('*');
        $this->db->from('viajesn');
        $this->db->where('ID_VIAJE', $id_viaje);
        $this->db->where('ESTADO', 1);
        $consulta  = $this->db->get();
        if ($consulta->num_rows() > 0)
        {
          $resultado = $consulta->row();
          return "[".json_encode($resultado)."]";
        }else{
          return 0;
        }
        */
        function ConsultarSolicitud($id_viaje){
        $this->db->select('c.NOMBRE, r.PATENTE, r.MODELO, r.MARCA, r.ANIO, r.LICENCIA, rm.NOMBRE, rm.TELEFONO, rm.DIRECCION, rm.ESTADO');
        $this->db->from('viajesn as v');
        $this->db->join('remises as r', 'v.ID_MOVIL = r.ID_REMIS');
        $this->db->join('remiseras as rm', 'v.ID_REMISERA = rm.ID_REMISERA');
        $this->db->join('choferes as c', 'v.ID_CHOFER = c.ID_CHOFER');
        $this->db->where('v.ID_VIAJE', $id_viaje);
        $this->db->where('v.ESTADO', 1);
        $consulta  = $this->db->get();
       
        if ($consulta->num_rows() > 0)
        {
          $resultado = $consulta->row();
          return "[".json_encode($resultado)."]";
        }else{
          return 0;
        }
        

        
        
    }
}

