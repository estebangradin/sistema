<?php
class Remises_model extends CI_Model{

    function __construct(){
        $this->load->database();
    }
    
    function Guardar_remis($patente, $marca, $modelo, $anio, $licencia, $color, $vrevesa, $vseguro, $vgnc){
     $data = array(
                    'ID_REMISERA' => $this->session->userdata('ID_REMISERA') ,
                    'PATENTE' => $patente ,
                    'MARCA' => $marca ,
                    'MODELO' => $modelo ,
                    'ANIO' => $anio ,
                    'ESTADO' => -1 ,
                    'COLOR' => $color,
                    'LICENCIA' => $licencia,
                    'VENCEREVESA' => $vrevesa,
                    'VENCESEGURO' => $vseguro,
                    'VENCEOBLEA'    => $vgnc

                  );

        $this->db->insert('remises', $data); 
    }
     function Modificar_remis($patente, $marca, $modelo, $anio, $licencia, $color, $id, $vrevesa, $vseguro, $vgnc){
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
    //    $this->db->where("ID_REMISERA=")
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }


    function Listar_remis2(){
        $this->db->select('R.ID_REMIS, R.PATENTE, R.LICENCIA, R.COLOR, R.MODELO, R.MARCA, R.ANIO, R.ESTADO, C.NOMBRE, C.ID_CHOFER, DIRECCION_ORIGEN, DIRECCION_DESTINO');
        $this->db->from('remises as R');
        $this->db->join('choferes as C', 'R.CHOFER_SERVICIO = C.ID_CHOFER', 'LEFT');
        $this->db->join('viajes as V', 'R.ID_REMIS = V.ID_REMIS', 'LEFT');
        $this->db->where('V.MOMENTO IN (SELECT MAX(MOMENTO)
                                      FROM VIAJES V 
                                           RIGHT JOIN REMISES R 
                                               ON V.ID_REMIS=R.ID_REMIS
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
    
    function GuardoViaje($remis, $codigo, $lofo, $lafo, $lofd, $lafd, $do, $dd, $pn, $pe, $momento, $latitud_dispositivo, $longitud_dispositivo){
      $data = array(
                    'ESTADO' => 1,
                  );

     $this->db->update('remises', $data, array('ID_REMIS' => $remis));
     $data = array(
                    'ID_REMISERA' => $this->session->userdata('ID_REMISERA') ,
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
                    'ESTADO'  => 1,
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
    
}

