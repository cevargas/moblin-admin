<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| MENU
| -------------------------------------------------------------------
| Construcao do menu baseado no grupo do usuario
| 
| libraries/Menu.php
| 
*/

class Menu {
	
	protected $CI;
	
	//$_em = Entity Manager, objeto de Conexao do Doctrine
	//libraries/Doctrine.php
	protected $_em;

	public function __construct() {
		
	   	$this->CI =& get_instance();
		
	   	$this->CI->load->helper('url');
		$this->CI->load->library('session');
		$this->CI->config->item('base_url');
		
		//carrega doctrine
		$this->CI->load->library('doctrine');		
		$this->_em = $this->CI->doctrine->em;
		
		log_message('debug', 'Menu Class Initialized');
			   
	}
	
	//monta menu de acordo com o grupo do usuario
	public function getMenu(){
		
		//pega id do usuario da sessao
		$usuario_id = $this->CI->session->userdata('usuario_id');

		//busca usuario
		$usuario = $this->_em->getRepository('Entities\Usuarios')
							 ->findOneBy(array('id' => $usuario_id));

		//pega grupo do usuario				 
		$grupo_id = $usuario->getGrupo()->getId();					   

		//consulta os programas que o grupo tem acesso
		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('gp', 'p'))
		   ->from('Entities\GruposProgramas', 'gp')
		   ->innerJoin('gp.idPrograma', 'p')
		   ->innerJoin('gp.idGrupo', 'g')
		   ->where('g.id = :grupo')
		   ->setParameters(array('grupo' => $grupo_id))                     
		   ->orderBy('p.parent, p.nome', 'ASC');

		$query = $qb->getQuery();
		$result = $query->getResult();

        $menu = $this->buildMenu($result);
		
		$data_session_set = array('menu' => $menu);						  
		$this->CI->session->set_userdata($data_session_set);
	}

	function buildMenu($items) {
		
		$html = '';
		$parent = 0;
		$parent_stack = array();
		
		// $items contains the results of the SQL query
		$children = array();
		foreach ( $items as $item )		
			$children[$item->getIdPrograma()->getParent()][] = $item;

		while ( ( $option = each( $children[$parent] ) ) || ( $parent > 0 ) )
		{
			if ( !empty( $option ) )
			{					

				// 1) The item contains children:
				// store current parent in the stack, and update current parent
				if ( !empty( $children[$option['value']->getIdPrograma()->getId()] ) )
				{
					$html .= '<li>';
					$html .= '<a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">'.$option['value']->getIdPrograma()->getNome().'</span>';
					$html .= '<span class="fa arrow"></span></a>';
					
					if($parent == 0) 				
						$html .= '<ul class="nav nav-second-level">'; 
					else 
						$html .= '<ul class="nav nav-third-level">'; 
					
					array_push( $parent_stack, $parent );
					$parent = $option['value']->getIdPrograma()->getId();
				}
				// 2) The item does not contain children
				else
					$html .= '<li><a href="#">' . $option['value']->getIdPrograma()->getNome() . '</a></li>';
			}
			// 3) Current parent has no more children:
			// jump back to the previous menu level
			else
			{
				$html .= '</ul></li>';
				$parent = array_pop( $parent_stack );
			}
		}
		
		// At this point, the HTML is already built
		return $html;
	}

        
	/*
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
			}
		}
	
		// Without children, we do not need the <ul> tag.
		if (!$hasChildren) {
			$outputHtml = '';
		}
	
		// Returns the HTML
		return sprintf($outputHtml, $childrenHtml);
	} 
	*/ 	
}