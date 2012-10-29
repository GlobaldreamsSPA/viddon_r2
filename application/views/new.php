<body>
	<!-- Imagen -->
	<?php echo form_open_multipart('user/edit'); ?>
	<div class="span3">
		<img src="img/320px-Insert_image_here-.svg_.png" class="img-polaroid">
		<?php echo form_upload(array('name' => 'image')); ?>
	</div>
	<!-- Texto -->
	<div class="span9">
			<input type="text" class="span8" placeholder="Escribe tu Nombre Aqui" name="name">
			<label>Selecciona tus habilidades</label>
			<?php echo form_dropdown('skills1', $skills, 1,"class='span2'") ?>
			<?php echo form_dropdown('skills2', $skills, 3,"class='span2'") ?>
			<?php echo form_dropdown('skills3', $skills, 13,"class='span2'") ?>
			<label>Bio</label>
			<textarea rows="4" span="7" placeholder="Cuentanos sobre ti. Cómo eres y que haces." name="bio"></textarea>
			<label>Hobbies</label>
			<textarea rows="4" span="7" placeholder="Háblanos sobre tus gustos y lo que te apasiona!" name="hobbies"/></textarea>
			<label>Mi Sueño</label>
			<textarea rows="4" span="7" placeholder="Háblanos de tus sueños y lo que quieres lograr!" name="dreams"/></textarea>
			<label>Email</label>
			<input type="text" class="span3" placeholder="Danos tu email!" name="email">
			<label>¿Cúal es tu sexo?</label>
			<select class="span2">
				<option></option>
			</select>
			<input class="btn" type="submit" value="Guardar Datos" />
	</form>
	</div>
 </body>
