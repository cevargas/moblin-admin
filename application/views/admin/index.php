<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Carlos Eduardo de Vargas">

    <title>Moblin Admin</title>
    
    <link href="<?php echo base_url()?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>public/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="<?php echo base_url()?>public/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?php echo base_url()?>public/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    
    <!-- iCheck -->
    <link href="<?php echo base_url()?>public/css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="<?php echo base_url()?>public/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url()?>public/css/style.css" rel="stylesheet">
    
    
    
</head>

<body>
    <div id="wrapper">    
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> 
                        	<span>
                           		<img alt="image" class="img-circle" src="<?php echo base_url()?>public/img/small_profile.jpg" />
                            </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> 
                                    <span class="block m-t-xs"> 
                                        <strong class="font-bold"><?php echo $this->session->userdata('usuario_nome');?></strong>
                                    </span> 
                                    <span class="text-muted text-xs block">Editar <b class="caret"></b></span> 
                                </span> 
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="<?php echo base_url()?>admin/usuarios/edit">Perfil</a></li>
                                <li><a href="<?php echo base_url()?>admin/logout">Sair</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            MO+
                        </div>
                    </li>
                    
                    <?php	
						//carrega o menu de acordo com o grupo/usuario
						$menu = new Menu; //libraries/menu
						echo $menu->getMenu();
					?>                        
                </ul>
            </div><!-- .sidebar-collapse -->
        </nav><!-- .navbar-default -->
       
        <div id="page-wrapper" class="gray-bg dashbard-1">
        
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Bem vindo a Moblin :: Área de Administração</span>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>admin/logout">
                                <i class="fa fa-sign-out"></i> Sair
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo (isset($programa)) ? $programa : "Dashboard";?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url()?>admin/dashboard">Home</a>
                        </li>
                        <?php if(isset($acao)) : ?>
                        <li>
                            <?php echo (isset($programa)) ? $programa : "Dashboard";?>
                        </li>
                        <li class="active">
                            <strong><?php echo (isset($acao)) ? $acao : "";?></strong>
                        </li>
                        <?php endif; ?>
                    </ol>
                </div>
                <div class="col-lg-2"></div>
            </div>

            <div class="row">            
                <div class="col-lg-12">                
                    <div class="wrapper wrapper-content">
                    
                       <div class="row">                       
                            <div class="col-lg-12">                            
                               <?php $this->load->view($view);?>
                            </div><!-- .col-lg-12 -->              
                        </div><!-- .row -->
                               
                        <div class="footer">
                            <div class="pull-right"></div>
                            <div>Moblin Web & Design &copy;2015</div>
                        </div><!-- .footer -->
                        
                    </div><!-- .wrapper .wrapper-content -->
                </div><!-- .col-lg-12 -->
			</div><!-- .row -->            
    	</div><!-- #page-wrapper -->        
	</div><!-- #wrapper --> 
    
    <!-- Mainly scripts -->
    <script src="<?php echo base_url()?>public/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url()?>public/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>public/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url()?>public/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="<?php echo base_url()?>public/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo base_url()?>public/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo base_url()?>public/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo base_url()?>public/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo base_url()?>public/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="<?php echo base_url()?>public/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?php echo base_url()?>public/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url()?>public/js/inspinia.js"></script>
    <script src="<?php echo base_url()?>public/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI DA PROBLEMA COM O TOOLTIP ****************
    <script src="<?php echo base_url()?>public/js/plugins/jquery-ui/jquery-ui.min.js"></script>-->

    <!-- GITTER -->
    <script src="<?php echo base_url()?>public/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="<?php echo base_url()?>public/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?php echo base_url()?>public/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS -->
    <script src="<?php echo base_url()?>public/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="<?php echo base_url()?>public/js/plugins/toastr/toastr.min.js"></script>
    
    <!-- iCheck -->
    <script src="<?php echo base_url()?>public/js/plugins/iCheck/icheck.min.js"></script>

    <script>
        $(document).ready(function() {
			
			<?php 
				if($this->session->flashdata('error_msg') != NULL) :
			?>
				setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error('<?php echo $this->session->flashdata('error_msg');?>', 'Alerta!');
	
				}, 1300);			
			<?php 
				endif; 
			?>
		});
    </script>
</body>
</html>