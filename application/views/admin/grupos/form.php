<div class="ibox-content">
   	<?php echo form_open( base_url( 'admin/grupos/salvar' ), array( 'id' => 'form-grupos', 'method' => 'post', 'class' => 'form-horizontal', 'role' =>'form' ) ); ?>

	<?php 
		if(strlen(validation_errors()) > 0):
		?>
        	<div class="alert alert-danger">	
				<?php echo validation_errors(); ?>
            </div>
		<?php
		endif;	
	?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Nome</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="nome" name="nome" 
                	placeholder="Nome" value="<?php echo (isset($grupo)) ? $grupo->getNome() : set_value('nome');?>">
            </div>
        </div>    
        
        <div class="form-group">
        	<label class="col-sm-2 control-label">Descrição</label>
            <div class="col-sm-6">
            	<input type="text" class="form-control" id="descricao" name="descricao"
                	placeholder="Descrição" value="<?php echo (isset($grupo)) ? $grupo->getDescricao() : set_value('descricao');?>">
            </div>
        </div>
        
		<div class="form-group">
        	<label class="col-sm-2 control-label">Ativo</label>
			<div class="col-sm-6">            	
            	<label class="checkbox-inline i-checks">
                	<input type="checkbox" 
                        value="<?php echo (isset($grupo)) ? $grupo->getStatus() : set_value('status');?>" 
                        id="status"
                        name="status"
                         <?php echo (isset($grupo) and $grupo->getStatus() == 1) ? "checked" : "";?>>
                </label>               
            </div>
        </div>
        
        <div class="hr-line-dashed"></div>
        
        <div class="form-group">        	
            <div class="col-sm-offset-2 col-sm-8">            
            	 <button type="submit" class="btn btn-primary">Salvar</button>
                 <a href="<?php echo base_url()?>admin/grupos" class="btn btn-white ">Voltar</a>
            </div>
        </div>

	</form>
    
    <?php echo form_close();?>
</div>