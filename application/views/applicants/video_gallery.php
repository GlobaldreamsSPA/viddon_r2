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
					    	<h2 class="legend">Galeria de videos</h2>
					    	<!-- CARGO EL MODAL-->
								<div id="add_video" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="AgregaVideo" aria-hidden="true">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h3 id="myModalLabel">Agregar video</h3>
									</div>
									<div class="modal-body">
										<form id="video_upload_form" action="<?php echo HOME.'/user/'?>" method="post">
											<div>	
												<input name="url_ytb" class="input-xlarge" type="text" placeholder="Dirección Video" value="">
												<input name="name_ytb" class="input-xlarge" type="text" placeholder="Nombre Video">
												<div class="space1"></div>	
												<textarea class="rich_textarea" name="description_ytb" rows="8" placeholder="Descripción Video"></textarea>
												<div class="space1"></div>	
												<input type="hidden" name="from_gallery" value="yes" />
												<button type="submit" class="btn btn-primary">Guardar</button>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
									</div>
								</div>
														
								<div>
									<button data-toggle="modal"  href="#add_video" class="btn btn-success">Agregar Video</button>
								</div>
					    	
					    	
					    	
					    	
					    	
					    	
					    	
					    	<?php //var_dump($videos);
					    	//video[0] => titulo
					    	//video[1]=> link
					    	//video[2]=> descripcion
					    	//video[3] => id del video
					    	foreach($videos as $video){
					    		if($video[3] == $id_main_video) echo "es el video principal";
					    	?>
					    		<iframe width="33%" height="100px" src="http://www.youtube.com/embed/<?php echo $video[1].'?rel=0'?>" frameborder="0" allowfullscreen></iframe>	
								<p>
								<?php echo $video[0]; ?><a class="btn-del" title="Eliminar video" href="<?php echo HOME."/user/video_gallery/2/".$video[3];?>">x</a>
								<?php echo $video[2]; ?><a class="btn-del" title="Establecer como principal" href="<?php echo HOME."/user/video_gallery/1/".$video[3];?>">B</a>
								</p>
								
						    <?php }?>	
						</div>
					    		
					    </div>		
					</div>