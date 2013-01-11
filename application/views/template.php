<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Viddon - Tu Talento, Nuestra Pasión</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keyword" content="">

	<link href="<?php echo base_url()?>style/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/main.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/list-castings.css" rel="stylesheet">
 	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>	
	<script src="<?php echo base_url()?>js/bootstrap.js"></script>

</head>

<body>	
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) 
		{
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>

	<!-- Codigo para el boton de loggin de google -->
	<?php
		require_once OPENID;
		$openid = new LightOpenID(HOME);
		$openid->identity = 'https://www.google.com/accounts/o8/id';
		$openid->required = array(
					'contact/email',
					'pref/language',
					'namePerson'
					);
		$openid->returnUrl = HOME.'/user/login';
		$auth_url = $openid->authUrl();
	?>

	<div id="headercontent">
	    <div id="upperhalf">
		    <div class="row-fluid">
		    	<div class="span4 header-text-left">
					<ul>
					  <li> <a href="#">POSTULANTES</a></li>
					  <li> <a href="#">HUNTERS</a></li>
					</ul>
				</div>
				<div class="span5 offset3">
					<ul>
					<?php
						$id = $this->session->userdata('id');

						if($this->session->userdata('name') != FALSE)
						{
							$user = $this->session->userdata('name');
						}
						else if($this->session->userdata('email') != FALSE)
						{
							$user = $this->session->userdata('email');
						}
						else
							$user = "";

						if($id)
							echo "<li class='welcome-login'> Bienvenido ".anchor('user', $user).' '.anchor('user/logout',' (Cerrar sesión)');
						else
						{
							echo "<form action='".$auth_url."' method='POST'>";
							echo "<button id='login-button'/>";
							echo "</form>";
						}
					?>
					</ul>
				</div>
				
		    </div>	
	    </div>
		
		<div id="lowerhalf">
			<div class="row offset4">
		 		<a class="anchor-image-logo span4" href="<?php echo HOME?>" title="Volver a la Página Principal">
					<img class="image-logo" src="<?php echo base_url(); ?>img/Logo2.png"/>
				</a>
				<!--
				<form class="form-search offset2 span3">
			  		<input type="text" class="input-medium">
			  		<button type="submit" class="btn search-btn">Search</button>
				</form>
				-->
			</div>
		</div>
	</div>
	<?php $this->load->view($content); ?>
</body>

<footer>
<ul class="row first">
	<li class="span3 offset1 footer-logo">
		<a href="<?php echo HOME?>"><img src="<?php echo base_url(); ?>img/logo-footer.png"/></a>
	</li>
	<li class="span2 offset1">
		<ul id="que-es-viddon">
			<li>
				<p>¿QUÉ ES VIDDON?</p>
			</li>
			<li>
				<a href="<?php echo HOME?>/home/what_is">ENTÉRATE AQUÍ</a>
			</li>
		</ul>
	</li>
	<li class="span2">
		<ul id="siguenos">
			<li>
				<p>SÍGUENOS</p>
			</li>
			<li>
				<ul>
					<li><a href="http://www.facebook.com/pages/Viddoncom/499177723428347?ref=hl"><img src="<?php echo base_url(); ?>img/fb-logo.png"/></a></li>
					<li><a href="https://twitter.com/ViddonCom"><img src="<?php echo base_url(); ?>img/twitter-logo.png"/></a></li>
				</ul>
			</li>
		</ul>
	</li>
	<li class="span3">
		<ul id="contacto">
			<li >
				<p>CONTACTO</p>
			</li>
			<li>
				<ul>
					<li><p>Email: <a href="mailto:contacto@viddon.com"><img src="<?php echo base_url(); ?>img/contacto.png"/></a></p></li>
					<li><p>Dirección: <font color="#FF3D01">Las Violetas 2267</font></p></li>
					<li><p><font color="#FF3D01">Providencia, Santiago</font></p></li>
				</ul>
			</li>
		</ul>
	</li>
</ul>
<ul class"row">
	<li class="span8 offset1"><p class="second">Viddon - Copyright 2012</p></li>
</ul>
<ul class"row second">
	<li class="span4 offset1"><p class="second">Todos los derechos reservados | <a href="<?php echo base_url();?>docs/terms.pdf">Términos y condiciones</a></p></li>
</ul>
</footer>