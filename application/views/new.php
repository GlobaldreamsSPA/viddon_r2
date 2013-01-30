<div id="error" class="modal hide fade in">
<div class="modal-header">
<a class="close" data-dismiss="modal">�</a>  
</div>
<div class="modal-body">
<h4>Aviso</h4>
<p><?php if(isset($postulation_message)) echo $postulation_message; ?></p>              
</div>
<div class="modal-footer">
<?php echo anchor(HOME,'Volver al Home',"class='btn btn-green'"); ?>
<a href="#" class="btn" data-dismiss="modal">Volver al Perfil</a>
</div>
</div>

<div class="content" id="content">
	<div class="container-fluid">
	  	<div class="row">
	  		<div class="span9">
	  			<div  style="border-radius: 25px; padding: 25px;" class="row-fluid">
		  			<div class="row-fluid">		
				    	<div class="span3 user-profile-left">
				    		<?php 
				    			if(isset($update_values) && file_exists(APPPATH.'/../img/profile/'.$update_values['image_profile']) == TRUE)
				    				echo "<img class='user_image' src='".HOME.'/img/profile/'.$update_values['image_profile']."'/>";
				    			else
				    				echo "<img class='user_image' src='".HOME."/img/profile/user.jpg'/>";
				    		?>
							<?php 
							
							if(!$public) {?>
							<form action="" method="POST">
								<?php if($postulation_flag) {?>
								<button id="participate_button" class="btn btn-large btn-success" type="submit" name="apply">POSTULAR CASTINGS</button>
								<input type="hidden" name="validate" value="1"/>
								<?php } else{ ?>
								<button data-toggle="modal" id="participate_button" href="#error" class="btn btn-success btn-large">POSTULAR CASTINGS</button>
				    			<?php } ?>
				    		</form>
				    		<?php } ?>
				    		
				    		<div class="span9 offset1">
				    			<div class="space4"></div>
					    		<ul class="nav nav-pills nav-stacked orange">
									<li><a href="<?php echo HOME."/user";?>"> <i class="icon-user"></i> Perfil</a>
									</li>
									<li class="active"><a> <i class="icon-pencil"></i> Editar Datos</a></li>
									<li>
										<a data-toggle="collapse" href="#collapseOne">
											<i class="icon-star-empty"></i> Postulaciones
										</a>
										<div id="collapseOne" class="collapse">
											<ul style="padding-left: 30px;" class="nav nav-pills nav-stacked orange">
												<li><a href="<?php echo HOME;?>./user/active_casting_list">Activas</a></li>	
												<li><a href="<?php echo HOME;?>./user/results_casting_list">Resultados</a></li>	
											</ul>
										</div>
									</li>	
									<li><a href="<?php echo HOME."/user/logout";?>"> <i class="icon-edit"></i> Cerrar Sesi&oacuten</a></li>					
								</ul>
							</div>
				    	</div>
				    
					    <div class="space2"></div>
						<?php 
						if (isset($update_values)) $flag="/update123";
						else 
							$flag = "";
						
						echo form_open_multipart('user/edit'.$flag); ?>
		
						<!-- Texto -->
						<div class="span8 offset1">
							<h3>Quien eres</h3>
							<input type="text" class="span7" placeholder="Escribe tu Nombre Aqui" value="<?php if(isset($update_values)) echo $update_values["name"]; else echo set_value('name');?>" name="name">
							<?php echo form_error('name'); ?>
							<h5>¿C&uacuteal es tu sexo?</h5>
							<select class="span4" name="sex">
								<option value="0" <?php if(isset($update_values) && $update_values["sex"]==0) echo "selected='selected'";?>>Femenino</option>
								<option value="1"  <?php if(isset($update_values) && $update_values["sex"]==1) echo "selected='selected'";?>>Masculino</option>
							</select>
							<h5>¿Y tu edad?</h5>
								<?php
								if(isset($update_values)) $age_set=$update_values["age"]; else $age_set=18; 
								echo form_dropdown('age', $age, $age_set, "class='span4'") ?> <br/>
							
							<div style="margin-left: -20px; margin-top: -20px;" id="image_upload">
								<h5>Sube tu foto</h5>
								<?php 
									/*<img src="<?php echo base_url(); ?>img/profile/<?php if(isset($update_values)) echo $update_values["image_profile"]; else echo "user.jpg"; ?>" class="img-polaroid">*/
									echo form_upload(array('name' => 'image_profile','id'=> 'file'));
									  
								?>
								<?php 
									  echo form_hidden('image','');
									  echo form_error('image'); 
								?>
							</div>
							
							<div class="space1"></div>
							
							<h3>Selecciona tus habilidades</h3>
								<?php 
								$skill_selected= array();
								for ($i=0; $i<3; $i++)
								{
									if(isset($update_user_skills[$i]))
										$skill_selected[$i]=$update_user_skills[$i];
									else 
										$skill_selected[$i]=0;
										
								}
								echo form_dropdown('skills1', $skills, $skill_selected[0],"class='span3'"); 
								echo form_dropdown('skills2', $skills, $skill_selected[1],"class='span3'"); 
								echo form_dropdown('skills3', $skills, $skill_selected[2],"class='span3'"); 
								?>
							<h3>Bio</h3>
								<textarea class="rich_textarea" name="bio"><?php if(isset($update_values)) echo $update_values["bio"]; else echo set_value('bio');?></textarea>
								<?php echo form_error('bio'); ?>
							<h3>Hobbies</h3>
								<textarea class="rich_textarea" name="hobbies"><?php if(isset($update_values)) echo $update_values["hobbies"]; else echo set_value('hobbies');?></textarea>
								<?php echo form_error('hobbies'); ?>
							<h3>Mi Sueño</h3>
								<textarea class="rich_textarea" name="dreams"><?php if(isset($update_values)) echo $update_values["dreams"]; else echo set_value('dreams');?></textarea>
								<?php echo form_error('dreams'); ?>
							<div class="space2"></div>
								<button class="btn btn-primary" type="submit"> Guardar Datos </button>
							</form>
							<div class="space4"></div>
						</div>
					
					</div>
				</div>
			</div>	
		
			<div class="span4">
				<div class="span3">
					<div  style="border-radius: 25px; padding: 35px; min-width: 290px;" class="row-fluid">
						<h3 id="profile" >Casting recomendado</h3>
						<img style="margin-top: 16px;" src="<?php echo HOME.'/img/casting_image/mini_banner_c1.png';?>">
		  				<div class="space2"></div>
						<h3 id="profile" >Galeria Videos</h3>
						<img style="margin-top: 16px;" src="<?php echo HOME.'/img/dummy_galeria_videos.png';?>">
		  				<a style="text-decoration: underline; float: right;" ref="#">(Ver mas)</a>
		  				<div class="space2"></div>						
						<h3 id="profile" >Galeria Fotos</h3>
						<img style="margin-top: 16px;"  src="<?php echo HOME.'/img/dummy_galeria_fotos.png';?>">
						<a style="text-decoration: underline; float: right;" ref="#">(Ver mas)</a>
						<div class="space4"></div>
					</div>
				</div>
			</div>
			
		</div>
		
		</div>
</div>
<body>	
	<div class="content" id="content">
	
		<div class="container-fluid">
		  	<div class="row-fluid">	
		  					</div>
			<div class="space2"></div>
		</div>
	</div>
 </body>
