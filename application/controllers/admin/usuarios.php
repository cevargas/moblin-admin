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
		
		//se nao tiver usuario logado redireciona para o login
		if($this->session->has_userdata('logged_in') === false) {
			redirect('admin', 'location', 301);
		}
		//verifica se o grupo do usuario tem permissao para acessar o controlador
		if($this->acl->has_perm() == false) {
			$this->session->set_flashdata('error_msg', 'Você não possui permissão para acessar '. $this->uri->segment(2, 0));
			redirect('admin/dashboard', 'refresh');
		}
	}	
	
	public function index() {
		$data = array();
		$data['programa'] = 'Usuários';
		$data['acao'] = 'Listar';
        $data['view'] = 'admin/usuarios/index'; 		
		$this->load->view('admin/index', $data);
	}
}