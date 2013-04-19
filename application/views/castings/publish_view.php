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
				
				<!--
				<h5>Filtros Predefinidos Optativos</h5>
				<?php 
				echo form_multiselect('filtros[]', $filtros,NULL,"class='chzn-select chosen_filter' style='width:60%' data-placeholder='Selecciona los filtros...'");
				?>
				-->
				
				
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
					
					
					<!-- SCRIPT PARA GENERAR FILAS EN LA TABLA -->
					<script>
						/**
						 * @param type Tipo de pregunta
						 * @param value Los valores de las posibles respuesta, en caso de ser de seleccion
						 */
						function addQuestionData(type,title,value)
						{	
							//obtener el numero de la pregunta previa
							var separador1 = '|$';
							var separador2 = '|*'; 
							var question_number = document.getElementsByClassName('pregunta').length; //numero de ultima pregunta ingresada
							var hidden_data = "<input type='hidden' value='type|$"+type+"|*title|$"+title+"|*valores|$"+value+"' class='pregunta' name='question_"+question_number+"' />";
							$('#tablapreguntas').find('tbody:last').append(hidden_data);
							 
							var reguleque = new RegExp('%#','g');
							
							value = value.replace(reguleque,',');
							$('#tablapreguntas').find('tbody:last').append("<tr><td>"+type+"</td><td>"+title+"</td><td>"+value+"</td></tr>");
							
						}
					</script>
					 
					<!-- enlaces creadores/llamadores de la funcion -->
					<a href="#latabla" onclick="addQuestionData('text','Preguntita','NADA')">AgregarTextual</a>
					<a href="#latabla" onclick="addQuestionData('select','Preguntass','op1%#op2%#op3')">AgregarSelect</a>
					<a href="#latabla" onclick="addQuestionData('multiselect','PreguntONAs','op1%#op2%#op3%#op4')">AgregarMultiSelect</a>
					
					
					
					<!-- LA TABLA DE PREGUNTAS -->
					<table id="tablapreguntas" name="latabla">
			          <thead>
			            <tr>
			              <th>Tipo</th>
			              <th>Titulo</th>
			              <th>Alternativas/Pregunta</th>
			            </tr>
			          </thead>
			          <tbody>   
			          </tbody>
			        </table>
			        <div class="space2">
			        </div>
		    	</div>
			     
				<button style="margin-top: 2%;"type="submit" class="btn btn-primary">Publicar casting</button>

			</div>
			
			<?php /* //FILTROS ESPACIALES ?>
			
			<script>
				$(function () {
				  $('#optional_filter_eyes').change(function () {                
				     $('#eyes').toggle(this.checked);
				  }).change(); //ensure visible state matches initially
				});
				
				$(function () {
				  $('#optional_filter_hair').change(function () {                
				     $('#hair').toggle(this.checked);
				  }).change(); //ensure visible state matches initially
				});
				
				$(function () {
				  $('#optional_filter_skin').change(function () {                
				     $('#skin').toggle(this.checked);
				  }).change(); //ensure visible state matches initially
				});
				
				$(function () {
				  $('#optional_filter_height').change(function () {                
				     $('#height').toggle(this.checked);
				  }).change(); //ensure visible state matches initially
				});
				
				$(function () {
				  $('#optional_filter_age').change(function () {                
				     $('#age').toggle(this.checked);
				  }).change(); //ensure visible state matches initially
				});
				
				$(function () {
				  $('#optional_filter_sex').change(function () {                
				     $('#sex').toggle(this.checked);
				  }).change(); //ensure visible state matches initially
				});
			</script>	
			<legend>Filtros Espaciales</legend>
			<div>	
				
				<div style="margin-left:15px;" class="row">
					<div class="span6">
					<h5>
						<input id="optional_filter_eyes" type="checkbox" />
						Color de ojos
					</h5>
					<select id='eyes' style="width: 100%;" name="eyes-color" >
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
					<h5>
						<input id="optional_filter_hair" type="checkbox" />
						Color de cabello
					</h5>
					<select id='hair' style="width: 100%;" name="hair-color">
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
						<h5>
							<input id="optional_filter_skin" type="checkbox" />
							Color de piel
						</h5>
						<select id='skin' style="width: 100%;" name="skin-color">
							<option value="Blanca">Blanca</option>
							<option value="Negra">Negra</option>
							<option value="Trigue&ntildea">Trigue&ntildea</option>
							<option value="Morena">Morena</option>
							<option value="Todos">Todos</option>
						</select>
					</div>
					
					<div class="span6">
						<h5>
							<input id="optional_filter_height" type="checkbox" />
							Estatura
							</h5>
						<select id='height' style="width: 100%;" name="height">
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
					
					<h5>
						<input id="optional_filter_age" type="checkbox" />
						Edad
					</h5> 
					<div id="age">
					<?php 
					echo form_multiselect('age[]', $age_list,NULL,"class='chzn-select chosen_filter age' style='width:60%' data-placeholder='Selecciona las edades...'");
					?>
					</div>
						<h5>
						<input id="optional_filter_sex" type="checkbox" />
						Sexo</h5>
						<div id="sex">
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
						</div>
					<div class="space2"></div>
				</div>									
			</div>
			<?php */ //FILTROS ESPACIALES?>
		</form>
	</div>			
</div>
<div class="row-fluid">	
	<div class="space4"></div>	
</div>