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
								<a href="<?php echo HOME.'/home/casting_list'?>" id="participate_button" class="btn btn-large btn-success" type="submit" name="apply">POSTULAR CASTINGS</a>
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
									<li><a href="<?php echo HOME."/user/logout";?>"> <i class="icon-off"></i> Cerrar Sesi&oacuten</a></li>					
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
							<legend><h3>Cu&eacutentanos Sobre T&iacute</h3></legend>
							<div style="margin-left:15px;">
								<h5>¿C&uacuteal es tu nombre?</h5>
								<input type="text" style="width: 235px;" placeholder="Escribe tu Nombre Aqui" value="<?php if(isset($update_values)) echo $update_values["name"]; else echo set_value('name');?>" name="name">
								
								<?php echo form_error('name'); ?>
								<h5>¿C&uacuteal es tu sexo?</h5>
								<select style='width: 245px;' class="span4" name="sex">
									<option value="0" <?php if(isset($update_values) && $update_values["sex"]==0) echo "selected='selected'";?>>Femenino</option>
									<option value="1"  <?php if(isset($update_values) && $update_values["sex"]==1) echo "selected='selected'";?>>Masculino</option>
								</select>
								<h5>¿Y tu edad?</h5>
									<?php
									if(isset($update_values)) $age_set=$update_values["age"]; else $age_set=18; 
									echo form_dropdown('age', $age, $age_set, "style='width: 245px;'") ?> <br/>
								
								<div style="margin-left: -15px; margin-top: -20px;" id="image_upload">
									<h5>Sube una imagen de t&iacute</h5>
									<?php echo form_upload(array('name' => 'image_profile','id'=> 'file')); ?>
									<?php 
										  echo form_hidden('image','');
										  echo form_error('image'); 
									?>
								</div>
								
								<div class="space2"></div>
							</div>
							<legend>Informaci&oacuten P&uacuteblica</legend>
							
							<div style="margin-left:15px;">
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
				