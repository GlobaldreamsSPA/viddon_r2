<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Welcome to viddon</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keyword" content="">

	<link href="<?php echo base_url()?>style/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/main.css" rel="stylesheet">
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
	
	<script src="js/bootstrap.js"></script>
	<div id="headercontent">
	    
	    <div id="upperhalf">
		    <div class="row-fluid">
		    	
		    	<div class="span4">
					<ul>
					  <li> <a href="#">POSTULANTES</a></li>
					  <li> <a href="#">HUNTERS</a></li>
					</ul>
				</div>
				
				<div class="span4 offset4">
					<ul>
					  <li> <?php if(isset($username)) echo "Bienvenido ".$username.' <a href="#">(cerrar sesion)</a>';?> </li>
					</ul>
				</div>
				
		    </div>	
	    </div>
		
		<div id="lowerhalf">
		 	<div>
				<img src="<?php echo  base_url(); ?>img/Logo.png">
				<form class="form-search">
			  		<input type="text" class="input-medium search-query">
			  		<button type="submit" class="btn">Search</button>
				</form>
			</div>
		</div>
	</div>
</body>