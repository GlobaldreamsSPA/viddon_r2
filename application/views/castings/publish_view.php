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
							<?php echo form_open_multipart('hunter/publish', array('class' => 'form-horizontal')); ?>
								<legend><h2 class="profile-title"> Publicar un nuevo Casting </h2></legend>
								<div style="margin-left:15px;">
									<h5>T&iacutetulo</h5>
									<input type="text" name="title" class="span5" placeholder="Ingrese el t&iacute;tulo del Casting">
									<?php echo form_error('title'); ?>
	
									<h5>Imagen para mostrar</h5>
									<?php echo form_upload(array('name' => 'casting_image','id'=> 'file')); ?>
									<?php
										echo form_hidden('image','');
										echo form_error('image');
									?>
									
									<h5>Categor&iacutea</h5>
									<select class="span5" name="category">
										<option value="Reality">Reality</option>
										<option value="Teleserie">Teleserie</option>
										<option selected="selected" value="Show de Talentos">Show de Talentos</option>
										<option value="Documental">Documental</option>
										<option value="Festival">Festival</option>
										<option value="Otros">Otros</option>
									</select>
									
									<h5>Descripci&oacuten o llamado a postular</h5>
									<textarea class="rich_textarea" name="description"> </textarea>
									<?php echo form_error('description'); ?>
	
									<h5>Requerimientos</h5>
									<textarea class="rich_textarea" name="requirements"></textarea>
									<?php echo form_error('requirements'); ?>
	
									<h5>Habilidades</h5>
									<textarea class="rich_textarea" name="skills"></textarea>
									<?php echo form_error('skills'); ?>
									
									<div class="space1"></div>
								</div>
								<legend>Perfil del postulante a buscar</legend>
								<div>		
									<div style="margin-left:15px;" class="row">
										<div class="span5">
										<h5>Color de ojos</h5>
										<select style="width: 240px;" name="eyes-color">
											<option value="Verde">Verde</option>
											<option value="Azul">Azul</option>
											<option value="Gris">Gris</option>
											<option value="Casta&ntildeo">Casta&ntildeo</option>
											<option value="&aacutembar">&Aacutembar</option>
											<option value="Avellana">Avellana</option>
											<option value="Todos">Todos</option>
										</select>
										</div>
										<div class="span6">
										<h5>Color de cabello</h5>
										<select style="width: 240px;" name="hair-color">
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
									<div style="margin-left:15px;" class="row">
										<div class="span5">
											<h5>Color de piel</h5>
											<select style="width: 240px;" name="skin-color">
												<option value="Blanca">Blanca</option>
												<option value="Negra">Negra</option>
												<option value="Trigue&ntildea">Trigue&ntildea</option>
												<option value="Morena">Morena</option>
												<option value="Todos">Todos</option>
											</select>
										</div>
										
										<div class="span6">
											<h5>Estatura</h5>
											<select style="width: 240px;" name="height">
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
									
									<div style="margin-left:15px;">
										<h5>Edad</h5>
											
										<select style="width: 240px;" name="age">
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
										
										<h5>Sexo</h5>
										<label class="radio inline">
											<input type="radio" name="optionsRadios" id="optionsRadios1" value="Femenino" checked>
											Femenino
										</label>
										<label class="radio inline">
											<input type="radio" name="optionsRadios" id="optionsRadios2" value="Masculino">
											Masculino
										</label>
										<label class="radio inline">
											<input type="radio" name="optionsRadios" id="optionsRadios3" value="Ambos">
											Ambos
										</label>
										<div class="space2"></div>
										<button type="submit" class="btn btn-primary">Publicar casting</button>
									</div>									
					  			</div>
							</form>
						</div>
						
					</div>
					<div class="row-fluid">	
						<div class="space4"></div>	
					</div>
