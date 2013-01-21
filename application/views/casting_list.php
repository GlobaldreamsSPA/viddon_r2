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
								  <li><a href="<?php echo HOME."/user";?>"> <i class="icon-user"></i> Perfil</a>
								  </li>
								  <li><a href="<?php echo HOME."/user/edit/".$user_id;?>"> <i class="icon-pencil"></i> Editar Datos</a></li>
								  <li class="active"><a> <i class="icon-star-empty"></i> Postulaciones</a></li>	
								  <li><a href="<?php echo HOME."/user/logout";?>"> <i class="icon-edit"></i> Cerrar Sesi&oacuten</a></li>					
								</ul>
							</div>
				    	</div>
				    
					    <div class="span8 offset1 user-profile-right">
					    		
			
							<div class="row">
								<div class="space1"></div>
								<div class="span6">
									<h3 class="list-view-title">Casting A Canal 13</h3>
								</div>
								<div class="span5 list-view-applies">
									<h5 class="list-view-applies-count span2"><p>50</p></h5>
									<h5 class="list-view-applies-text">Personas ya postularon</h5>
								</div>
								<div class="span11">
									<div class="span7">
										<img id="image_casting" src=<? echo HOME."/img/castings_dummy.png"?> />
									</div>
									<div class="space05"></div>
									<div class="span2">
										<img id="list-view-logo" src=<? echo HOME."/img/canal-13.jpg"?> />
									</div>
									<div class="span2 list-view-applies-desc">
										<h4 id="profile">Descripci&oacuten:</h4>
										<div class="justify profile-content">
											Se buscan Bandas con la pasi&oacuten para triunfar.
										</div>
										<h4 id="profile">Requisitos:</h4>
										<div class="justify profile-content">
											Banda Pop, Rock, Punk.
										</div>
										<h4 id="profile">Categor&iacutea:</h4>
										<div class="justify profile-content">
											Musica - Grupo
										</div>
										<div id="time">Quedan 132 d&iacuteas</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="space1"></div>
								<div class="span6">
									<h3 class="list-view-title">Casting A Canal 13</h3>
								</div>
								<div class="span5 list-view-applies">
									<h5 class="list-view-applies-count span2"><p>50</p></h5>
									<h5 class="list-view-applies-text">Personas ya postularon</h5>
								</div>
								<div class="span11">
									<div class="span7">
										<img id="image_casting" src=<? echo HOME."/img/castings_dummy.png"?> />
									</div>
									<div class="space05"></div>
									<div class="span2">
										<img id="list-view-logo" src=<? echo HOME."/img/canal-13.jpg"?> />
									</div>
									<div class="span2 list-view-applies-desc">
										<h4 id="profile">Descripci&oacuten:</h4>
										<div class="justify profile-content">
											Se buscan Bandas con la pasi&oacuten para triunfar.
										</div>
										<h4 id="profile">Requisitos:</h4>
										<div class="justify profile-content">
											Banda Pop, Rock, Punk.
										</div>
										<h4 id="profile">Categor&iacutea:</h4>
										<div class="justify profile-content">
											Musica - Grupo
										</div>
										<div id="time">Quedan 132 d&iacuteas</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="space1"></div>
								<div class="span6">
									<h3 class="list-view-title">Casting A Canal 13</h3>
								</div>
								<div class="span5 list-view-applies">
									<h5 class="list-view-applies-count span2"><p>50</p></h5>
									<h5 class="list-view-applies-text">Personas ya postularon</h5>
								</div>
								<div class="span11">
									<div class="span7">
										<img id="image_casting" src=<? echo HOME."/img/castings_dummy.png"?> />
									</div>
									<div class="space05"></div>
									<div class="span2">
										<img id="list-view-logo" src=<? echo HOME."/img/canal-13.jpg"?> />
									</div>
									<div class="span2 list-view-applies-desc">
										<h4 id="profile">Descripci&oacuten:</h4>
										<div class="justify profile-content">
											Se buscan Bandas con la pasi&oacuten para triunfar.
										</div>
										<h4 id="profile">Requisitos:</h4>
										<div class="justify profile-content">
											Banda Pop, Rock, Punk.
										</div>
										<h4 id="profile">Categor&iacutea:</h4>
										<div class="justify profile-content">
											Musica - Grupo
										</div>
										<div id="time">Quedan 132 d&iacuteas</div>
									</div>
								</div>
							</div>
							<div class="space4"></div>	
							<div class="space4"></div>						
						</div>					
					</div>
				</div>
			</div>	
		
			<div class="span4">
				<div class="span3">
					<div  style="border-radius: 25px; padding: 35px; min-width: 290px;" class="row-fluid">
						<h3 id="profile" >Casting recomendado</h3>
						<img style="margin-top: 16px;" src="<?php echo HOME.'/img/mini_banner_c1.png';?>">
		  				<div class="space2"></div>
						<h3 id="profile" >Galeria Videos</h3>
						<img style="margin-top: 16px;" src="<?php echo HOME.'/img/dummy_galeria_videos.png';?>">
		  				<a style="text-decoration: underline; float: right;" ref="#">(Ver mas)</a>
		  				<div class="space2"></div>						
						<h3 id="profile" >Galeria Fotos</h3>
						<img style="margin-top: 16px;"  src="<?php echo HOME.'/img/dummy_galeria_fotos.png';?>">
						<a style="text-decoration: underline; float: right;" ref="#">(Ver mas)</a>
						<div class="space4"></div>
					</div>
				</div>
			</div>
			
		</div>
		
		</div>
</div>