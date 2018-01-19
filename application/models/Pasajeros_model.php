<?php
class Pasajeros_model extends CI_Model{

	
     function Login($imei)
     {
        $this->db->select('*');
        $this->db->from('pasajeros');
        $this->db->where('IMEI', $imei);
        $consulta  = $this->db->get();
        if ($consulta->num_rows() > 0)
        {
            $resultado = $consulta->row();
            return "[".json_encode($resultado)."]";
        }
        else
        {
            return 0;
        }
      }

      function registrar($data)
      {
           $this->db->insert("pasajeros", $data); 
           return $this->db->insert_id();
      }
     
}
