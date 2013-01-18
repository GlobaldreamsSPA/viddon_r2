
<div id="success" class="modal hide fade in">
<div class="modal-header">
<a class="close" data-dismiss="modal">×</a>
</div>
<div class="modal-body">
<h4>Felicidades!</h4>
<p>Tu inscripcion ha sido realizada</p>
</div>
<div class="modal-footer">
<?php echo anchor(HOME,'Volver al Home',"class='btn btn-green'"); ?>
<a href="#" class="btn" data-dismiss="modal">Close</a>
</div>
</div>

<div id="error" class="modal hide fade in">
<div class="modal-header">
<a class="close" data-dismiss="modal">×</a>  
</div>
<div class="modal-body">
<h4>Aviso</h4>
<p><?php if(isset($postulation_message)) echo $postulation_message; ?></p>              
</div>
<div class="modal-footer">
<?php echo anchor(HOME,'Volver al Home',"class='btn btn-green'"); ?>
<a href="#" class="btn" data-dismiss="modal">Volver al Perfil</a>
</div>
</div>

<div id="del-video" class="modal hide fade in" >
<div class="modal-header">  
<a class="close" data-dismiss="modal">×</a> 
</div>
<div class="modal-body">
<h4>Aviso</h4>
<p><?php if(isset($delete_video_message)) echo $delete_video_message; ?></p>      
</div>
<div class="modal-footer">
<?php echo anchor('user', 'Volver al Perfil',"class='btn'") ?>
</div>
</div>

<?php if($success_flag){ ?>
<script type="text/javascript">

  $('#success').modal({
    show: true
  });
</script>
<?php } ?>

<?php if(isset($delete_video_message)){ ?>
<script type="text/javascript">

  $('#del-video').modal({
    show: true
  });
</script>
<?php } ?>

