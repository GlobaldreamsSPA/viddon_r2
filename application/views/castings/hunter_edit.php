<div class="content" id="content">
	<div class="container-fluid">
	  	<div class="row">
	  		<div class="span9">
	  			<div  style="border-radius: 5px; padding: 25px;" class="row-fluid">
		  			<div class="row-fluid">		
				    	<div class="span3 user-profile-left">
				    		<?php 
				    			if(isset($update_values) && file_exists(APPPATH.'/../img/logo_hunter/'.$update_values['image_profile']) == TRUE)
				    				echo "<img class='user_image' src='".HOME.'/img/logo_hunter/'.$update_values['image_profile']."'/>";
				    			else
				    				echo "<img class='user_image' src='".HOME."/img/logo_hunter/talent.jpg'/>";
				    		?>
				    		<div class="space4"></div>
				    		
				    		<div class="span9 offset1">
					    		<ul class="nav nav-pills nav-stacked orange">
								  	<li><a href="<?php echo HOME."/hunter";?>"> <i class="icon-user"></i> Perfil</a> </li>
								  	<li><a href="<?php echo HOME."/hunter/publish";?>"> <i class="icon-pencil"></i> Nuevo Casting</a></li>
									<li class="active"><a> <i class="icon-edit"></i> Mis Castings</a></li>
									<li><a href="<?php echo HOME."/hunter/logout";?>"> <i class="icon-off"></i> Cerrar Sesi&oacuten</a></li>					
								</ul>
							</div>
				    	</div>
					    
					    <div class="span9 user-profile-right">

							<div class="space1"></div>
								<Legend><h3>Identificaci&oacuten Empresa/Agencia</h3></Legend>
								<div  style="margin-left: 20px;">
								<h5>Nombre Empresa</h5>
								<div class="space05"></div>
								<input type="text" class="span5" placeholder="Nombre Empresa/Agencia" value="<?php if(isset($update_values)) echo $update_values["name"]; else echo set_value('name');?>" name="name">
								<?php echo form_error('name'); ?>
								<h5>Correo de Contacto</h5>
								<div class="space05"></div>
								<input type="text" class="span5" placeholder="Correo Contacto" value="<?php if(isset($update_values)) echo $update_values["email"]; else echo set_value('email');?>" name="name">
								<?php echo form_error('email'); ?>
															
								<div style="margin-left: -15px; margin-top: -20px;" id="image_upload">
									<h5>Logo Corporativo</h5>
									<div class="space05"></div>
									<?php echo form_upload(array('name' => 'image_profile','id'=> 'file')); ?>
									<?php 
										  echo form_hidden('image','');
										  echo form_error('image'); 
									?>
								</div>
								
								<div class="space2"></div>
								
								<h5>Nosotros</h5>
								<div class="space05"></div>
								<textarea class="rich_textarea" name="us"><?php if(isset($update_values)) echo $update_values["bio"]; else echo set_value('bio');?></textarea>
								<?php echo form_error('us'); ?>
								
								<h5>Buscamos</h5>
								<div class="space05"></div>
								<textarea class="rich_textarea" name="looking_for"><?php if(isset($update_values)) echo $update_values["hobbies"]; else echo set_value('hobbies');?></textarea>
								<?php echo form_error('looking_for'); ?>
								<div class="space2"></div>
									<button class="btn btn-primary" type="submit"> Guardar Datos </button>
								</form>
								<div class="space4"></div>
							</div>
						</div>
					</div>
					<div class="row-fluid">	
						<div class="space4"></div>	
					</div>
		
			  	</div>
			 </div>
		
			<div class="span4">
				<div class="span3">
					<div  style="border-radius: 5px; padding: 35px; min-width: 290px;" class="row-fluid">
						<h3 id="profile"> Estado Castings </h3>
						<div class="row">
							<div class= "span6">
								<h4 class="list-view-title">Casting A1</h3>
							</div>
							<div class= "span6">
								<div id="time">Quedan 102 d&iacuteas</div>
							</div>
						</div>
						<div class="progress">
						    <div class="bar bar-danger" style="width: 20%;">20%</div>
						</div>
						<div class="space3"></div>
						<div class="progress">
						  	<div class="bar bar-danger" style="width: 0%;">0%</div>
						</div>
						
						<div class="row">
							<div class= "span6">
								<h4 class="list-view-title">Casting A2</h3>
							</div>
							<div class= "span6">
								<div id="time">Quedan 120 d&iacuteas</div>
							</div>
						</div>
						<div class="progress">
						    <div class="bar bar-danger" style="width: 30%;">30%</div>
						</div>
						<div class="space3"></div>
						<div class="progress">
						  	<div class="bar bar-danger" style="width: 0%;">0%</div>
						</div>
						
						<div class="row">
							<div class= "span6">
								<h4 class="list-view-title">Casting B</h3>
							</div>
							<div class= "span6">
								<div id="time">Quedan 72 d&iacuteas</div>
							</div>
						</div>
						<div class="progress">
						    <div class="bar bar-warning" style="width: 45%;">45%</div>
						</div>
						<div class="space3"></div>
						<div class="progress">
						  	<div class="bar bar-danger" style="width: 0%;">0%</div>
						</div>
						
						<div class="row">
							<div class= "span6">
								<h4 class="list-view-title">Casting C</h3>
							</div>
							<div class= "span6">
								<div id="time">Quedan 12 d&iacuteas</div>
							</div>
						</div>
						<div class="progress">
						    <div class="bar bar-success" style="width: 85%;">85%</div>
						</div>
						<div class="space3"></div>
						<div class="progress">
						  	<div class="bar bar-danger" style="width: 0%;">0%</div>
						</div>
						
						<div class="row">
							<div class= "span6">
								<h4 class="list-view-title">Casting D</h3>
							</div>
							<div class= "span6">
								<div id="time">Quedan 0 d&iacuteas</div>
							</div>
						</div>
						<div class="progress">
						    <div class="bar bar-success" style="width: 100%;">100%</div>
						</div>
						<div class="space3"></div>
						<div class="progress">
						  	<div class="bar bar-danger" style="width: 10%;">10%</div>
						</div>

						<div class="row">
							<div class= "span6">
								<h4 class="list-view-title">Casting E</h3>
							</div>
							<div class= "span6">
								<div id="time">Quedan 0 d&iacuteas</div>
							</div>
						</div>
						<div class="progress">
						    <div class="bar bar-success" style="width: 100%;">100%</div>
						</div>
						<div class="space3"></div>
						<div class="progress">
						  	<div class="bar bar-warning" style="width: 50%;">50%</div>
						</div>
						
						<div class="space2"></div>
						<div class="space05"></div>
						
					</div>
				</div>
			</div>
		
		</div>
	</div>
</div>