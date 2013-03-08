		  			<div class="row-fluid">		
				    	<div class="span3 user-profile-left">
				    		<div class="row">
				    		<?php 
				    			if(file_exists(APPPATH.'/../img/profile/'.$image_profile) == TRUE)
				    				echo "<img class='user_image' src='".HOME.'/img/profile/'.$image_profile."'/>";
				    			else
				    				echo "<img class='user_image' src='".HOME."/img/profile/user.jpg'/>";
				    		?>
				    		</div>
				    		<div class="space2"></div>
				    		<div class="row">
								<?php if(!$public) {?>
								<form action="" method="POST">
									<?php if($postulation_flag) {?>
									<a href="<?php echo HOME.'/home/casting_list'?>" class="btn btn-success" type="submit" name="apply">POSTULAR CASTINGS</a>
									<input type="hidden" name="validate" value="1"/>
									<?php } else{ ?>
									<button data-toggle="modal"  href="#error" class="btn btn-success">POSTULAR CASTINGS</button>
					    			<?php } ?>
					    		</form>
					    		<?php } ?>
				    		</div>
				    		<?php if(!$public) {?>
				    		<div class="row">
					    		<div class="span9 offset1">					    			
					    			<ul class="nav nav-pills nav-stacked orange">
										<li class="active"><a href="<?php echo HOME."/user/";?>"> <i class="icon-user"></i> Perfil</a>
										</li>
										<li><a href="<?php echo HOME."/user/edit/".$user_id;?>"> <i class="icon-pencil"></i> Editar Datos</a></li>
										<li>
											<a data-toggle="collapse" href="#collapseOne">
												<i class="icon-star-empty"></i> Postulaciones
											</a>
											<div id="collapseOne" class="collapse">
												<ul style="padding-left: 30px;" class="nav nav-pills nav-stacked orange">
													<li><a href="<?php echo HOME."/user/active_casting_list"?>">Activas</a></li>	
													<li><a href="<?php echo HOME."/user/results_casting"?>">Resultados</a></li>	
												</ul>
											</div>
										</li>	
										<li><a href="<?php echo HOME."/user/logout";?>"> <i class="icon-off"></i> Cerrar Sesi&oacuten</a></li>					
									</ul>
								</div><!--NAVEGACION LATERAL IZQUIERDA -->
				    		</div>
				    		<?php } ?>
				    	</div>
				    
					    <div class="span8 offset1 user-profile-right"> <!-- CARGAREMOS LOS DATOS DE LA GALERIA -->
							<div class="row">
								<div class="span8">
						    	<h2>Galeria de Fotos</h2>
								</div>			
								<div style="margin-top:15px;" class="span4">
									<button data-toggle="modal"  href="#add_photo" class="btn btn-primary">Agregar foto</button>
								</div>
							</div>
							
							<!-- CARGO EL MODAL-->
							<div id="add_photo" class="modal hide fade" style="width: 430px !important;" tabindex="-1" role="dialog" aria-labelledby="AgregaVideo" aria-hidden="true">
								<form id="photo_upload_form" action="<?php echo HOME.'/user/'?>" method="post">
									
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h3 id="myModalLabel">Agregar fotografia</h3>
									</div>
									<div class="modal-body">
											<div>	
												<input name="url_ytb" style="width:96%" type="text" placeholder="Dirección - URL foto" value="">
												ó											
												<div style="margin-left: -10px; margin-top: -20px;" id="image_upload">
												<h5>Sube una imagen de t&iacute</h5>
												<?php echo form_upload(array('name' => 'image_profile','id'=> 'file')); ?>
												<?php 
													  echo form_hidden('image','');
													  echo form_error('image'); 
												?>
												</div>
												<input type="hidden" name="from_gallery" value="yes" />
												<div class="space1"></div>	
											</div>
									</div>
									<div class="modal-footer" style="height: 30px;">
										<button type="submit" class="btn btn-primary">Guardar</button>
										<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
									</div>
								</form>
							</div>    	<!-- MODAL-->

								
			 <ul class="thumbnails">
            <li class="span4">
              <a href="#" class="thumbnail">
			<img data-src="holder.js/160x120" alt="160x120" style="width: 160px; height: 120px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAAB4CAYAAAB1ovlvAAAELklEQVR4Xu3YzUtiUQCG8WNiUdGusF1I29wEYfTvtyoh2kXrcKurgrCP4Rw4cubOvY4zCo90n1kVk77y3B/3w850Ov0O/rMAVKAjQKi8s6mAAIWAFhAgmt9xAWoALSBANL/jAtQAWkCAaH7HBagBtIAA0fyOC1ADaAEBovkdF6AG0AICRPM7LkANoAUEiOZ3XIAaQAsIEM3vuAA1gBYQIJrfcQFqAC0gQDS/4wLUAFpAgGh+xwWoAbSAANH8jgtQA2gBAaL5HRegBtACAkTzOy5ADaAFBIjmd1yAGkALCBDN77gANYAWECCa33EBagAtIEA0v+MC1ABaQIBofscFqAG0gADR/I4LUANoAQGi+R0XoAbQAgJE8zsuQA2gBQSI5ndcgBpACwgQze+4ADWAFhAgmt9xAWoALSBANL/jAtQAWqA1AL++vsLd3V14e3sLNzc3YX9/P4X/+PgIt7e34fPzM/3e7/fDcDhMP0+n0/D4+Bjia+O/i4uLcHp6utIBa9p7eXkJz8/Pi/cYDAbh/Px87b2VPtQW/lErAJbIOp3OAmBGsrOzE0ajUXh4eEjoIrTj4+ME8+DgYPF/EW/8u16vt/RQNu1l0CcnJwn509NTmEwma+9toauVP9KPB1g9w5UAM4izs7PFWSiXy2eqfIbKv0ecu7u76cx4eHiYQNZBymfUcq96VMqN+J7xzFi3t+pZd+WjvkV/2AqA4/E4XF5epjNceQnOAPb29sL7+3s6LFUATb/H95rNZuH6+jrc398vzpQRfNNe9biXcOfzeS3A8hK9RW429lF+PMBcqu6eLAPI933lJTjiipfHJoBNl9lle+VRy/iPjo5+O4s27W3siG/ZG7UaYNNlNiJouiSWZ6QMtnxwWQVgvvTHjXxPueyz5IeULbOzkY/TaoDVe8B/uSfLr40PJPHyXX1C/ttTd3xd+UCz7J7Te8CNWGffpA5E3VNwvPTGr2kikKan4G63m77SiQ8aV1dX6d4y/lyCWrb3+vr6B9h8Sf+fp2627HrrrT4DxnTVp+TyTNb0PWC+d6zer5WX4jqA1e8A86HL77PO947rMeBe3RqAXGKXlxUQoD7QAgJE8zsuQA2gBQSI5ndcgBpACwgQze+4ADWAFhAgmt9xAWoALSBANL/jAtQAWkCAaH7HBagBtIAA0fyOC1ADaAEBovkdF6AG0AICRPM7LkANoAUEiOZ3XIAaQAsIEM3vuAA1gBYQIJrfcQFqAC0gQDS/4wLUAFpAgGh+xwWoAbSAANH8jgtQA2gBAaL5HRegBtACAkTzOy5ADaAFBIjmd1yAGkALCBDN77gANYAWECCa33EBagAtIEA0v+MC1ABaQIBofscFqAG0gADR/I4LUANoAQGi+R0XoAbQAgJE8zsuQA2gBQSI5ndcgBpACwgQze+4ADWAFvgFNNYD7Zg81vEAAAAASUVORK5CYII=">              </a>
            </li>
            <li class="span4">
              <a href="#" class="thumbnail">