<div class="content" id="content">
	<div class="container-fluid">
	  	<div class="row">
	  		<div class="span9">
	  			<div  style="border-radius: 25px; padding: 25px;" class="row-fluid">
		  			<div class="row-fluid">		
				    	<div class="span3 user-profile-left">
				    		<?php 
				    			if(file_exists(APPPATH.'/../img/profile/'.$image_profile) == TRUE)
				    				echo "<img class='user_image' src='".HOME.'/img/profile/'.$image_profile."'/>";
				    			else
				    				echo "<img class='user_image' src='".HOME."/img/profile/user.jpg'/>";
				    		?>
							<?php if(!$public) {?>
							<form action="" method="POST">
								<?php if($postulation_flag) {?>
								<button id="participate_button" class="btn btn-large btn-success" type="submit" name="apply">POSTULAR CASTINGS</button>
								<input type="hidden" name="validate" value="1"/>
								<?php } else{ ?>
								<button data-toggle="modal" id="participate_button" href="#error" class="btn btn-success btn-large">POSTULAR CASTINGS</button>
				    			<?php } ?>
				    		</form>
				    		<?php } ?>
				    		
				    		<div class="span9 offset1">
				    			<div class="space4"></div>
					    		<ul class="nav nav-pills nav-stacked orange">
								  <li class="active">
								    <a> <i class="icon-user"></i> Perfil</a>
								  </li>
								  <li><a href="<?php echo HOME."/user/edit/".$user_id;?>"> <i class="icon-pencil"></i> Editar Datos</a></li>
								  <li><a href="#"> <i class="icon-star-empty"></i> Postulaciones</a></li>	
								  <li><a href="<?php echo HOME."/user/logout";?>"> <i class="icon-edit"></i> Cerrar Sesi&oacuten</a></li>					
								</ul>
							</div>
				    	</div>
				    
					    <div class="span8 offset1 user-profile-right">
					    		
					    	<div class="space1"></div>
					    	<h1 class="profile-title"> <?php echo $name; ?> 
					    	</h1> 
							<div class="fb-like" data-send="true" data-layout="button_count" data-width="450" data-show-faces="false"></div>
					    	<?php
					    		echo '<ul class="skills-list">';
					    		foreach ($tags as $tag) {
									echo '<li> <a href="#">'.$tag.'</a></li>';
								}
								echo '</ul>';
							?>
							<div class="space1"></div>
							<h3 id="profile">Mi Historia</h2>
							<div class="justify profile-content"><?php echo $bio;?></div>
							<div class="space1"></div>
							
							<h3 id="profile">Mis Hobbies</h2>
							<div class="justify profile-content"><?php echo $hobbies;?></div>
							<div class="space1"></div>
							
							<h3 id="profile">Mis Sueños</h2>
							<div class="justify profile-content"><?php echo $dreams;?></div>
							<div class="space1"></div>
							
						</div>
					
						<div class="space4"></div>	
	
					</div>
					<div class="row-fluid">
						<div class="span8 offset4 user-profile-right">
							<legend style="font-weight: bold;">Video Principal</legend>
							<?php if(isset($video_ID)){?>
								
								<div class="justify video-title">
									<div class="span9">
										<h3 id="profile" ><?php echo $video_title;?></h5>
									</div>
									<?php if(!$public) {?>
										<form action="" method="POST">
											<button style="margin-top:20px; margin-left:20px;" type="submit"><i class="icon-remove"></i></button>
											<input type="hidden" name="del-video" value="<?php echo $video_ID ?>"/>
										</form>
									<?php } ?>
				
								</div>
								<iframe width="500" height="300" src="http://www.youtube.com/embed/<?php echo $video_ID?>" frameborder="0" allowfullscreen></iframe>
								<div class="space05"></div>
								<!--
								<div class="social_data_container">			
									<div class="fb-like" data-href="http://www.youtube.com/watch?v=<?php echo $video_ID ?>" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>			    							
									<label class="youtubedata">
									<?php
										//echo "<span id='youtubedata' class='badge badge-important'><i class='icon-thumbs-down icon-white'></i>$dislikes</span>";
										//echo "<span id='youtubedata' class='badge badge-success'><i class='icon-thumbs-up icon-white'></i>$likes</span>";
										//echo "<span id='youtubedata' class='badge badge-info'><i class='icon-eye-open '></i>$views</span>";
										
									?>
									</label>
								</div>
								-->
								<div class="justify"><?php echo $video_description;?></div>				
								
							<?php 
							} 
							else
							{?>
														
							
							<form id="video_upload_form" action="" method="post">
								 
						
								<div>
										
									<input name="url_ytb" class="input-xxlarge" type="text" placeholder="Dirección Video" value="">
									<input name="name_ytb" class="input-xxlarge" type="text" placeholder="Nombre Video">
									<div class="space1"></div>	
									<textarea name="description_ytb" class="input-xxlarge" rows="8" placeholder="Descripción Video"></textarea>
									<div class="space1"></div>	
									<button type="submit" class="btn btn-primary">Guardar</button>					
								
								</div>
							</form>
							<?php
							}
							?>
							<div class="space4"></div>	
						</div>				
					</div>

				</div>
			</div>	
		
			<div class="span4">
				<div class="span3">
					<div  style="border-radius: 25px; padding: 35px; min-width: 290px;" class="row-fluid">
						<h3>Casting recomendado</h3>
						<img style="margin-top: 16px;" src="<?php echo HOME.'/img/mini_banner_c1.png';?>">
		  				<div class="space2"></div>
						<h3>Galeria Videos</h3>
						<img style="margin-top: 16px;" src="<?php echo HOME.'/img/dummy_galeria_videos.png';?>">
		  				<a style="text-decoration: underline; float: right;" ref="#">(Ver mas)</a>
		  				<div class="space2"></div>						
						<h3>Galeria Fotos</h3>
						<img style="margin-top: 16px;"  src="<?php echo HOME.'/img/dummy_galeria_fotos.png';?>">
						<a style="text-decoration: underline; float: right;" ref="#">(Ver mas)</a>
						<div class="space4"></div>
					</div>
				</div>
			</div>
			
		</div>
		
		</div>
</div>

