<?php
class Remises_model extends CI_Model{

    function __construct(){
        $this->load->database();
    }
    
    function Guardar_remis($patente, $marca, $modelo, $anio, $licencia, $simb, $color, $vrevesa, $vseguro, $vgnc){
     $data = array(
                    'ID_REMISERA' => $this->session->userdata('ID_REMISERA') ,
                    'PATENTE' => $patente ,
                    'MARCA' => $marca ,
                    'MODELO' => $modelo ,
                    'ANIO' => $anio ,
                    'ESTADO' => -1 ,
                    'COLOR' => $color,
                    'LICENCIA' => $licencia,
                    'SIMBOLOGIA' => $simb,
                    'VENCEREVESA' => $vrevesa,
                    'VENCESEGURO' => $vseguro,
                    'VENCEOBLEA'    => $vgnc

                  );

        $this->db->insert('remises', $data); 
    }
	
	 function AsignaC($remis, $chofer){
     $data = array(
                    'ID_REMIS' => $remis ,
                    'ID_CHOFER' => $chofer 

                  );

        $this->db->insert('DET_REMISES', $data); 
    }
	
 function ActualizarPosicion($remis, $latitud, $longitud){
     $data = array(
                    'LONGITUD' => $longitud ,
                    'LATITUD' => $latitud,
                    'FECHAACT' => date("Y-m-d H:i:s")
                  );

        $this->db->update('REMISES', $data, array('ID_REMIS' => $remis)); 
          $this->db->insert('coords', $data); 
        echo $this->db->last_query();
    }

     function Modificar_remis($patente, $marca, $modelo, $anio, $licencia, $color, $id, $vrevesa, $simb, $vseguro, $vgnc){
     $data = array(
                    'ID_REMISERA' => $this->session->userdata('ID_REMISERA') ,
                    'PATENTE' => $patente ,
                    'MARCA' => $marca ,
                    'MODELO' => $modelo ,
                    'ANIO' => $anio ,
                    'COLOR' => $color,
                    'LICENCIA' => $licencia,
                    'VENCEREVESA' => $vrevesa,
                    'VENCESEGURO' => $vseguro,
                    'VENCEOBLEA'    => $vgnc
                  );

        $this->db->update('remises', $data, array('ID_REMIS' => $id));
    }


    function Listar_remis(){
        $this->db->select('*');
        $this->db->from('remises');
        $this->db->where("ID_REMISERA",  $this->session->userdata('ID_REMISERA') );
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }
	  function Libres(){
        $this->db->select('*');
        $this->db->from('remises');
        $this->db->where("ID_REMISERA",  $this->session->userdata('ID_REMISERA') );
		$this->db->where("ESTADO",  0);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }


