<body>	
	<div class="content" id="content">
	
		<div class="container-fluid">
		  	<div class="row-fluid">	
		  		<div class="space2"></div>
				<!-- Imagen -->
				<?php echo form_open_multipart('user/edit'); ?>
				<div class="span3" id="image_upload">
					<img src="<?php echo base_url(); ?>img/profile/user.jpg" class="img-polaroid">
					<?php echo form_upload(array('name' => 'image')); ?>
					<?php echo form_error('image'); ?>
				</div>
				<!-- Texto -->
				<div class="span9">
					<h3>Quien eres</h3>
					<input type="text" class="span7" placeholder="Escribe tu Nombre Aqui" value="<?php echo set_value('name'); ?>" name="name">
					<?php echo form_error('name'); ?>
					<h5>¿Cúal es tu sexo?</h5>
					<select class="span2" name="sex">
						<option value="0" selected="selected">Femenino</option>
						<option value="1">Masculino</option>
					</select>
					<h5>¿Y tu edad?</h5>
						<?php echo form_dropdown('age', $age, 21, "class='span2'") ?> <br/>
					<h3>Selecciona tus habilidades</h3>
						<?php echo form_dropdown('skills1', $skills, 1,"class='span2'") ?>
						<?php echo form_dropdown('skills2', $skills, 3,"class='span2'") ?>
						<?php echo form_dropdown('skills3', $skills, 13,"class='span2'") ?>
					<h3>Bio</h3>
						<textarea class="user_description" rows="4" span="7" placeholder="Cuéntanos sobre ti. Cómo eres y que haces." name="bio"><?php echo set_value('bio'); ?></textarea>
						<?php echo form_error('bio'); ?>
					<h3>Hobbies</h3>
						<textarea class="user_description" rows="4" span="7" placeholder="Háblanos sobre tus gustos y lo que te apasiona!" name="hobbies"><?php echo set_value('hobbies'); ?></textarea>
						<?php echo form_error('hobbies'); ?>
					<h3>Mi Sueño</h3>
						<textarea class="user_description" rows="4" span="7" placeholder="Cuéntanos de tus sueños y lo que quieres lograr!" name="dreams"><?php echo set_value('dreams'); ?></textarea>
						<?php echo form_error('dreams'); ?>
					<div class="space2"></div>
					<input class="btn btn-primary" type="submit" value="Guardar Datos" />
					</form>
					<div class="space4"></div>
				</div>
			</div>
			<div class="space2"></div>
		</div>
	</div>
 </body>
