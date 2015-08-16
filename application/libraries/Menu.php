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
	public function getMenuParent($parent = 0){
		
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
                   ->andWhere('p.parent = :parent')
		   ->setParameters(array('grupo' => $grupo_id, 'parent' => $parent))                     
		   ->orderBy('p.id, p.parent, p.nome', 'ASC');

		$query = $qb->getQuery();
		$result = $query->getResult();

                $menu = $this->getMenuChildrens($result);
		
                echo '<pre>';
		print_r($menu);
                exit;
		
		//$data_session_set = array('menu' => $getMenu);						  
		//$this->CI->session->set_userdata($data_session_set);
	}

        /*
         * TEM QUE VER AGORA COMO ADD OS ULs e LIs do menu
         */
        public function getMenuChildrens($parents) {
            
            $std = new stdClass();
                     
            foreach($parents as $key => $parent) {
                
                $menu = new stdClass();
                
                $qb = $this->_em->createQueryBuilder();
		$qb->select(array('p'))
		   ->from('Entities\Programas', 'p')
                   ->andWhere('p.parent = :parent')
		   ->setParameters(array('parent' => $parent->getIdPrograma()->getId()))                     
		   ->orderBy('p.nome', 'ASC');

		$query = $qb->getQuery();
		$result = $query->getResult();
 
                $menu->parent[$key] = $parent->getIdPrograma();
                $menu->parent[$key]->childrens[$key] = $result;
                                
                foreach($result as $k => $v) {

                    $qb = $this->_em->createQueryBuilder();
                    $qb->select(array('p'))
                       ->from('Entities\Programas', 'p')
                       ->andWhere('p.parent = :parent')
                       ->setParameters(array('parent' => $v->getId()))                 
                       ->orderBy('p.nome', 'ASC');

                    $q = $qb->getQuery();
                    $r = $q->getResult();

                    if($r) {
                       $menu->parent[$key]->childrens[$key][$k]->child[$k] = $r;
                    }
                }
                
                $std->menu[$key] = $menu;
            }

            return $std;
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