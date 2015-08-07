<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| CONTROLADOR DE LOGIN DA AREA ADMINISTRATIVA
| -------------------------------------------------------------------
| Especifica o controlador de login da area administrativa
| 
| controller/admin/login
| 
*/

class Login extends CI_Controller {
	
	//$_em = Entity Manager, objeto de Conexao do Doctrine
	//libraries/Doctrine.php
	private $_em;
	
	private $data = array();
	
	public function __construct() {
		
		parent::__construct();
		
		$this->load->helper('form');
		$this->load->library('form_validation');	
		$this->_em = $this->doctrine->em;
		
		//se tiver usuario logado, redireciona para dashboard
		if($this->session->has_userdata('logged_in') === true) {
			redirect('admin/dashboard', 'location', 301);
		}
	}
	
	public function index()
	{
		//seta validacoes
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_verificacao_login');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[5]');

		$this->form_validation->set_error_delimiters('<p class="bg-danger">', '</p>');
		
		//se NAO validar o login, retorna para o Formulario de login
  		if ($this->form_validation->run() == FALSE) {
			
        	$this->data['view'] = 'admin/login/index';
			$this->load->view('admin/index', $this->data);
			
		}
		else {
			//se validar o login, redireciona para dashboard
			redirect('admin/dashboard', 'location', 301);		
		}		
	}
	
	//validacao do login
	public function verificacao_login($email) {

		//criptografa
		$senha = do_hash($this->input->post('senha', true));

		try {
			//consulta no banco de dados se o usuario existe e se esta ativo	
			$usuario = $this->_em->getRepository('Entities\Usuarios')
								 ->findOneBy(array('email' => $email, 
											  	   'senha' => $senha,
											       'status' => 1));
												   
		} catch(Exception $e){
			log_message('error', $e->getMessage());
        }
		
		//se encontrar o usuario	
		if(isset($usuario)) {
						
			//seta paramentros de sessao
			$data_session_set = array('logged_in' => $usuario);								  
			$this->session->set_userdata($data_session_set);
			return true;
			
		}
		else {
			$this->form_validation->set_message('verificacao_login', 'Usuário ou Senha inválidos!');
			return false;
		}
    }
}