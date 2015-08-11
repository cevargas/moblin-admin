

<br />
view dashboard
<br />
<a href="<?php echo base_url()?>admin/logout">Sair</a>
<br />

============================================================================================

<ul>

<?php


	if($this->session->userdata('menu')):
		foreach($this->session->userdata('menu') as $key => $menu):
		?>
			<li><a href="<?php echo base_url()?><?php echo $menu["url"];?>"><?php echo $menu["nome"];?></a></li>
		<?php
		endforeach;
	endif;
	
?>

</ul>

<br />

============================================================================================

<br />

<?php $this->load->view($view);?>