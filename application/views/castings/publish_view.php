<!-- CARGO EL MODAL-->
    <div id="add_question" class="modal hide fade" style="width: 430px !important;" tabindex="-1" role="dialog" aria-labelledby="AgregaVideo" aria-hidden="true">
      <form id="photo_upload_form" enctype="multipart/form-data" action="#" method="post">
        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 id="myModalLabel">Agregar Pregunta</h3>
        </div>
        <div class="modal-body">
            <div> 
		        <select>
					<option value="volvo">Texto</option>
					<option value="saab">Alternativas</option>
					<option value="mercedes">Afirmacion</option>
				</select> 
            	
            	<h3>ACA VA EL CONTENIDO VARIABLE, DEPENDE DE EL TIPO DE PREGUNTA</h3>


            </div>
        </div>
        <div class="modal-footer" style="height: 30px;">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
        </div>
      </form>
    </div>      <!-- MODAL-->

<div class="row-fluid">		
	<div class="span3 user-profile-left">
		<img class='user_image' src="<?php echo HOME."/img/logo_hunter/".$user_data['logo'] ?>"/>
		<div class="space4"></div>
		
		<div class="span9 offset1">
			<ul class="nav nav-pills nav-stacked orange">
			  <li><a href="<?php echo HOME."/hunter";?>"> <i class="icon-user"></i> Perfil</a> </li>
			  <li><a href="<?php echo HOME."/hunter/edit/";?>"> <i class="icon-pencil"></i> Editar Datos</a></li>
			  <li><a href="<?php echo HOME."/hunter/manage_hunters/";?>"> <i class="icon-list-alt"></i> Gesti&oacute;n Hunters</a></li>
			  <li class="active"><a> <i class="icon-edit"></i> Nuevo Casting</a></li>
			  <li><a  href="<?php echo HOME."/hunter/casting_list";?>"> <i class="icon-list"></i> Mis Castings</a></li>
			  <li><a href="<?php echo HOME."/hunter/logout";?>"> <i class="icon-off"></i> Cerrar Sesi&oacuten</a></li>					
			</ul>
		</div>
	</div>
	
	<div class="span8 offset1 user-profile-right">
			
		<div class="space1"></div>
		<div class="space1"></div>
		<?php echo form_open_multipart('hunter/publish', array('class' => 'form-horizontal')); ?>
			<legend><h3 class="profile-title"> Publicar un nuevo Casting </h3></legend>
			<div style="margin-left:15px;">
				<h5>T&iacutetulo</h5>
				<input type="text" name="title" class="span5" placeholder="Ingrese el t&iacute;tulo del Casting">
				<?php echo form_error('title'); ?>

				
				<?php $today = new DateTime(date('Y-m-d')); ?>
				<h5>Fecha de inicio</h5>
				<input type="text" class="span3" value="<?php echo $today->format('Y-m-d'); ?>" id="dp1" data-date-format="yyyy-mm-dd" name="start-date">
				<h5>Fecha de t&eacutermino</h5>
				<input type="text" class="span3" value="<?php echo $today->format('Y-m-d'); ?>" id="dp2" data-date-format="yyyy-mm-dd" name="end-date">
				
				<h5>Meta Postulantes</h5>
				<input type="text" name="max_applies" class="span5" placeholder="Ingresa Cantidad" value="<?php if(isset($update_values)) echo $update_values["max_applies"]; else echo set_value('max_applies');?>">
				<?php echo form_error('max_applies'); ?>
	
				
				<h5>Categor&iacutea</h5>
				<select class="span5" name="category">
					<?php
						foreach($categories as $cat)
						{
							echo "<option value=".$cat.">".$cat."</option>";
						}
					?>
				</select>
				
				
				
				<h5>Imagen para mostrar</h5>
				<?php echo form_upload(array('name' => 'logo','class'=> 'file')); ?>
				<?php
					echo form_hidden('image','');
					echo form_error('image');
				?>
				
				<h5>Habilidades</h5>
				<?php 
				
				echo form_multiselect('skills[]', $skills,NULL,"class='chzn-select chosen_filter' style='width:60%' data-placeholder='Selecciona los tags...'");
				?>

				<h5>Hunters</h5>
				<?php 
				
				echo form_multiselect('hunters[]', $hunters,NULL,"class='chzn-select chosen_filter' style='width:60%' data-placeholder='Selecciona los hunters...'");
				?>
				
				
				<h5>Descripci&oacuten o llamado a postular</h5>
				<textarea class="rich_textarea" name="description"> </textarea>
				<?php echo form_error('description'); ?>

				<h5>Requerimientos</h5>
				<textarea class="rich_textarea" name="requirements"></textarea>
				<?php echo form_error('requirements'); ?>

				<div class="space1"></div>

				<!-- IMPORTANTE MAQUETA FORMULARIO-->
				<div style="border: solid 1px black; padding: 2%;">
						<div class="span8">
				    		<h3> Preguntas Personalizadas</h3>

						</div>

						<div style="margin-top:15px;" class="span4">
								<button data-toggle="modal"  href="#add_question" class="btn btn-primary">Agregar Pregunta</button>
						</div>
					<legend></legend>
					<table id="datatables" class="table">
			          <thead>
			            <tr>
			              <th>Nombre</th>
			              <th>Tipo</th>
			              <th>Acci&oacuten</th>
			            </tr>
			          </thead>
			          <tbody>
			          	
	          			<tr>
				            <td style="vertical-align:middle;">
				            	¿Tienes alguna fobia?
				            	<input type="hidden" name="question" value="¿Tienes alguna fobia?" />
				            	<input type="hidden" name="alternatives" value="si,no" />

				    		</td>
				            <td style="vertical-align:middle;">
				            	Alternativas
				            </td>
				            <td  style="vertical-align:middle;" class="row center">
					            <div class="span4">
									<a class="btn" href="#">
										<i class="icon-zoom-in"></i>                                            
									</a>
								</div>
								<div class="span4">
									<a class="btn" href="#">
										<i class="icon-edit"></i>                                            
									</a>
								</div>
								<div class="span4">
									<a class="btn" href="#">
										<i class="icon-remove"></i>                                            
									</a>
								</div>
							</td>
			            </tr>    
			          </tbody>
			        </table>
			        <div class="space2">
			        </div>
		    	</div>
			     
				<button style="margin-top: 2%;"type="submit" class="btn btn-primary">Publicar casting</button>

			</div>
			
			<?php /* ?>	
			<legend>Perfil del postulante a buscar</legend>
			<div>	
				
				<div style="margin-left:15px;" class="row">
					<div class="span6">
					<h5>Color de ojos</h5>
					<select style="width: 100%;" name="eyes-color">
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
					<select style="width: 100%;" name="hair-color">
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
					<div class="span6">
						<h5>Color de piel</h5>
						<select style="width: 100%;" name="skin-color">
							<option value="Blanca">Blanca</option>
							<option value="Negra">Negra</option>
							<option value="Trigue&ntildea">Trigue&ntildea</option>
							<option value="Morena">Morena</option>
							<option value="Todos">Todos</option>
						</select>
					</div>
					
					<div class="span6">
						<h5>Estatura</h5>
						<select style="width: 100%;" name="height">
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
						
					<?php 
					echo form_multiselect('age[]', $age_list,NULL,"class='chzn-select chosen_filter' style='width:60%' data-placeholder='Selecciona las edades...'");
					?>
					
					<h5>Sexo</h5>
					<label class="radio inline">
						<input type="radio" name="optionsRadios" id="optionsRadios1" value="2" checked>
						Femenino
					</label>
					<label class="radio inline">
						<input type="radio" name="optionsRadios" id="optionsRadios2" value="1">
						Masculino
					</label>
					<label class="radio inline">
						<input type="radio" name="optionsRadios" id="optionsRadios3" value="0">
						Ambos
					</label>


					<div class="space2"></div>
				</div>									
			</div>
			<?php */?>
		</form>
	</div>			
</div>
<div class="row-fluid">	
	<div class="space4"></div>	
</div>