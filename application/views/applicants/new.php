<div class="row-fluid">		
				    	<div class="span3 user-profile-left">
				    		<div class="row">
				    		<?php 
				    			if(isset($update_values) && file_exists(APPPATH.'/../img/profile/'.$update_values['image_profile']) == TRUE)
				    				echo "<img class='user_image' src='".HOME.'/img/profile/'.$update_values['image_profile']."'/>";
				    			else
				    				echo "<img class='user_image' src='".HOME."/img/profile/user.jpg'/>";
				    		?>
					
				    		</div>
				    		<div class="space2"></div>
				    		<div class="row">
								<?php if(!$public) {?>
								<form action="" method="POST">
									<?php if($postulation_flag) {?>
									<a href="<?php echo HOME.'/home/casting_list'?>" class="btn btn-success" type="submit" name="apply">POSTULAR CASTINGS</a>
									<input type="hidden" name="validate" value="1"/>
									<?php } else{ ?>
									<button data-toggle="modal"  href="#error" class="btn btn-success">POSTULAR CASTINGS</button>
					    			<?php } ?>
					    		</form>
					    		<?php } ?>
				    		</div>
				    		<div class="row">
					    		<div class="span10 offset1">
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
													<li><a href="<?php echo HOME."/user/active_casting_list"?>">Activas</a></li>	
													<li><a href="<?php echo HOME."/user/results_casting"?>">Resultados</a></li>	
												</ul>
											</div>
										</li>	
										<li><a href="<?php echo HOME."/user/logout";?>"> <i class="icon-off"></i> Cerrar Sesi&oacuten</a></li>					
									</ul>
								</div>
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
							<legend><h3>Cu&eacutentanos Sobre T&iacute</h3></legend>
							<div style="margin-left:15px;">
								<div class="row">
									<div class="span6">								
										<h5>Nombre</h5>
										<input type="text" style="width:100%;" placeholder="Escribe tu Nombre Aqui" value="<?php if(isset($update_values)) echo $update_values["name"]; else echo set_value('name');?>" name="name">
									</div>
								</div>
								<div class="row">
									<?php echo form_error('name'); ?>
									
									<div style="margin-left: -10px; margin-top: -20px;" id="image_upload">
										<h5>Sube una imagen de t&iacute</h5>
										<?php echo form_upload(array('name' => 'image_profile','id'=> 'file')); ?>
										<?php 
											  echo form_hidden('image','');
											  echo form_error('image'); 
										?>
									</div>
								</div>
								<div class="space2"></div>														
								<div class="row">									
										<div class="span4">
											<h5>Sexo</h5>
											<select style='width: 100%;' class="span4" name="sex">
												<option value="0" <?php if(isset($update_values) && $update_values["sex"]==0) echo "selected='selected'";?>>Femenino</option>
												<option value="1"  <?php if(isset($update_values) && $update_values["sex"]==1) echo "selected='selected'";?>>Masculino</option>
											</select>
										</div>
										
										<div class="span4">
											<h5>Edad</h5>
											<?php
												if(isset($update_values)) $age_set=$update_values["age"]; else $age_set=18; 
												echo form_dropdown('age', $age, $age_set, "style='width: 100%;'") 
											?>
										</div>
										
										<div class="span4">
											<h5>Estatura</h5>
											<?php
												if(isset($update_values)) $height_set=$update_values["height"]; else $height_set=165; 
												echo form_dropdown('height', $height, $height_set, "style='width: 100%;'") 
											?>
										</div>
									</div>
								<div class="row">
										<div class="span4">
											<h5>Color de piel</h5>
											<?php
												if(isset($update_values)) $skin_set=$update_values["color_skin"]; else $skin_set=0; 
												echo form_dropdown('height', $skin, $skin_set, "style='width: 100%;'") 
											?>
										</div>
										<div class="span4">
										<h5>Color de ojos</h5>
											<?php
												if(isset($update_values)) $eye_set=$update_values["color_eye"]; else $eye_set=0; 
												echo form_dropdown('height', $eyes, $eye_set, "style='width: 100%;'") 
											?>
										</div>
										<div class="span4">
											<h5>Color de cabello</h5>
											<?php
													if(isset($update_values)) $hair_set=$update_values["color_hair"]; else $hair_set=0; 
													echo form_dropdown('height', $hair, $hair_set, "style='width: 100%;'") 
											?>
										</div>										
								</div>
								
								<div class="row">
									<div class="span4">	
										<!-- FALTA QUE CARGUE LO ACTUAL -->
									<h5>Contextura</h5>
										<select style="width: 100%;" name="build">
											<option value="0">Delgado</option>
											<option selected="selected" value="1">Normal</option>
											<option value="2">Grueso</option>
											<option value="3">Atletico</option>
											<option value="4">Obeso</option>
										</select>
									</div>
								</div>
								
							</div>
							<legend>Informaci&oacute;n P&uacute;blica</legend>
							
							<div style="margin-left:5px;">
								<h5>Selecciona tus habilidades</h5>
									<?php 
									$skill_selected= array();
									for ($i=0; $i<3; $i++)
									{
										if(isset($update_user_skills[$i]))
											$skill_selected[$i]=$update_user_skills[$i];
										else 
											$skill_selected[$i]=0;
											
									}
									echo form_multiselect('skills[]', $skills, $skill_selected,"class='chzn-select' style='width:245px' data-placeholder='Selecciona los tags...'");
									?>
								<h5>Biograf&iacutea</h5>
									<textarea class="rich_textarea" name="bio"><?php if(isset($update_values)) echo $update_values["bio"]; else echo set_value('bio');?></textarea>
									<?php echo form_error('bio'); ?>
								<h5>tus Hobbies</h5>
									<textarea class="rich_textarea" name="hobbies"><?php if(isset($update_values)) echo $update_values["hobbies"]; else echo set_value('hobbies');?></textarea>
									<?php echo form_error('hobbies'); ?>
								<h5>Tus Sueños</h5>
									<textarea class="rich_textarea" name="dreams"><?php if(isset($update_values)) echo $update_values["dreams"]; else echo set_value('dreams');?></textarea>
									<?php echo form_error('dreams'); ?>
								<div class="space2"></div>
									<button class="btn btn-primary" type="submit"> Guardar Datos </button>
								</form>
								<div class="space4"></div>
							</div>
						</div>
					
					</div>
				