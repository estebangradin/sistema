<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moviles extends CI_Controller {
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
			$this->load->view('moviles/nuevo');	 
			$this->load->view('footer');

		}else{
			$this->load->view('login');	
		}
	}
	public function Guardar(){
		if($this->session->userdata('ID')){
			$marca    = $this->input->post('marca');
			$modelo   = $this->input->post('modelo');
			$anio     = $this->input->post('anio');
			$color    = $this->input->post('color');
			$patente  = $this->input->post('patente');
			$licencia = $this->input->post('licencia');
			$this->load->model('Remises_model');
            $this->Remises_model->Guardar_remis($patente, $marca, $modelo, $anio, $licencia, $color);
		}else{
			$this->load->view('login');	
		}
	}
	public function mis_moviles()
	{
		if($this->session->userdata('ID')){
			$this->load->model('Remises_model');
          	$remises = $this->Remises_model->Listar_remis();	
            $datos = 	array("remises" => $remises);
			$this->load->view('header');
			$this->load->view('moviles/listado', $datos);	 
			$this->load->view('footer');
		}else{
			$this->load->view('login');	
		}
		
	}
	public function Editar($id){
		if($this->session->userdata('ID')){
			$this->load->model('Remises_model');
			$remis = $this->Remises_model->Datos_remis($id);	
			$datos = array("remis" => $remis);	
			$this->load->view('header');
			$this->load->view('moviles/editar', $datos);	 
			$this->load->view('footer');
		}else{
			$this->load->view('login');	
		}
	}
	public function Modificar(){
		if($this->session->userdata('ID')){
			$marca    = $this->input->post('marca');
			$modelo   = $this->input->post('modelo');
			$anio     = $this->input->post('anio');
			$color    = $this->input->post('color');
			$patente  = $this->input->post('patente');
			$licencia = $this->input->post('licencia');
			$id  = $this->input->post('id');
			$this->load->model('Remises_model');
            $this->Remises_model->Modificar_remis($patente, $marca, $modelo, $anio, $licencia, $color, $id);
		}else{
			$this->load->view('login');	
		}
	}
	public function ver_detalle($id)
	{
		if($this->session->userdata('ID')){
			$this->load->model('Remises_model');
			$remis 		= $this->Remises_model->Datos_remis($id);	
			$choferes 	= $this->Remises_model->Choferes_asignados($id);
			$this->load->view('header');
			if (count($remis) == 0){
				$this->load->view('404');	 
			}else{
				$datos  	= array('remis' => $remis, 'choferes' => $choferes);
				$this->load->view('moviles/ver_detalle', $datos);	 	
			}
			$this->load->view('footer');
		}else{
			$this->load->view('login');	
		}
		
	}
	public function ConsultarViaje($codigo)
	{
		if($this->session->userdata('ID')){
			$this->load->model('Remises_model');
			$remis 		= $this->Remises_model->Datos_remis($id);	
			$choferes 	= $this->Remises_model->Choferes_asignados($id);
			$this->load->view('header');
			if (count($remis) == 0){
				$this->load->view('404');	 
			}else{
				$datos  	= array('remis' => $remis, 'choferes' => $choferes);
				$this->load->view('moviles/ver_detalle', $datos);	 	
			}
			$this->load->view('footer');
		}else{
			$this->load->view('login');	
		}
		
	}
	
}


