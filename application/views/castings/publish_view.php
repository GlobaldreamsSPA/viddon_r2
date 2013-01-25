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
							<input type="file" id="file">
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
					<div class="control-group">
						<label class="control-label">Habilidades</label>
						<div class="controls">
							<textarea rows="3" placeholder="Los talentos o habilidades necesarios para postular."></textarea>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Categor&iacutea</label>
					<div class="controls">
						<select>
						  <option>Reality</option>
						  <option>Teleserie</option>
						  <option selected="selected">Show de Talentos</option>
						  <option>Documental</option>
						  <option>Festival</option>
						</select>
					</div>
					</div>
					<fieldset>
					<legend>Perfil del postulante a buscar</legend>
					<div class="control-group">
						<label class="control-label">Color de ojos</label>
					<div class="controls">
						<select>
						  <option>Verde</option>
						  <option>Azul</option>
						  <option>Gris</option>
						  <option>Castaño</option>
						  <option>&Aacutembar</option>
						  <option>Avellana</option>
						</select>
					</div>
					</div>
					<div class="control-group">
						<label class="control-label">Color de cabello</label>
					<div class="controls">
						<select>
						  <option>Castaño</option>
						  <option>Negro</option>
						  <option>Rubio</option>
						  <option>Blanco</option>
						  <option>Rojo</option>
						  <option>Gris</option>
						</select>
					</div>
					</div>
					<div class="control-group">
						<label class="control-label">Color de piel</label>
					<div class="controls">
						<select>
						  <option>Blanca</option>
						  <option>Negra</option>
						  <option>Trigueña</option>
						  <option>Morena</option>
						</select>
					</div>
					</div>
					<div class="control-group">
						<label class="control-label">Estatura</label>
					<div class="controls">
						<select>
						  <option>150 cm o -</option>
						  <option selected="selected">150 cm</option>
						  <option>160 cm</option>
						  <option>170 cm</option>
						  <option>180 cm</option>
						  <option>190 cm</option>
						  <option>200 cm</option>
						  <option>200 cm o +</option>
						</select>
					</div>
					</div>
					<div class="control-group">
						<label class="control-label">Edad</label>
					<div class="controls">
						<select>
						  <option>10 años o -</option>
						  <option>10-15 años</option>
						  <option>15-20 años</option>
						  <option selected="selected">20-25 años</option>
						  <option>25-30 años</option>
						  <option>30-35 años</option>
						  <option>35-40 años</option>
						  <option>40-45 años o +</option>
						</select>
					</div>
					</div>
					<div class="control-group">
						<label class="control-label">Sexo</label>
					<div class="controls">
					<label class="radio">
					  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
					  Femenino
					</label>
					<label class="radio">
					  <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
					  Masculino
					</label>
					<label class="radio">
					  <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
					  Ambos
					</label>
					</div>
					</div>
				</fieldset>
				<row>
  					<button type="submit" class="btn btn-primary publish-submit-button">Publicar casting</button>
  				</row>
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