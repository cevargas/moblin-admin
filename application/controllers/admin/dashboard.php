<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Controlador da pagina inicial da area administrativa
class Dashboard extends CI_Controller {

	public function __construct() {
		
		parent::__construct();

		//se nao tiver usuario logado redireciona para o login
		if($this->session->has_userdata('logged_in') === false) {
			redirect('admin', 'location', 301);
		}
	}
	
	public function index() {
		
		echo "Carregou a Dashboard";
		
		$data = array();
        $data['view'] = 'admin/home/index';       
		$this->load->view('admin/dashboard', $data);
	}
}
