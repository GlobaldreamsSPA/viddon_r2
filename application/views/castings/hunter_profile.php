	  			<div class="row-fluid">		
				    	<div class="span3 user-profile-left">
				    		<img class='user_image' src="<?php echo HOME."/img/logo_hunter/".$user_data['logo'] ?>"/>
				    		<div class="space4"></div>
				    		
				    		<div class="span9 offset1">
					    		<ul class="nav nav-pills nav-stacked orange">
									<li class="active"><a> <i class="icon-user"></i> Perfil</a></li>
								 	<li><a href="<?php echo HOME."/hunter/publish";?>"> <i class="icon-pencil"></i> Nuevo Casting</a></li>
								 	<li><a href="<?php echo HOME."/hunter/casting_list";?>"> <i class="icon-edit"></i> Mis Castings</a></li>
									<li><a href="<?php echo HOME."/hunter/logout";?>"> <i class="icon-off"></i> Cerrar Sesi&oacuten</a></li>					
								</ul>
							</div>
				    	</div>
					    
					    <div class="span9 user-profile-right">
					    		
					    	<div class="space1"></div>
					    	<h1 class="profile-title"><?php echo $user_data['name'] ?></h1> 
							<div class="space1"></div>
							<h3 id="profile">Nosotros</h3>
							<div class="justify profile-content"><?php echo $user_data['about_us'] ?></div>
							<div class="space1"></div>
							<h3 id="profile">Buscamos</h3>
							<div class="justify profile-content"><?php echo $user_data['we_look_for'] ?></div>
							<div class="space1"></div>
											
						</div>
						<div class="span2 user-profile-lateral">
					</div>
					</div>
		
					<div class="row-fluid">	
						<div class="space4"></div>	
					</div>
		
					<div class="row-fluid">
						<div class="span9 offset3 user-profile-right">
								
							<legend>Nuestros Castings</legend>
							
							<div style="margin-left:75px; margin-top:30px; height: 250px; width: 450px;" id="myCarousel" class="carousel slide">
							<!-- Carousel items -->
								<div class="carousel-inner">
									<?php ?>
								    <div class="active item">
										<img style="width:100%; height:100%;" id="image_casting" src=<? echo HOME."/img/casting_image/castings_dummy.png"?> />
									</div>
									<?php ?>
							  	</div>
								<!-- Carousel nav -->
								<a style="margin-top:5%; margin-left: 10px;" class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
								<a style="margin-top:5%;" class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
							</div>
							
							<div class="space2"></div>	
							
							<a style="text-decoration: underline; float: right;" href="<?php echo HOME."/hunter/casting_list";?>"> (Ver Todos Los Castings)</a>
							<div class="space2"></div> 				
						</div>
					</div>