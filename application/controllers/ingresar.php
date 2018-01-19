<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ingresar extends CI_Controller {

	public function index()
	{

		if($this->session->userdata('ID_USUARIO')){
			$this->load->view('index');	 
		}else{
			$this->load->view('login');	
		}
		
		
	}
	public function Login()
	{
	
	  $this->load->model('usuarios_model');
  	  $usuario = $this->usuarios_model->Login($this->input->post('USUARIO'), $this->input->post('PASSWORD'));
  
  	  if ($usuario){
  	  	 	$usuario_data = array(
  	  	 		'ID' 	 => $usuario->ID_USUARIO,
  	  	 		'NOMBRE' => $usuario->NOMBRE,
  	  	 		'LATITUD' => $usuario->LATITUD,
  	  	 		'LONGITUD' => $usuario->LONGITUD,
  	  	 		'ID_REMISERA' => $usuario->ID_REMISERA);
  	  	 	$this->session->set_userdata($usuario_data);
  			redirect('panel');
  	  }else{
  	  	 $datos = array('error' => 'Nombre de usuario o contraseña incorrectos');
          $this->load->view('login', $datos);	

  	  }
  	
	}
	public function olvide_mi_clave()
	{
		if($this->session->userdata('ID_USUARIO')){
			$this->load->view('index');	 
		}else{
			$this->load->view('olvide_mi_clave');	
		}
	}
}


