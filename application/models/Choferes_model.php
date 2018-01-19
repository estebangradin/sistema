<?php
class Choferes_model extends CI_Model{

    function __construct(){
        $this->load->database();
    }
    
    function Guardar_chofer($nombre, $dni){
     $data = array(
                    'ID_REMISERA' => $this->session->userdata('ID_REMISERA') ,
                    'NOMBRE' => $nombre ,
                    'DNI' => $dni ,
                  );

        $this->db->insert('choferes', $data); 
    }
     function Modificar_chofer($nombre, $dni){
     $data = array(
                    'ID_REMISERA' => $this->session->userdata('ID_REMISERA') ,
                    'NOMBRE' => $nombre ,
                    'DNI' => $dni ,
                  );

        $this->db->update('choferes', $data, array('ID_CHOFER' => $id));
    }


    function Listar_chofer(){
        $this->db->select('c.NOMBRE, c.DNI, c.ID_CHOFER, COUNT(dr.ID_DET_REMISES) AS REMISES_ASIGNADOS, dc.ESTADO as es');
        $this->db->from('choferes as c');
        $this->db->join('det_remises as dr', 'c.ID_CHOFER = dr.ID_CHOFER', 'left');
        $this->db->join('det_choferes as dc', 'c.ID_CHOFER = dc.ID_CHOFER', 'left');
		$this->db->where('dc.ID_REMISERA', $this->session->userdata('ID_REMISERA'));
        $this->db->group_by('c.ID_CHOFER');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

	
 
	
     function Datos_chofer($id){
        $this->db->select('*');
        $this->db->from('choferes');
        $this->db->where('ID_CHOFER', $id);
        $consulta  = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }
     function Detalle_chofer($id){
        $this->db->select('NOMBRE, DNI, ID_CHOFER, FOTO, VENCECARNET, APELLIDO, TOKEN');
        $this->db->from('choferes');
        $this->db->where('ID_CHOFER', $id);
        $consulta     = $this->db->get();
        $datos_chofer = $consulta->row();
        return $datos_chofer;
    }
    function   Remises_asignados($id){
        $this->db->select('R.ID_REMIS, R.MARCA,  R.MODELO, R.ANIO,  R.COLOR, R.PATENTE, R.LICENCIA');
        $this->db->from('remises R');
        $this->db->where('ID_REMIS IN (SELECT ID_REMIS FROM DET_REMISES WHERE ID_CHOFER='.$id.')');
        $consulta  = $this->db->get();
        $consulta  = $consulta->result();
        return $consulta;
    }
	  function Listar_choferes_asoc($id){
		$this->db->select('*');
        $this->db->from('choferes');
        $this->db->where("ID_REMISERA",  $this->session->userdata('ID_REMISERA') );
		$this->db->where('`ID_CHOFER` NOT IN (SELECT `ID_CHOFER` FROM `DET_REMISES` WHERE ID_REMIS='.$id.')', NULL, FALSE );
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
		
 }
 	 function AsignaC($chofer, $remis){
     $data = array(
                    'ID_REMIS' => $remis ,
                    'ID_CHOFER' => $chofer 

                  );

        $this->db->insert('DET_REMISES', $data); 
    }
       function Login($dni, $password, $token)
     {
        $this->db->select("NOMBRE, APELLIDO, DNI, ID_MOVIL, ID_REMISERA, ID_CHOFER, TOKEN, VENCECARNET ");
        $this->db->from("Choferes");
        $this->db->where("DNI", $dni);
        $this->db->where("password", $password);
        $consulta  = $this->db->get();
        $resultado = $consulta->row();
            
        if ($consulta->num_rows() > 0)
        {
        
        $this->db->where('DNI', $dni);
        $this->db->where('password', $password);
        $this->db->update('choferes', array('token' => $token)); 
   //     echo $token;
         return json_encode($resultado);
        }
        else
        {
        return 0;
        }
     }

     function CambiaClave($ID_CHOFER, $anterior, $nueva)
     {
 
        
        $this->db->where('ID_CHOFER', $ID_CHOFER);
        $this->db->where('password', $anterior);
        $this->db->update('choferes', array('password' => $nueva)); 
       // echo $this->db->last_query();
        return $this->db->affected_rows();
     }


     function ActualizaFoto($ID_CHOFER, $imgdata)
     {
 
       $imgdata = file_get_contents($imgdata['full_path']);//get the content of the image using its path
          $this->db->where('ID_CHOFER', $ID_CHOFER);
        $this->db->update('choferes', array('FOTO' => $imgdata)); 
       // echo $this->db->last_query();
        return $this->db->affected_rows();

     }
     function verfoto($id){
      $this->db->select('FOTO');
      $this->db->from("Choferes");
      $this->db->where('ID_CHOFER', $id); 
      $consulta  = $this->db->get();
      $resultado = $consulta->row();
      return  $resultado->FOTO;

     }

}
