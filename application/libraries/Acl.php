<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| ACL
| -------------------------------------------------------------------
| Controle de Permissoes de acesso por grupo / usuario
| 
| libraries/Acl.php
| 
*/

class Acl {
		
	protected $CI;	
	
	//$_em = Entity Manager, objeto de Conexao do Doctrine
	//libraries/Doctrine.php
	private $_em;

	public function __construct() {
		
	   	$this->CI =& get_instance();
		
	   	$this->CI->load->helper('url');
		$this->CI->load->library('session');
		$this->CI->config->item('base_url');
		
		//carrega doctrine
		$this->CI->load->library('doctrine');		
		$this->_em = $this->CI->doctrine->em;
		
		log_message('debug', 'ACL Class Initialized');
			   
	}
	
	//monta menu de acordo com o grupo do usuario
	public function getPermissions(){
		
		//pega grupo do usuario				 
		$grupo_id = $this->CI->session->userdata('grupo_id');

		//pega permissoes do grupo
		$permissoes = $this->_em->getRepository('Entities\GruposPermissoes')
						   ->findAll(array('idGrupo' => $grupo_id));
						   
		if($permissoes) {		
			$arr = array();
			foreach($permissoes as $key => $val) {
				
				//$this->_config[$key]['id'] = $val->getIdPermissao()->getId();			
				$arr[$val->getIdPermissao()->getId()] = $val->getIdPermissao()->getControlador();
				//$this->_config[$key]['chave'] = $val->getIdPermissao()->getChave();
				//$this->_config[$key]['descricao'] = $val->getIdPermissao()->getDescricao();				
			}
				
			$data_session_set = array('permissoes' => $arr);				  
			$this->CI->session->set_userdata($data_session_set);
			
		}
		else {
			log_message('debug', 'Sem permissoes definidas em Entities\GruposPermissoes');
			exit("403 Forbidden");
		}
	}
	
	public function has_perm() {
		
		if($this->CI->session->userdata('permissoes')) {
			$perms = $this->CI->session->userdata('permissoes');
			
			if (in_array($this->CI->uri->segment(2, 0), $perms)) { 
				return true;
			}
			else {
				return false;
			}
		}
		log_message('debug', 'Session de permissoes nao retornou valor');
		exit("403 Forbidden");
	}	
}