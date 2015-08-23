<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| CONTROLADOR DE GRUPOS
| -------------------------------------------------------------------
| Especifica o controlador de administracao de grupos da
| area de administracao
|
| controller/admin/grupos
| 
*/

class Grupos extends CI_Controller {
	
	//$_em = Entity Manager, objeto de Conexao do Doctrine
	//libraries/Doctrine.php
	private $_em;
	
	public function __construct() {
		
		parent::__construct();

		//se nao tiver usuario logado redireciona para o login
		if($this->session->has_userdata('logged_in') === false) {
			redirect('admin', 'location', 301);
		}
		//verifica se o grupo do usuario tem permissao para acessar o controlador, carrega no controller login
		if($this->acl->has_perm() == false) {
			$this->set_error('Você não possui permissão para acessar '. strtoupper($this->uri->segment(2, 0)));
		}
		
		$this->_em = $this->doctrine->em;
	}	
	
	public function index() {
		$grupos = $this->listar();
	}
	
	public function listar() {
		
		$grupos = $this->_em->getRepository('Entities\Grupos')
							 ->findBy(array('id' => $this->session->userdata('grupo_id')));
		
		$data = array();
		$data['programa'] = 'Grupos';
		$data['acao'] = 'Lista de Grupos';
        $data['view'] = 'admin/grupos/listar'; 
		$data['listar_grupos'] = $grupos;
		$this->load->view('admin/index', $data);
	}
	
	public function novo() {
		$data['programa'] = 'Grupos';
		$data['acao'] = 'Adicionar Novo Grupo';
		$data['view'] = 'admin/grupos/form'; 
		$this->load->view('admin/index', $data);
	}
	
	public function editar($id = NULL) {
		
		if(trim(is_numeric($id))) {
		
			$grupo = $this->_em->getRepository('Entities\Grupos')
								 ->findOneBy(array('id' => $id));	
								 
			if(!$grupo) {
				$this->set_error();	
			}					 
			
			$data['programa'] = 'Grupos';
			$data['acao'] = 'Editar de Grupo';
			$data['view'] = 'admin/grupos/form'; 
			$data['grupo'] = $grupo;
			$this->load->view('admin/index', $data);
		}
		else {
			$this->set_error();	
		}
	}
	
	public function salvar() {
		
		//implementar o salvar
	}
	
	public function excluir($id) {
		
		if(trim(is_numeric($id))) {
			
			$grupo = $this->_em->getRepository('Entities\Grupos')
							 ->findOneBy(array('id' => $this->session->userdata('grupo_id')));
			
			//testa se o grupo existe			
			if($grupo) {
			
				//testa se o grupo pode ser excluir
				if($grupo->getRestricao() == 1) {
					$this->set_error("Grupo não pode ser excluído!");
				}			
				//testa se o grupo tem usuarios vinculados
				
				
			}
			
		}
	}
	
	public function set_error($mensagem = NULL) {
		
		if(!$mensagem)
			$mensagem = 'Dados inválidos!';
		
		$this->session->set_flashdata('error_msg', $mensagem);
		redirect('admin/grupos', 'refresh');		
	}	
}