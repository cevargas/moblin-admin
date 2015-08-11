<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| MENU
| -------------------------------------------------------------------
| Construcao do menu baseado no grupo do usuario
| 
| libraries/menu
| 
*/

class Menu {
	
	private $CI;
	
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
			   
	}
	
	//monta menu de acordo com o grupo do usuario
	public function menu(){
		
		//pega id do usuario da sessao
		$usuario_id = $this->CI->session->userdata('usuario_id');

		//busca usuario
		$usuario = $this->_em->getRepository('Entities\Usuarios')
							 ->findOneBy(array('id' => $usuario_id));

		//pega grupo do usuario				 
		$grupo_id = $usuario->getGrupo()->getId();

		//pega permissoes do grupo
		//$permissoes = $this->_em->getRepository('Entities\GruposPermissoes')
						   //->findByIdGrupo($grupo_id);					   

		//consulta os programas que o grupo tem acesso
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('gp', 'p'))
		   ->from('Entities\GruposProgramas', 'gp')
		   ->innerJoin('gp.idPrograma', 'p')
		   ->innerJoin('gp.idGrupo', 'g')
		   ->where('g.id = :grupo')
		   ->setParameters(array('grupo' => $grupo_id))
		   ->orderBy('p.id, p.parent, p.nome', 'ASC');

		$query = $qb->getQuery();
		$results = $query->getResult();
		
		$menu = array();

		foreach ($results as $r) {
			
			$menu[] = array('id' => $r->getIdPrograma()->getId(),
							'url'  => $r->getIdPrograma()->getUrl(), 
							'nome' => $r->getIdPrograma()->getNome(),
							'parent' => $r->getIdPrograma()->getParent());
		}
		
		$getMenu = $this->buildNavigation($menu, 0);
		
		$data_session_set = array('menu' => $getMenu);						  
		$this->CI->session->set_userdata($data_session_set);
	}
	
	function buildNavigation($items, $parent = NULL) {
		
		$hasChildren = false;
		$outputHtml = '<ul>%s</ul>';
		$childrenHtml = '';
	
		foreach($items as $item)
		{
			if ($item['parent'] == $parent) {
				$hasChildren = true;
				$childrenHtml .= '<li><a href="'.base_url().$item['url'].'">'.$item['nome'].'</a></li>';         
				$childrenHtml .= $this->buildNavigation($items, $item['id']);         
				$childrenHtml .= '</li>';           
			}
		}
	
		// Without children, we do not need the <ul> tag.
		if (!$hasChildren) {
			$outputHtml = '';
		}
	
		// Returns the HTML
		return sprintf($outputHtml, $childrenHtml);
	}  
}