<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>GRUPOS DE USUÁRIOS </h5>        
        <div class="pull-right">
        	<a href="<?php echo base_url()?>admin/grupos/novo"
            	class="btn btn-info btn-xs btn-bitbucket" 
            	data-toggle="tooltip" data-placement="top" title="Novo Grupo">
            	<i class="fa fa-asterisk"></i>&nbsp;Adicionar
            </a>
        </div>
    </div>
    
    <div class="ibox-content">    
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Opções</th>
            </tr>
            </thead>
            <tbody>
            <?php
			foreach($listar_grupos as $grupos):
            ?>
                <tr>
                    <td><?php echo $grupos->getId();?></td>
                    <td><?php echo $grupos->getNome();?></td>
                    <td><?php echo $grupos->getDescricao();?></td>
                    <td><?php echo ($grupos->getStatus() == 1) ? 'Ativo' : 'Inativo';?></td>
                    <td>
                    	<a href="<?php echo base_url()?>admin/grupos/editar/<?php echo $grupos->getId();?>" 
                        		class="btn btn-info btn-bitbucket btn-xs"
                                data-toggle="tooltip" data-placement="top" title="Editar">
                            		<i class="fa fa-wrench"></i>
                        </a>                        
                        <a href="<?php echo base_url()?>admin/grupos/excluir/<?php echo $grupos->getId();?>" 
                        		class="btn btn-info btn-bitbucket btn-xs" 
                            	data-toggle="tooltip" data-placement="top" title="Excluir">
                            		<i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
             <?php
			 endforeach;
			 ?>
            </tbody>
        </table>
    </div>
</div>