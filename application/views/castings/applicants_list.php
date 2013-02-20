		  			<div class="row-fluid">		
				    	<div class="span3 user-profile-left">
				    		<img class='user_image' src="<?php echo HOME."/img/logo_hunter/".$user_data['logo'] ?>"/>
				    		<div class="space4"></div>
				    		
				    		<div class="span9 offset1">
					    		<ul class="nav nav-pills nav-stacked orange">
								  	<li><a href="<?php echo HOME."/hunter";?>"> <i class="icon-user"></i> Perfil</a> </li>
								  	<li><a href="<?php echo HOME."/hunter/edit/";?>"> <i class="icon-pencil"></i> Editar Datos</a></li>
								  	<li><a href="<?php echo HOME."/hunter/publish";?>"> <i class="icon-edit"></i> Nuevo Casting</a></li>
									<li class="active"><a> <i class="icon-list"></i> Mis Castings</a></li>
									<li><a href="<?php echo HOME."/hunter/logout";?>"> <i class="icon-off"></i> Cerrar Sesi&oacuten</a></li>					
								</ul>
							</div>
							
							<div class="span9 offset1">
								<select style="width:100%;">
									<option value="sin_revisar">Sin Revisar</option>
									<option value="aceptados">Aceptados</option>
									<option value="rechazados">Rechazados</option>
									<option value="todos">Todos</option>
								</select>
								
									<?php 
									
									echo form_multiselect('skills[]', $skills,NULL,"class='chzn-select' style='width:100%' data-placeholder='Selecciona los tags...'");
									?>
								<btn style="float:right;" class="btn btn"> Filtar</btn>
							</div>
					    </div>
					    
					    <div class="span8 offset1 user-profile-right">
					    		
					    	<div class="row">
								<div class="span11">
									<h3 class="profile-title"><a href="<?php echo HOME.'/hunter/casting_list' ?>">Castings/</a><a href="<?php echo HOME.'/hunter/casting_detail/'.$id_casting; ?>">Casting A/</a> Lista Postulantes </h3>
								</div>
								<div class="span1">
									<a href="<?php echo HOME."/hunter/finalize_casting/".$id_casting; ?>" style="height: 34px;" class="btn">
										<i style="margin-top: 8px;" class="icon-off"></i>
									</a>
								</div>
								<legend></legend>
							</div>
							<?php 
							if(isset($applicants))
								foreach ($applicants as $applicant) {
							?>

							<div class="row" style="margin-left:1px; width: 100%; height: 180px;"> 
					    		<div class="span7">
					    		<iframe width="100%" height="110%" src="http://www.youtube.com/embed/<?php echo $applicant['video_id']?>" frameborder="0" allowfullscreen></iframe>
					    		</div>
					    		<div class="span5">
						    		<row>
							    		<div class="span3">
							    			<img style="max-width: 75%; max-height: 75%;" src="<?php echo HOME.'/img/profile/'.$applicant["image_profile"] ?>"/>
										</div>
										<div class="span6">
											<p style="font-size: 12px;">
												<?php echo $applicant['name']; ?>
											</p>
										</div>
										<div class="span1">
											<a class="btn" href="<?php echo HOME.'/user/index/'.$applicant["id"] ?>">
												<i class="icon-search"></i>
											</a>
										</div>
									</row>
									<row>
										<div class="space2"></div>
										<?php
											if(isset($applicant['tags'])&& !empty($applicant['tags']) )
												{
											  		echo '<ul style="font-size: 8px;" class="skills-list">';
											  		foreach ($applicant['tags'] as $tag) {
													echo '<li> <a href="#">'.$tag.'</a></li>';
												}
												echo '</ul>';
											}
											else
												echo '<div class="space1"></div>'
										?>
									</row>
									
									<row>
							    		<p style="font-size: 12px; text-align:justify;">
											<?php echo substr(strip_tags($applicant['bio']),0,140)."...";?>
							    		</p>
									</row>
									
									<row style="float: right;">
										
										<a data-toggle="modal" <?php if($applicant["apply_state"]!=1) echo "href='#modal".$applicant["id"]."'"; ?>" style="text-align: right;" class="btn btn-success">
											<i class="icon-ok"></i>
										</a>
										
										<a <?php if($applicant["apply_state"]!=2) echo "href='".HOME."/hunter/reject_apply/".$applicant['apply_id']."/".$id_casting."'"; ?>"style="text-align: right;" class="btn btn-danger">
											<i class="icon-remove"></i>
										</a>
										
									</row>
									
									<div id="<?php echo "modal".$applicant["id"]; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  <form action="<?php echo HOME."/hunter/accept_apply/".$applicant['apply_id']."/".$id_casting; ?>" method="post">
										  <div class="modal-header">
										    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
										    <h3 id="myModalLabel">Observaciones</h3>
										  </div>
										  <div class="modal-body">
											<input name="observation" type="text" value="" placeholder="campo no obligatorio">
										  </div>
										  <div class="modal-footer">
										    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
										    <button type="input" class="btn btn-primary">Guardar</a>
										  </div>
									  </form>
									</div>
								</div>
							</div>
				
							<div class="space4"></div>
							
							<?php } ?>
						
								
						</div>
					</div>
					<div class="row-fluid">	
						<div class="space4"></div>	
					</div>