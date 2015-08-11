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
	
	//$_em = Entity Manager, objeto de Conexao do Doctrine
	//libraries/Doctrine.php
	private $_em;

	public function __construct() {
		
		parent::__construct();
		
		$this->_em = $this->doctrine->em;

		//se nao tiver usuario logado redireciona para o login
		if($this->session->has_userdata('logged_in') === false) {
			redirect('admin', 'location', 301);
		}
	}
	
	public function index() {
		
		echo "Carregou a Dashboard";
		
		$data = array();
        $data['view'] = 'admin/home/index';
		
		//carrega menu para a sessao de acordo com o grupo do usuario
		//if($this->session->has_userdata('menu') === false) {
			$this->menu();
		//}
		
		$this->load->view('admin/index', $data);
	}
	
	//monta menu de acordo com o grupo do usuario
	public function menu (){
		
		//pega id do usuario da sessao
		$usuario_id = $this->session->userdata('usuario_id');

		//busca usuario
		$usuario = $this->_em->getRepository('Entities\Usuarios')
							 ->findOneBy(array('id' => $usuario_id));

		//pega grupo do usuario				 
		$grupo_id = $usuario->getGrupo()->getId();

		//pega permissoes do grupo
		//$permissoes = $this->_em->getRepository('Entities\GruposPermissoes')
						   //->findByIdGrupo($grupo_id);

		$qb = $this->_em->createQueryBuilder();
		$qb->select(array('gp', 'p'))
		   ->from('Entities\GruposProgramas', 'gp')
		   ->innerJoin('gp.idPrograma', 'p')
		   ->innerJoin('gp.idGrupo', 'g')
		   ->where('g.id = :grupo')
		   //->andWhere('p.parent = :parent')
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
		
		$getMenu = $this->formatMenu($menu, 0);
		
		echo "<pre>";
		print_r($getMenu);		
		exit;
		
		//$data_session_set = array('menu' => $getMenu);						  
		//$this->session->set_userdata($data_session_set);
	}
	
	function formatMenu($menuArray=array(), $parent=0){
		
        $nmenu = array();
        foreach($menuArray as $i => $item){

            if($item['parent'] == $parent){
                $nmenu[$item['id']] = $item;
                $nmenu[$item['id']]['submenu'] = $this->formatMenu($menuArray, $item['id']);
            }
			
        }

        return $nmenu;
    }
}