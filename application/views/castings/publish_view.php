<div class="content" id="content">
	<div class="container-fluid">
	  	<div class="row-fluid">
	    	<div class="span3 user-profile-left">
	    		<img class='user_image' src="<?php echo HUNTER_PROFILE_IMAGE.$user_data['logo'] ?>"/>
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
				<?php echo form_open('hunter/publish', array('class' => 'form-horizontal')); ?>
					<fieldset>
					<legend><h2 class="profile-title"> Publicar un nuevo Casting </h2></legend>
					<div class="control-group">
						<label class="control-label">T&iacutetulo</label>
						<div class="controls">
							<input type="text" name="title" placeholder="Ingrese el título del Casting">
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
							<textarea rows="5" name="description" placeholder="Una descripción o llamado a postular a la oferta: si te apasiona el espectáculo, cantas, etc ¡ésta es tu oportunidad!"></textarea>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Requerimientos</label>
						<div class="controls">
							<textarea rows="3" name="requirements" placeholder="Requerimientos para el casting: color de ojos, color de pelo, etc."></textarea>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Habilidades</label>
						<div class="controls">
							<textarea rows="3" name="skills" placeholder="Los talentos o habilidades necesarios para postular."></textarea>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" name="category">Categor&iacutea</label>
					<div class="controls">
						<select>
						  <option value="Reality">Reality</option>
						  <option value="Teleserie">Teleserie</option>
						  <option selected="selected" value="Show de Talentos">Show de Talentos</option>
						  <option value="Documental">Documental</option>
						  <option value="Festival">Festival</option>
						</select>
					</div>
					</div>
					<fieldset>
					<legend>Perfil del postulante a buscar</legend>
					<div class="control-group">
						<label class="control-label" name="eyes-color">Color de ojos</label>
					<div class="controls">
						<select>
						  <option value="Verde">Verde</option>
						  <option value="Azul">Azul</option>
						  <option value="Gris">Gris</option>
						  <option value="Castaño">Castaño</option>
						  <option value="Ámbar">&Aacutembar</option>
						  <option value="Avellana">Avellana</option>
						</select>
					</div>
					</div>
					<div class="control-group">
						<label class="control-label" name="hair-color">Color de cabello</label>
					<div class="controls">
						<select>
						  <option value="Castaño">Castaño</option>
						  <option value="Negro">Negro</option>
						  <option value="Rubio">Rubio</option>
						  <option value="Blanco">Blanco</option>
						  <option value="Rojo">Rojo</option>
						  <option value="Gris">Gris</option>
						</select>
					</div>
					</div>
					<div class="control-group">
						<label class="control-label" name="skin-color">Color de piel</label>
					<div class="controls">
						<select>
						  <option value="Blanca">Blanca</option>
						  <option value="Negra">Negra</option>
						  <option value="Trigueña">Trigueña</option>
						  <option value="Morena">Morena</option>
						</select>
					</div>
					</div>
					<div class="control-group">
						<label class="control-label" name="height">Estatura</label>
					<div class="controls">
						<select>
						  <option value="150 cm o menos">150 cm o menos</option>
						  <option selected="selected" value="150 cm">150 cm</option>
						  <option value="160 cm">160 cm</option>
						  <option value="170 cm">170 cm</option>
						  <option value="180 cm">180 cm</option>
						  <option value="190 cm">190 cm</option>
						  <option value="200 cm">200 cm</option>
						  <option value="200 cm o más">200 cm o m&aacutes</option>
						</select>
					</div>
					</div>
					<div class="control-group">
						<label class="control-label" name="age">Edad</label>
					<div class="controls">
						<select>
						  <option value="10 años o menos">10 años o menos</option>
						  <option value="10-15 años">10-15 años</option>
						  <option value="15-20 años">15-20 años</option>
						  <option selected="selected" value="20-25 años">20-25 años</option>
						  <option value="25-30 años">25-30 años</option>
						  <option value="30-35 años">30-35 años</option>
						  <option value="35-40 años">35-40 años</option>
						  <option value="40-45 años o más">40-45 años o m&aacutes</option>
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