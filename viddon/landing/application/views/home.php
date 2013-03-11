<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/s3slider.css" />
	<title>Viddon.com</title>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>/js/s3Slider.js" type="text/javascript"></script>
	
	<script type="text/javascript">	
		$(document).ready(function() { 
	    	$('#s3slider').s3Slider({
	        	timeOut: 4000
	    	});
		});
	</script>
	<script type="text/javascript">		
		function bottom(){
			document.getElementById('bottom').scrollIntoView();
		}
	</script>	
</head>

<body onload="bottom()">

<!-- Aqui va el logo worcast -->
<img class="logo" src="<?php echo base_url(); ?>/img/logo.png">

<!--Probar slider de imagenes-->
<div id="s3slider">
    <ul id="s3sliderContent">
        <li class="s3sliderImage">
            <img src="<?php echo base_url(); ?>/img/Imagen0.png">
			<span/>
        </li>
		<li class="s3sliderImage">
            <img src="<?php echo base_url(); ?>/img/Imagen1.png">
			<span/>
        </li>
		<li class="s3sliderImage">
            <img src="<?php echo base_url(); ?>/img/Imagen2.png">
        	<span/>
		</li>
		<li class="s3sliderImage">
            <img src="<?php echo base_url(); ?>/img/Imagen3.png">
        	<span/>
		</li>
        <div class="clear s3sliderImage"></div>
    </ul>
</div>
<!--Probar slider de imagenes-->

<!-- Aqui va el video -->
<!-- ><iframe src="http://player.vimeo.com/video/35863838?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;loop=1" width="525" --> <!-- height="295" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe><!-- Aqui va el formulario -->

<!-- Aqui va el texto -->
<p class="text">La nueva plataforma donde el <font color="#ffffff">video</font> será tu principal instrumento para 
	alcanzar tus <font color="#ffffff">sueños</font> y llegar donde jamás imaginaste.</p>

<p class="inscribete">Inscríbete! y podrás participar de nuestro primer concurso. Habrá un iPad2 de premio!!</p>

<?php echo form_open('home'); ?>
<p class="email-form" id="email-form">
	<label for="email" class="label">Ingresa tu e-mail</label>
	<input name="email" class="textbox" type="text" value="<?php echo set_value('email'); ?>" size="20" />
	<input class="submit-button" type="submit" value="Enviar" />
</p>
<div class="form-info">
	<?php echo form_error('email'); ?>
</div>
<div class="success">
	<?php echo $success; ?>
</div>
</form>

</body>
</html>
