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
						    	<h2>Galeria de videos</h2>
								</div>
								<div style="margin-top:15px;" class="span4">
										<button data-toggle="modal"  href="#add_video" class="btn btn-primary">Agregar Video</button>
								</div>
								<legend></legend>
							</div>

					    	<!-- CARGO EL MODAL-->
								<div id="add_video" class="modal hide fade" style="width: 430px !important;" tabindex="-1" role="dialog" aria-labelledby="AgregaVideo" aria-hidden="true">
									<form id="video_upload_form" action="<?php echo HOME.'/user/'?>" method="post">
										
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h3 id="myModalLabel">Agregar video</h3>
										</div>
										<div class="modal-body">
												<div>	
													<input name="url_ytb" style="width:96%" type="text" placeholder="Dirección - URL Video" value="">
													<input name="name_ytb" style="width:96%" type="text" placeholder="Nombre">
													<div class="space1"></div>	
													<textarea class="rich_textarea_pop_up" name="description_ytb" rows="6" placeholder="Descripción"></textarea>
													<input type="hidden" name="from_gallery" value="yes" />
													<div class="space1"></div>	
												</div>
										</div>
										<div class="modal-footer" style="height: 30px;">
											<button type="submit" class="btn btn-primary">Guardar</button>
											<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
										</div>
									</form>

								</div>
														
														
								
					    	
					    	
					    	
					    	
					    	
					    	
					    	
					    	<?php //var_dump($videos);
					    	//video[0] => titulo
					    	//video[1]=> link
					    	//video[2]=> descripcion
					    	//video[3] => id del video
					    	$i=0;
					    	foreach($videos as $video){
					    		$i++;
								if($i%2 == 0 )								
					    			echo '<div class="span6">';	
								else
									{
									echo '<div class="space1"></div>';
									echo '<div class="row">';
									echo '<div class="span6">';
									}		
									
					    	?>
					    			
					    			<div>
											<div style="height: 15px !important;" class="span10">
												<h3 id="profile" ><?php echo $video[0]; ?></h5>
											</div>
											<?php if(!$public) {?>
												<div style="margin-top: 20px;" class="span1">
													<a class="btn-del" title="Establecer como principal" href="<?php echo HOME."/user/video_gallery/1/".$video[3];?>" class="btn btn-primary"><i class="icon-star-empty"></i></a>
												</div>
												<div style="margin-top: 20px; margin-left: 1px;" class="span1">
													<a class="btn-del" title="Eliminar video" href="<?php echo HOME."/user/video_gallery/2/".$video[3];?>" class="btn btn-primary"><i class="icon-remove"></i></a>
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
					