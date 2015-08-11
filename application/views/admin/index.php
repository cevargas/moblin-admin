

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

<?php $this->load->view($view);?>