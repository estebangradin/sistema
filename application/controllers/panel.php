<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('ID')){
			$this->load->model('Remises_model');
			$this->load->model('Choferes_model');
            $remises  = $this->Remises_model->Listar_remis2();
            $choferes = $this->Choferes_model->Listar_chofer();
            
            $datos    = array("remises" => $remises, "choferes" => $choferes);
			$this->load->view('header');
			$this->load->view('panel/index', $datos);	 
			$this->load->view('footer');
		}else{

			//$this->load->view('login');	
		//	print_r($_SESSION);
		}
		
	}
	
}


