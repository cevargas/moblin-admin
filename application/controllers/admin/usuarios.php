<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| CONTROLADOR DE USUARIOS
| -------------------------------------------------------------------
| Especifica o controlador de administracao de usuarios da
| area de administracao
|
| controller/admin/usuarios
| 
*/

class Usuarios extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		echo "chegou ao controller do usuario";		
		
		//se nao tiver usuario logado redireciona para o login
		if($this->session->has_userdata('logged_in') === false) {
			redirect('admin', 'location', 301);
		}
	}	
	
	public function index() {
		
		echo "Carregou usuarios";
		
		$data = array();
        $data['view'] = 'admin/usuarios/index'; 		
		$this->load->view('admin/index', $data);
	}
}