<img data-src="holder.js/160x120" alt="160x120" style="width: 160px; height: 120px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAAB4CAYAAAB1ovlvAAAELklEQVR4Xu3YzUtiUQCG8WNiUdGusF1I29wEYfTvtyoh2kXrcKurgrCP4Rw4cubOvY4zCo90n1kVk77y3B/3w850Ov0O/rMAVKAjQKi8s6mAAIWAFhAgmt9xAWoALSBANL/jAtQAWkCAaH7HBagBtIAA0fyOC1ADaAEBovkdF6AG0AICRPM7LkANoAUEiOZ3XIAaQAsIEM3vuAA1gBYQIJrfcQFqAC0gQDS/4wLUAFpAgGh+xwWoAbSAANH8jgtQA2gBAaL5HRegBtACAkTzOy5ADaAFBIjmd1yAGkALCBDN77gANYAWECCa33EBagAtIEA0v+MC1ABaQIBofscFqAG0gADR/I4LUANoAQGi+R0XoAbQAgJE8zsuQA2gBQSI5ndcgBpACwgQze+4ADWAFhAgmt9xAWoALSBANL/jAtQAWqA1AL++vsLd3V14e3sLNzc3YX9/P4X/+PgIt7e34fPzM/3e7/fDcDhMP0+n0/D4+Bjia+O/i4uLcHp6utIBa9p7eXkJz8/Pi/cYDAbh/Px87b2VPtQW/lErAJbIOp3OAmBGsrOzE0ajUXh4eEjoIrTj4+ME8+DgYPF/EW/8u16vt/RQNu1l0CcnJwn509NTmEwma+9toauVP9KPB1g9w5UAM4izs7PFWSiXy2eqfIbKv0ecu7u76cx4eHiYQNZBymfUcq96VMqN+J7xzFi3t+pZd+WjvkV/2AqA4/E4XF5epjNceQnOAPb29sL7+3s6LFUATb/H95rNZuH6+jrc398vzpQRfNNe9biXcOfzeS3A8hK9RW429lF+PMBcqu6eLAPI933lJTjiipfHJoBNl9lle+VRy/iPjo5+O4s27W3siG/ZG7UaYNNlNiJouiSWZ6QMtnxwWQVgvvTHjXxPueyz5IeULbOzkY/TaoDVe8B/uSfLr40PJPHyXX1C/ttTd3xd+UCz7J7Te8CNWGffpA5E3VNwvPTGr2kikKan4G63m77SiQ8aV1dX6d4y/lyCWrb3+vr6B9h8Sf+fp2627HrrrT4DxnTVp+TyTNb0PWC+d6zer5WX4jqA1e8A86HL77PO947rMeBe3RqAXGKXlxUQoD7QAgJE8zsuQA2gBQSI5ndcgBpACwgQze+4ADWAFhAgmt9xAWoALSBANL/jAtQAWkCAaH7HBagBtIAA0fyOC1ADaAEBovkdF6AG0AICRPM7LkANoAUEiOZ3XIAaQAsIEM3vuAA1gBYQIJrfcQFqAC0gQDS/4wLUAFpAgGh+xwWoAbSAANH8jgtQA2gBAaL5HRegBtACAkTzOy5ADaAFBIjmd1yAGkALCBDN77gANYAWECCa33EBagAtIEA0v+MC1ABaQIBofscFqAG0gADR/I4LUANoAQGi+R0XoAbQAgJE8zsuQA2gBQSI5ndcgBpACwgQze+4ADWAFvgFNNYD7Zg81vEAAAAASUVORK5CYII=">              </a>
            </li>
            <li class="span4">
              <a href="#" class="thumbnail">
