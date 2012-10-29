<body>
	<!-- Imagen -->
	<?php echo form_open_multipart('user/edit'); ?>
	<div class="span3">
		<img src="img/320px-Insert_image_here-.svg_.png" class="img-polaroid">
		<?php echo form_upload(array('name' => 'image')); ?>
	</div>
	<!-- Texto -->
	<div class="span9">
			<input type="text" class="span8" placeholder="Escribe tu Nombre Aqui" value="<?php echo set_value('name'); ?>" name="name">
			<?php echo form_error('name'); ?>
			<label>Selecciona tus habilidades</label>
				<?php echo form_dropdown('skills1', $skills, 1,"class='span2'") ?>
				<?php echo form_dropdown('skills2', $skills, 3,"class='span2'") ?>
				<?php echo form_dropdown('skills3', $skills, 13,"class='span2'") ?>
			<label>Bio</label>
				<textarea rows="4" span="7" placeholder="Cuentanos sobre ti. Cómo eres y que haces." value="<?php echo set_value('bio'); ?>" name="bio"></textarea>
				<?php echo form_error('bio'); ?>
			<label>Hobbies</label>
				<textarea rows="4" span="7" placeholder="Háblanos sobre tus gustos y lo que te apasiona!" value="<?php echo set_value('hobbies'); ?>" name="hobbies"/></textarea>
				<?php echo form_error('hobbies'); ?>
			<label>Mi Sueño</label>
				<textarea rows="4" span="7" placeholder="Háblanos de tus sueños y lo que quieres lograr!" value="<?php echo set_value('dreams'); ?>" name="dreams"/></textarea>
				<?php echo form_error('dreams'); ?>
			<label>Email</label>
				<input type="text" class="span3" placeholder="Danos tu email!" value="<?php echo set_value('email'); ?>" name="email">
				<?php echo form_error('email'); ?>
			<label>¿Cúal es tu sexo?</label>
			<select class="span2">
				<option value="0" selected="selected">Femenino</option>
				<option value="1">Masculino</option>
			</select>
			<label>¿Y tu edad?</label>
				<?php echo form_dropdown('age', $age, 21, "class='span2'") ?> <br/>
				<input class="btn" type="submit" value="Guardar Datos" />
	</form>
	</div>
 </body>
