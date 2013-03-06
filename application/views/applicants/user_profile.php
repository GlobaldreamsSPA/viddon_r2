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
				<li class="active"><a> <i class="icon-user"></i> Perfil</a>
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
		</div>
	</div>
	<?php } ?>
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

	<div class="space4"></div>						

	<legend style="font-weight: bold;">Video Principal</legend>
	<?php if(isset($video_ID)){?>
		
		<div class="justify video-title">
			<div class="span9">
				<h3 id="profile" ><?php echo $video_title;?></h5>
			</div>
			<?php if(!$public) {?>
				<div style="margin-top: 20px;" class="span3">
					<a href="<?php echo HOME.'/user/video_gallery/'?>" style="width:70% !important;"class="btn btn-primary" type="submit" name="apply"><i class="icon-film"></i> Galeria</a>
				</div>
			<?php } ?>

		</div>
		<iframe width="100%" height="300" src="http://www.youtube.com/embed/<?php echo $video_ID."?rel=0";?>" frameborder="0" allowfullscreen></iframe>
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
		
		<div id="facebook" style="padding-top:40px;">
			<form name="frm">
				<br>
					<textarea style="width: 97%;" type="text" name="comment" id="comment" Placeholder="Escribe un comentario..."></textarea>
				<br>
				<div id="post1">
					<input type="button" class="btn"  value="Comentar" onclick="get()"/>										
				</div>
			</form>
		</div>
		<div id="facebook1">
			<div id="post" style="width: 97%;">
		 	</div>
		 </div>				
		
	<?php 
	} 
	else
	{?>
		<!-- CARGO EL MODAL-->
		<div id="add_video" class="modal hide fade" style="width: 430px !important;" tabindex="-1" role="dialog" aria-labelledby="AgregaVideo" aria-hidden="true">
			<form id="video_upload_form" action="" method="post">
				
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
							<div class="space1"></div>	
						</div>
				</div>
				<div class="modal-footer" style="height: 30px;">
					<button type="submit" class="btn btn-primary">Guardar</button>
					<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
				</div>
			</form>

		</div>
								
		<div style="padding-left: 38%; background-color: black; padding-top: 30%; padding-bottom: 30%;  border: 1px solid #d0d0d0;">
			<button data-toggle="modal"  href="#add_video" class="btn btn-primary">Agregar Video</button>
		</div>
	
	<?php
	/*
	<form id="video_upload_form" action="" method="post">
		 

		<div>
				
			<input name="url_ytb" class="input-xlarge" type="text" placeholder="Dirección Video" value="">
			<input name="name_ytb" class="input-xlarge" type="text" placeholder="Nombre Video">
			<div class="space1"></div>	
			<textarea class="rich_textarea" name="description_ytb" rows="8" placeholder="Descripción Video"></textarea>
			<div class="space1"></div>	
			<button type="submit" class="btn btn-primary">Guardar</button>					
		
		</div>
	</form>
	*/
	}
	?>																
</div>		
</div>