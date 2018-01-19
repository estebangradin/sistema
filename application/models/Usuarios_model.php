<?php
class Usuarios_model extends CI_Model{

    function __construct(){
        $this->load->database();
    }
    
    function Login($usuario, $clave){
       	$this->db->select('U.ID_USUARIO,U.NOMBRE, U.ID_REMISERA AS ID_REMISERA, R.LATITUD, R.LONGITUD');
        $this->db->from('USUARIOS AS U');
        $this->db->join('REMISERAS as R', 'R.ID_REMISERA = U.ID_REMISERA', 'LEFT');
        $this->db->where('U.USUARIO', $usuario);
        $this->db->where('U.PASSWORD', $clave);
        $query 	   = $this->db->get();
        $resultado = $query->row();
        return $resultado;
 
    }

}
?>