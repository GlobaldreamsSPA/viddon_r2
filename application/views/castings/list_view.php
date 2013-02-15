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
				    	</div>
					    
					    <div class="span8 offset1 user-profile-right">
					    		
							<legend><h3 class="profile-title"> Castings Publicados </h3></legend>
							<?php foreach($castings as $casting){ ?>
							<div class="row">
								<div class="space1"></div>
								<div class="row">
									
									<div style="margin-left: 5%" class="span1">
				    					<img src="<?php echo $casting['logo'] ?>"/>
									</div>
									<div class="span6">
										<h4 ><?php echo $casting['title'] ?></h4>
									</div>
									
								</div>

								<div class="span11">
									<div class="span7">
										<a href="<?php echo site_url("home/casting_detail/".$casting['id']); ?>">
											<img style='height:100%; width: 100%;' src="<?php echo $casting['image'] ?>"/>
										</a>
									</div>
									<div class="space05"></div>
									<div class="span5 list-view-applies-desc">
																													
										<div class="row list-view-applies">
											<div class="span7">
												<h5 class="list-view-applies-text">Postulaciones:</h5>
											</div>
											<div style="margin-top: 7%;" class="span3 offset2">
												<p ><?php echo $casting['applies'] ?></p>
											</div>									
										</div>

										<div class="row list-view-applies">
											<div class="span7">
												<label>Estado:</label>
											</div>
											<div class="span3 offset2">
										 		<span class="label label-info"><?php echo $casting['status'] ?></span>
											</div>
										</div>
										
										<div class="row list-view-applies">
											<div style="margin-top:2%;" class="span7">
												<i class="icon-time"></i> <?php echo $casting['days'] ?> d&iacute;as
											</div>
											<div  class"span5">
												<a style="margin-left: 10%;" class="btn btn-info" href="<?php echo site_url("hunter/casting_detail/"/*.$casting['id']*/); ?>" type="button"><i class="icon-zoom-in"></i></a>
											</div>
										</div>	
										
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="row-fluid">	
						<div class="space4"></div>	
					</div>
