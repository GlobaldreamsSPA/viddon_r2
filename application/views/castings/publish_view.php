<div class="content" id="content">
	<div class="container-fluid">
	  	<div class="row">
	  		<div class="span9">
	  			<div  style="border-radius: 25px; padding: 25px;" class="row-fluid">
		  			<div class="row-fluid">		
				    	<div class="span3 user-profile-left">
				    		<img class='user_image' src="<?php echo HOME."/img/logo_hunter/".$user_data['logo'] ?>"/>
				    		<div class="space4"></div>
				    		
				    		<div class="span9 offset1">
					    		<ul class="nav nav-pills nav-stacked orange">
								  <li><a href="<?php echo HOME."/hunter";?>"> <i class="icon-user"></i> Perfil</a> </li>
								  <li class="active"><a> <i class="icon-pencil"></i> Nuevo Casting</a></li>
								  <li><a  href="<?php echo HOME."/hunter/casting_list";?>"> <i class="icon-edit"></i> Mis Castings</a></li>
								  <li><a href="<?php echo HOME."/hunter/logout";?>"> <i class="icon-off"></i> Cerrar Sesi&oacuten</a></li>					
								</ul>
							</div>
				    	</div>
					    
					    <div class="span9 user-profile-right">
					    		
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
									  <option value="Otros">Otros</option>
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
									  <option value="Casta&ntildeo">Casta&ntildeo</option>
									  <option value="&aacutembar">&Aacutembar</option>
									  <option value="Avellana">Avellana</option>
									  <option value="Todos">Todos</option>
									</select>
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" name="hair-color">Color de cabello</label>
								<div class="controls">
									<select>
									  <option value="Casta&ntildeo">Casta&ntildeo</option>
									  <option value="Negro">Negro</option>
									  <option value="Rubio">Rubio</option>
									  <option value="Blanco">Blanco</option>
									  <option value="Rojo">Rojo</option>
									  <option value="Gris">Gris</option>
									  <option value="Todos">Todos</option>
									</select>
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" name="skin-color">Color de piel</label>
								<div class="controls">
									<select>
									  <option value="Blanca">Blanca</option>
									  <option value="Negra">Negra</option>
									  <option value="Trigue&ntildea">Trigue&ntildea</option>
									  <option value="Morena">Morena</option>
									  <option value="Todos">Todos</option>
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
									  <option value="200 cm o m&aacutes">200 cm o m&aacutes</option>
									  <option value="Todos">Todos</option>
									</select>
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" name="age">Edad</label>
								<div class="controls">
									<select>
									  <option value="10 a&ntildeos_o_menos">10 a&ntildeos o menos</option>
									  <option value="10-15 a&ntildeos">10-15 a&ntildeos</option>
									  <option value="15-20 a&ntildeos">15-20 a&ntildeos</option>
									  <option selected="selected" value="20-25 a&ntildeos">20-25 a&ntildeos</option>
									  <option value="25-30 a&ntildeos">25-30 a&ntildeos</option>
									  <option value="30-35 a&ntildeos">30-35 a&ntildeos</option>
									  <option value="35-40 a&ntildeos">35-40 a&ntildeos</option>
									  <option value="40-45 anos o m&aacutes">40-45 a&ntildeos o m&aacutes</option>
									  <option value="Todos">Todos</option>
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
						
					</div>
					<div class="row-fluid">	
						<div class="space4"></div>	
					</div>
		
			  	</div>
			 </div>
		
			<div class="span4">
				<div class="span3">
					<div  style="border-radius: 25px; padding: 35px; min-width: 290px;" class="row-fluid">
						<h3 id="profile"> Estado Castings </h3>
						<div class="row">
							<div class= "span6">
								<h4 class="list-view-title">Casting A1</h3>
							</div>
							<div class= "span6">
								<div id="time">Quedan 102 d&iacuteas</div>
							</div>
						</div>
						<div class="progress">
						    <div class="bar bar-danger" style="width: 20%;">20%</div>
						</div>
						<div class="space3"></div>
						<div class="progress">
						  	<div class="bar bar-danger" style="width: 0%;">0%</div>
						</div>
						
						<div class="row">
							<div class= "span6">
								<h4 class="list-view-title">Casting A2</h3>
							</div>
							<div class= "span6">
								<div id="time">Quedan 132 d&iacuteas</div>
							</div>
						</div>
						<div class="progress">
						    <div class="bar bar-danger" style="width: 30%;">30%</div>
						</div>
						<div class="space3"></div>
						<div class="progress">
						  	<div class="bar bar-danger" style="width: 0%;">0%</div>
						</div>
						
						<div class="row">
							<div class= "span6">
								<h4 class="list-view-title">Casting B</h3>
							</div>
							<div class= "span6">
								<div id="time">Quedan 72 d&iacuteas</div>
							</div>
						</div>
						<div class="progress">
						    <div class="bar bar-warning" style="width: 45%;">45%</div>
						</div>
						<div class="space3"></div>
						<div class="progress">
						  	<div class="bar bar-danger" style="width: 0%;">0%</div>
						</div>
						
						<div class="row">
							<div class= "span6">
								<h4 class="list-view-title">Casting C</h3>
							</div>
							<div class= "span6">
								<div id="time">Quedan 12 d&iacuteas</div>
							</div>
						</div>
						<div class="progress">
						    <div class="bar bar-success" style="width: 85%;">85%</div>
						</div>
						<div class="space3"></div>
						<div class="progress">
						  	<div class="bar bar-danger" style="width: 0%;">0%</div>
						</div>
						
						<div class="row">
							<div class= "span6">
								<h4 class="list-view-title">Casting D</h3>
							</div>
							<div class= "span6">
								<div id="time">Quedan 0 d&iacuteas</div>
							</div>
						</div>
						<div class="progress">
						    <div class="bar bar-success" style="width: 100%;">100%</div>
						</div>
						<div class="space3"></div>
						<div class="progress">
						  	<div class="bar bar-danger" style="width: 10%;">10%</div>
						</div>

						<div class="row">
							<div class= "span6">
								<h4 class="list-view-title">Casting E</h3>
							</div>
							<div class= "span6">
								<div id="time">Quedan 0 d&iacuteas</div>
							</div>
						</div>
						<div class="progress">
						    <div class="bar bar-success" style="width: 100%;">100%</div>
						</div>
						<div class="space3"></div>
						<div class="progress">
						  	<div class="bar bar-warning" style="width: 50%;">50%</div>
						</div>
						
						<div class="space2"></div>
						<div class="space05"></div>
						
					</div>
				</div>
			</div>
		
		</div>
	</div>
</div>