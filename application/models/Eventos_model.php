<?php
class Eventos_model extends CI_Model{

    function __construct(){
        $this->load->database();
    }
    
    function Baja_chofer($chofer, $remis){
     $data = array(
                    'ID_USUARIO' => $this->session->userdata('ID_REMISERA') ,
                    'ID_CHOFER'  => $chofer ,
                    'ID_REMIS'   => $remis ,
                    'MOMENTO'    => date('Y-m-d H:i:s') ,
                    'TIPO'       => 1,
                  );

        $this->db->insert('Eventos', $data); 
    }
    function Sube_chofer($chofer, $remis){
     $data = array(
                    'ID_USUARIO' => $this->session->userdata('ID_REMISERA') ,
                    'ID_CHOFER'  => $chofer ,
                    'ID_REMIS'   => $remis ,
                    'MOMENTO'    => date('Y-m-d H:i:s') ,

                  );

        $this->db->insert('Eventos', $data); 
    }
  
  
}