<img data-src="holder.js/160x120" alt="160x120" style="width: 160px; height: 120px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAAB4CAYAAAB1ovlvAAAELklEQVR4Xu3YzUtiUQCG8WNiUdGusF1I29wEYfTvtyoh2kXrcKurgrCP4Rw4cubOvY4zCo90n1kVk77y3B/3w850Ov0O/rMAVKAjQKi8s6mAAIWAFhAgmt9xAWoALSBANL/jAtQAWkCAaH7HBagBtIAA0fyOC1ADaAEBovkdF6AG0AICRPM7LkANoAUEiOZ3XIAaQAsIEM3vuAA1gBYQIJrfcQFqAC0gQDS/4wLUAFpAgGh+xwWoAbSAANH8jgtQA2gBAaL5HRegBtACAkTzOy5ADaAFBIjmd1yAGkALCBDN77gANYAWECCa33EBagAtIEA0v+MC1ABaQIBofscFqAG0gADR/I4LUANoAQGi+R0XoAbQAgJE8zsuQA2gBQSI5ndcgBpACwgQze+4ADWAFhAgmt9xAWoALSBANL/jAtQAWqA1AL++vsLd3V14e3sLNzc3YX9/P4X/+PgIt7e34fPzM/3e7/fDcDhMP0+n0/D4+Bjia+O/i4uLcHp6utIBa9p7eXkJz8/Pi/cYDAbh/Px87b2VPtQW/lErAJbIOp3OAmBGsrOzE0ajUXh4eEjoIrTj4+ME8+DgYPF/EW/8u16vt/RQNu1l0CcnJwn509NTmEwma+9toauVP9KPB1g9w5UAM4izs7PFWSiXy2eqfIbKv0ecu7u76cx4eHiYQNZBymfUcq96VMqN+J7xzFi3t+pZd+WjvkV/2AqA4/E4XF5epjNceQnOAPb29sL7+3s6LFUATb/H95rNZuH6+jrc398vzpQRfNNe9biXcOfzeS3A8hK9RW429lF+PMBcqu6eLAPI933lJTjiipfHJoBNl9lle+VRy/iPjo5+O4s27W3siG/ZG7UaYNNlNiJouiSWZ6QMtnxwWQVgvvTHjXxPueyz5IeULbOzkY/TaoDVe8B/uSfLr40PJPHyXX1C/ttTd3xd+UCz7J7Te8CNWGffpA5E3VNwvPTGr2kikKan4G63m77SiQ8aV1dX6d4y/lyCWrb3+vr6B9h8Sf+fp2627HrrrT4DxnTVp+TyTNb0PWC+d6zer5WX4jqA1e8A86HL77PO947rMeBe3RqAXGKXlxUQoD7QAgJE8zsuQA2gBQSI5ndcgBpACwgQze+4ADWAFhAgmt9xAWoALSBANL/jAtQAWkCAaH7HBagBtIAA0fyOC1ADaAEBovkdF6AG0AICRPM7LkANoAUEiOZ3XIAaQAsIEM3vuAA1gBYQIJrfcQFqAC0gQDS/4wLUAFpAgGh+xwWoAbSAANH8jgtQA2gBAaL5HRegBtACAkTzOy5ADaAFBIjmd1yAGkALCBDN77gANYAWECCa33EBagAtIEA0v+MC1ABaQIBofscFqAG0gADR/I4LUANoAQGi+R0XoAbQAgJE8zsuQA2gBQSI5ndcgBpACwgQze+4ADWAFvgFNNYD7Zg81vEAAAAASUVORK5CYII=">              </a>
            </li>
          </ul>
								    	
					    	<ul class="thumbnails"> <!-- ABRE LOS THUMBNAILS -->
					    	<?php //var_dump($videos);
					    	//video[0] => titulo
					    	//video[1]=> link
					    	//video[2]=> descripcion
					    	//video[3] => id del video
					    	$i=0;
					    	foreach($photos as $photo){
					    		$i++;
								if($i%2 == 0 )								
					    			echo '<li class="span4">';									
					    	?>
					    			
					    			<div>
											<div style="height: 15px !important;" class="span10">
												<h3 id="profile" ><?php echo $photo[0]; ?></h5>
											</div>
											<?php if(!$public) {?>
												<div style="margin-top: 20px;" class="span1">
													<a class="btn-del" title="Establecer como foto de perfil" href="<?php echo HOME."/user/photo_gallery/1/".$photo[3];?>" class="btn btn-primary"><i class="icon-star-empty"></i></a>
												</div>
												<div style="margin-top: 20px; margin-left: 1px;" class="span1">
													<a class="btn-del" title="Eliminar foto" href="<?php echo HOME."/user/photo_gallery/2/".$video[3];?>" class="btn btn-primary"><i class="icon-remove"></i></a>
												</div>
												
											<?php } ?>
									</div>
						    		<iframe width="96%" height="180px" src="http://www.youtube.com/embed/<?php echo $video[1].'?rel=0'?>" frameborder="0" allowfullscreen></iframe>	
									
								</div>
						    <?php 
							if($i%2 == 0 )								
					    			echo '</div>';	
							if($i%2 != 0 && $i == count($videos))
									echo '</div>';	
								
							}?>	
						</div>
						</div>
					