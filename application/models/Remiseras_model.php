<?php
class Remiseras_model extends CI_Model{

    function __construct(){
        $this->load->database();
    }
    


    function Listar(){
        $this->db->select('*');
        $this->db->from('remiseras');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

	    function max(){
        $this->db->select('max(ID_REMISERA) as MAXS');
        $this->db->from('remiseras');
        $consulta  = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

    
}

