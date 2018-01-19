<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Choferes extends CI_Controller {
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
			$this->load->view('choferes/nuevo');	 
			$this->load->view('footer');

		}else{
			$this->load->view('login');	
		}
	}
	public function Guardar(){
		if($this->session->userdata('ID')){
			$nombre   = $this->input->post('nombre');
			$dni      = $this->input->post('dni');
			$this->load->model('Choferes_model');
            $this->Choferes_model->Guardar_chofer($nombre, $dni);
		}else{
			$this->load->view('login');	
		}
	}
	public function mis_choferes()
	{
		if($this->session->userdata('ID')){
			$this->load->model('Choferes_model');
          	$choferes = $this->Choferes_model->Listar_chofer();	
            $datos = 	array("choferes" => $choferes);
			$this->load->view('header');
			$this->load->view('choferes/listado', $datos);	 
			$this->load->view('footer');
		}else{
			$this->load->view('login');	
		}
		
	}
	public function Editar($id){
		if($this->session->userdata('ID')){
			$this->load->model('Choferes_model');
			$chofer = $this->Choferes_model->Datos_chofer($id);	
			$datos = array("chofer" => $chofer);	
			$this->load->view('header');
			$this->load->view('choferes/editar', $datos);	 
			$this->load->view('footer');
		}else{
			$this->load->view('login');	
		}
	}
	public function Modificar(){
		if($this->session->userdata('ID')){
			$nombre   = $this->input->post('nombre');
			$dni      = $this->input->post('dni');	
			$id  = $this->input->post('id');
			$this->load->model('Choferes_model');
            $this->Choferes_model->Modificar_chofer($patente, $marca, $modelo, $anio, $licencia, $color, $id);
		}else{
			$this->load->view('login');	
		}
	}
	public function ver_detalle($id)
	{
		if($this->session->userdata('ID')){
			$this->load->model('Choferes_model');
			$datos_chofer 	   = $this->Choferes_model->Detalle_chofer($id);	
			$remises_asignados = $this->Choferes_model->Remises_asignados($id);	
			$datos  = array('chofer' => $datos_chofer, 'remises_asignados' => $remises_asignados);
			$this->load->view('header');
			$this->load->view('choferes/ver_detalle', $datos);	 
			$this->load->view('footer');
		}else{
			$this->load->view('login');	
		}
		
	}
		public function AsignarMovil($id)
	{
			$this->load->model('Remises_model');
          	$remises = $this->Remises_model->Listar_remis_asoc($id);	
            $datos = 	array("remises" => $remises, "id" => $id);
			$this->load->view('header');
			$this->load->view('Moviles/Asignar', $datos);	 
			$this->load->view('footer');
	}
	
	public function AsignaC($chofer, $remis){
		if($this->session->userdata('ID')){
			$this->load->model('Choferes_model');
            $this->Choferes_model->AsignaC($chofer, $remis);
            redirect('panel');
		}else{
			$this->load->view('login');	
		}
	}

		public function loginApp()
	{
		$dni = $this->input->post("DNI");
		$password = $this->input->post("password");
		$token = $this->input->post("token");
		$this->load->model("choferes_model");
		echo  $this->choferes_model->Login($dni, $password, $token);
	}
	public function CambiaClave()
	{
		$ID_CHOFER      =     $this->input->post("ID_CHOFER");
		$anterior = 	$this->input->post("anterior");
		$nueva	  = 	$this->input->post("nueva");
		$this->load->model("choferes_model");
		echo  $this->choferes_model->CambiaClave($ID_CHOFER, $anterior, $nueva);
	}

	public function ActualizaFoto()
        {
        	    $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 50000;
                $config['max_width']            = 5000;
                $config['max_height']           = 5000;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        echo $this->upload->display_errors();
                }
                else
                {
                        $this->load->model("choferes_model");
				  echo  $this->choferes_model->ActualizaFoto($this->input->post("id"), $this->upload->data());
                }

        }


	public function Descargafoto($id = 0)
	{
		$this->load->model("choferes_model");
		$fo =  $this->choferes_model->verFoto($id); 
		  header('Content-type: application/png');
		  header("Cache-Control: no-cache");
		  header("Pragma: no-cache");
		  header("Content-Disposition: inline;filename='img.png'");
		  header("Content-length: ".strlen($fo));
		  echo $fo;
		  exit();
	}
}


