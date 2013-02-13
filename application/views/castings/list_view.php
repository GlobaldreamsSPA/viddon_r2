		  			<div class="row-fluid">		
				    	<div class="span3 user-profile-left">
				    		<img class='user_image' src="<?php echo HOME."/img/logo_hunter/".$user_data['logo'] ?>"/>
				    		<div class="space4"></div>
				    		
				    		<div class="span9 offset1">
					    		<ul class="nav nav-pills nav-stacked orange">
								  	<li><a href="<?php echo HOME."/hunter";?>"> <i class="icon-user"></i> Perfil</a> </li>
								  	<li><a href="<?php echo HOME."/hunter/publish";?>"> <i class="icon-pencil"></i> Nuevo Casting</a></li>
									<li class="active"><a> <i class="icon-edit"></i> Mis Castings</a></li>
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
									<div style="margin-top: 13px;" class="span1 offset1">
				    					<img class='list_view_logo' src="<?php echo $casting['logo'] ?>"/>
									</div>
									<div class="span5">
										<h4 class="list-view-title"><?php echo $casting['title'] ?></h4>
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
																													
										<div class="row">
											<div class="list-view-applies">
												<h5 class="list-view-applies-count span2"><p><?php echo $casting['applies'] ?></p></h5>
												<h5 class="list-view-applies-text">Personas ya postularon</h5>
											</div>
										</div>

										<div class="row">
											<div class="span6 offset1">
												<label>Estado Casting: </label>
											</div>
											<div class="span4 offset1">
										 		<span class="label label-info"><?php echo $casting['status'] ?></span>
											</div>
										</div>
										
										<div class="row">
											<div class="span4 offset1">
												<div id="time"><?php echo $casting['days'] ?> d&iacuteas</div>
											</div>
											<div class="span4 offset3">
												<a style="margin-top: 10px;" class="btn btn-info" href="<?php echo site_url("home/casting_detail/".$casting['id']); ?>" type="button">Detalle</a>
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