    function Listar_remis2(){
        $this->db->select('R.ID_REMIS, R.PATENTE, R.LICENCIA, R.COLOR, R.MODELO, R.MARCA, R.ANIO, R.LATITUD, R.LONGITUD, R.FECHAACT');
        $this->db->select('R.ESTADO, C.NOMBRE, C.ID_CHOFER, V.ORIGEN, V.DESTINO');
        $this->db->from('remises as R');
        $this->db->join('viajesN as V', 'V.ID_MOVIL = R.ID_REMIS', 'LEFT');
        $this->db->join('choferes as C', 'R.CHOFER_SERVICIO = C.ID_CHOFER', 'LEFT');
        $this->db->where("R.ID_REMISERA",  $this->session->userdata('ID_REMISERA'));
    		$this->db->where('V.MOMENTO IN (SELECT MAX(MOMENTO)
                                      FROM VIAJESN V 
                                           RIGHT JOIN REMISES R 
                                               ON V.ID_MOVIL=R.ID_REMIS
                                    GROUP BY R.ID_REMIS) ORDER BY V.MOMENTO desc');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }
   function Datos_remis($id){
        $this->db->select('*');
        $this->db->from('remises');
        $this->db->where('ID_REMIS', $id);
        $consulta  = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }
    function   Choferes_asignados($id){
        $this->db->select('ID_CHOFER, NOMBRE, DNI');
        $this->db->from('CHOFERES');
        $this->db->where('ID_CHOFER IN (SELECT ID_CHOFER FROM DET_REMISES WHERE ID_REMIS='.$id.')');
        $consulta  = $this->db->get();
        $consulta  = $consulta->result();
        return $consulta;
    }
    function   Chofer_enservicio($id){
        $this->db->select('ID_CHOFER, NOMBRE, DNI');
        $this->db->from('CHOFERES');
        $this->db->where('ID_CHOFER IN (SELECT CHOFER_SERVICIO FROM DET_REMISES WHERE ID_REMIS='.$id.')');
        $consulta  = $this->db->get();
        $consulta  = $consulta->row();
        return $consulta;
    }
  function En_Servicio($chofer, $remis){
     $data = array(
                    'CHOFER_SERVICIO' => $chofer ,
                    'ESTADO' => 0,
                  );

        $this->db->update('remises', $data, array('ID_REMIS' => $remis));
    }
   function FueraDeServicio($remis){
     $data = array(
                   'ESTADO' => 2,
                  );
        $this->db->update('remises', $data, array('ID_REMIS' => $remis));
    }
	  function Desasociar($remis, $chofer){
   
       $this->db->delete('det_remises', array('ID_CHOFER' => $chofer, 'ID_REMIS' => $remis)); 
    }
    

	
    function GuardoViaje($remis, $codigo, $lofo, $lafo, $lofd, $lafd, $do, $dd, $pn, $pe, $momento, $latitud_dispositivo, $longitud_dispositivo, $remisera){
      $data = array(
                    'ESTADO' => 1,
                  );

     $this->db->update('remises', $data, array('ID_REMIS' => $remis));
     $data = array(
                    'ID_REMISERA' => $remisera ,
                    'ID_REMIS' => $remis ,
                    'LONGITUD_FORMAL' => $lofo ,
                    'LATITUD_FORMAL' => $lafo ,
                    'LONGITUD_DESTINO' => $lofd ,
                    'LATITUD_DESTINO' =>  $lafd ,
                    'DIRECCION_ORIGEN' => $do,
                    'DIRECCION_DESTINO' => $dd,
                    'CODIGO_VIAJE'   => $codigo,
                    'PASAJERONOMBRE' => $pn,
                    'PASAJEROEMAIL' => $pe,
                    'MOMENTO' => $momento,
                    'ESTADO'  => 0,
                    'LATITUD_DISPOSITIVO' => $latitud_dispositivo,
                    'LONGITUD_DISPOSITIVO' => $longitud_dispositivo


                  );

        $this->db->insert('viajes', $data); 
        
    }
     function Liberar($remis){
     $data = array(
                   'ESTADO' => 0,
                  );
        $this->db->update('remises', $data, array('ID_REMIS' => $remis));
    }
     function ApagarBoton($remis){
     $data = array(
                   'ESTADO' => 0,
                  );
        $this->db->update('remises', $data, array('ID_REMIS' => $remis));
    }
	
    function RemiseraCercana($lat , $long){
        $this->db->select('ID_REMISERA, NOMBRE, ( 6371 * ACOS( 
                                 COS( RADIANS('.$lat.') ) 
                                 * COS(RADIANS( LATITUD ) ) 
                                 * COS(RADIANS( LONGITUD ) 
                                 - RADIANS('.$long.') ) 
                                 + SIN( RADIANS('.$lat.') ) 
                                 * SIN(RADIANS( LATITUD ) ) 
                                )
                   ) AS distance ');
        $this->db->from('remiseras');
        $this->db->where('ID_REMISERA IN (SELECT ID_REMISERA FROM REMISES WHERE ESTADO=0)');
		$this->db->where('ESTADO=1');
        $this->db->order_by("distance", "asc");
        $consulta  = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;

    }
 function   Listar_remis_asoc($id){
     $this->db->select('*');
        $this->db->from('remises');
        $this->db->where("ID_REMISERA",  $this->session->userdata('ID_REMISERA') );
		$this->db->where('`ID_REMIS` NOT IN (SELECT `ID_REMIS` FROM `DET_REMISES` WHERE ID_CHOFER='.$id.')', NULL, FALSE );
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
 }
  function Setocupado($Remis){
     $data = array(
                   'ESTADO' => 1,
                  );
        $this->db->update('remises', $data, array('ID_REMIS' => $Remis));

    }
    
}

