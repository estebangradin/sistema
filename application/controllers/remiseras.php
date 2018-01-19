<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remiseras extends CI_Controller {
	public function index()
	{

	
		
	}
	public function Listar(){
		$this->load->model('Remiseras_model');
		$remiseras = $this->Remiseras_model->listar();
		echo json_encode($remiseras);
	}
		public function max(){
		$this->load->model('Remiseras_model');
		$remiseras = $this->Remiseras_model->max();
		echo $remiseras->MAXS;
	}

}


