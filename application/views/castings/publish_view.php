<div class="content" id="content">
	<div class="container-fluid">
	  	<div class="row-fluid">
	    	<div class="span3 user-profile-left">
	    		<?php 
	    			echo "<img class='user_image' src='".HOME."/img/profile_hunter/hunter_1.jpg'/>";
	    		?>
	    		<div class="space4"></div>
	    		
	    		<div class="span9 offset1">
		    		<ul class="nav nav-pills nav-stacked orange">
					  <li><a href="<?php echo HOME."/hunter";?>"> <i class="icon-user"></i> Perfil</a></li>
					  <li class="active"><a> <i class="icon-pencil"></i> Nuevo Casting</a></li>
					  <li><a href="<?php echo HOME."/hunter/casting_list";?>"> <i class="icon-edit"></i> Mis Castings</a></li>
					</ul>
				</div>
	    	</div>
		    
		    <div class="span6 user-profile-right">
		    	
		    	<div class="space1"></div>
				<div class="space1"></div>
				<form class="form-horizontal">
					<fieldset>
					<legend><h2 class="profile-title"> Publicar un nuevo Casting </h2></legend>
					<div class="control-group">
						<label class="control-label">T&iacutetulo</label>
						<div class="controls">
							<input type="text" placeholder="Ingrese el título del Casting">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Imagen para mostrar</label>
						<div class="controls">
							<input type="file">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Descripci&oacuten o llamado a postular</label>
						<div class="controls">
							<textarea rows="5" placeholder="Una descripción o llamado a postular a la oferta: si te apasiona el espectáculo, cantas, etc ¡ésta es tu oportunidad!"></textarea>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Requerimientos</label>
						<div class="controls">
							<textarea rows="3" placeholder="Requerimientos para el casting: color de ojos, color de pelo, etc."></textarea>
						</div>
					</div>
					<label class="radio">
  						<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
  						Option one is this and that—be sure to include why it's great
					</label>
					</fieldset>
				</form>
			</div>
			<div class="span2 user-profile-lateral">
			</div>
		</div>
		
		<div class="row-fluid">	
			<div class="space4"></div>	
		</div>
		
		<div class="row-fluid">
			<div class="span7 offset3 user-profile-right">
							
			</div>
		</div>
  	</div>
  	<div class="space2"></div> 	
</div>