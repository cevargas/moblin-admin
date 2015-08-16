

<br />
view dashboard
<br />
<a href="<?php echo base_url()?>admin/logout">Sair</a>
<br />

============================================================================================

<?php


	if($this->session->userdata('menu')):
		echo $this->session->userdata('menu');
	endif;
	
?>

<br />

============================================================================================

<br />

<?php 
if($this->session->flashdata('error_msg') != NULL) :
	echo $this->session->flashdata('error_msg');
endif; 
?>

<?php $this->load->view($view);?>