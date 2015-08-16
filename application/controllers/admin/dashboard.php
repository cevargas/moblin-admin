<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| CONTROLADOR DA DASHBOARD
| -------------------------------------------------------------------
| Especifica o controlador inicial da area administrativa
| 
| controller/admin/dashboard
| 
*/

class Dashboard extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();

		//se nao tiver usuario logado redireciona para o login
		if($this->session->has_userdata('logged_in') === false) {
			redirect('admin', 'location', 301);
		}
	}
	
	public function index() {

		$data = array();
                $data['view'] = 'admin/home/index';

		//carrega menu para a sessao de acordo com o grupo / usuario
		if($this->session->has_userdata('menu') === false) {
			$menu = new Menu; //libraries/menu
			$menu->getMenuParent();			
		}
		
		//carrega lista de permissoes do grupo / usuario
		if($this->session->has_userdata('permissoes') === false) {
			$permissoes = new Acl;
			$permissoes->getPermissions();	
		}
		
		$this->load->view('admin/index', $data);
	}	
}