<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasajeros extends CI_Controller {
	public function index()
	{
			echo 'Forbidden';
	}
	public function Login()
	{
	  $imei = $this->input->post("imei");
	  $this->load->model('pasajeros_model');
  	  echo  $this->pasajeros_model->Login($imei);
  	}
  	public function Registrar()
	{
	  $imei     = $this->input->post("imei");
	  $nombre   = $this->input->post("nombre");
	  $apellido = $this->input->post("apellido");
	  $celular  = $this->input->post("telefono");
	  $email    = $this->input->post("email");
	  $data 	= ARRAY("IMEI"      => $imei, 
	  					"NOMBRE"    => $nombre,
	  					"APELLIDO"	=> $apellido,
	  					"CELULAR"	=> $celular,
	  					"EMAIL"		=> $email
	  					);
	  $this->load->model('pasajeros_model');
  	  echo  $this->pasajeros_model->registrar($data);
  	}

}


