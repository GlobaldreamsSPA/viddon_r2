<?php
	if(isset($error))
	{
		//registro el error
		echo($error);
	} 
	
?><!-- Si ocurrió un error, lo muestra -->

<h1>Terminos y condiciones de uso</h1>
<p>Al utilizar este medio para publicar sus videos,....
	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
</p>


<?php echo form_open_multipart('subevideo/subir_video');?>
	<input type="file" name="userfile" size="20" required="required"/><br />
	<input name='uploaded_title' type="text" required="required" placeholder="Titulo del Video" /><br />
	<textarea name="uploaded_desc" cols="20" rows="5" placeholder="Descripcion">
	</textarea><br>
	<button type="submit" class="btn btn-primary">Guardar</button>
	<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
</form>
<p>Si llegaste a esta seccion y no sabes que hacer, te recomendamos intentar subir tu video utilizando Youtube en el siguiente enlace: <a href="http://www.youtube.com/upload" target="_blank">Youtube Upload</a></p>