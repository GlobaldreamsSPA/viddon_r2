<body>	
	<div class="content" id="content">
	
		<div class="container-fluid">
		  	<div class="row-fluid">	
		  		<div class="space2"></div>
				<!-- Imagen -->
				<?php 
				if (isset($update_values)) $flag="/update123";
				else 
					$flag = "";
				
				echo form_open_multipart('user/edit'.$flag); ?>

				<!-- Texto -->
				<div class="span9 offset3">
					<div  id="image_upload">
						<div class="space05"></div>
						<?php 
							/*<img src="<?php echo base_url(); ?>img/profile/<?php if(isset($update_values)) echo $update_values["image_profile"]; else echo "user.jpg"; ?>" class="img-polaroid">*/
							echo form_upload(array('name' => 'image_profile'));
							  
						?>
						<?php 
							  echo form_hidden('image','');
							  echo form_error('image'); 
						?>
					</div>
					<h3>Quien eres</h3>
					<input type="text" class="span7" placeholder="Escribe tu Nombre Aqui" value="<?php if(isset($update_values)) echo $update_values["name"]; else echo set_value('name');?>" name="name">
					<?php echo form_error('name'); ?>
					<h5>¿C&uacuteal es tu sexo?</h5>
					<select class="span2" name="sex">
						<option value="0" <?php if(isset($update_values) && $update_values["sex"]==0) echo "selected='selected'";?>>Femenino</option>
						<option value="1"  <?php if(isset($update_values) && $update_values["sex"]==1) echo "selected='selected'";?>>Masculino</option>
					</select>
					<h5>¿Y tu edad?</h5>
						<?php
						if(isset($update_values)) $age_set=$update_values["age"]; else $age_set=18; 
						echo form_dropdown('age', $age, $age_set, "class='span2'") ?> <br/>
					
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
						echo form_dropdown('skills1', $skills, $skill_selected[0],"class='span2'"); 
						echo form_dropdown('skills2', $skills, $skill_selected[1],"class='span2'"); 
						echo form_dropdown('skills3', $skills, $skill_selected[2],"class='span2'"); 
						?>
					<h3>Bio</h3>
						<textarea class="user_description" rows="4" span="7" placeholder="Cuéntanos sobre ti. Cómo eres y que haces." name="bio"><?php if(isset($update_values)) echo $update_values["bio"]; else echo set_value('bio');?></textarea>
						<?php echo form_error('bio'); ?>
					<h3>Hobbies</h3>
						<textarea class="user_description" rows="4" span="7" placeholder="Háblanos sobre tus gustos y lo que te apasiona!" name="hobbies"><?php if(isset($update_values)) echo $update_values["hobbies"]; else echo set_value('hobbies');?></textarea>
						<?php echo form_error('hobbies'); ?>
					<h3>Mi Sueño</h3>
						<textarea class="user_description" rows="4" span="7" placeholder="Cuéntanos de tus sueños y lo que quieres lograr!" name="dreams"><?php if(isset($update_values)) echo $update_values["dreams"]; else echo set_value('dreams');?></textarea>
						<?php echo form_error('dreams'); ?>
					<div class="space2"></div>
						<button class="btn btn-primary" type="submit"> Guardar Datos </button>
					</form>
					<div class="space4"></div>
				</div>
			</div>
			<div class="space2"></div>
		</div>
	</div>
 </body>
