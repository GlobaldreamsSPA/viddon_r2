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
				    		<div class="row">
					    		<div class="span10 offset1">
					    			<ul class="nav nav-pills nav-stacked orange">
										<li><a  href="<?php echo HOME."/user"?>"> <i class="icon-user"></i> Perfil</a>
										</li>
										<li><a href="<?php echo HOME."/user/edit/".$user_id;?>"> <i class="icon-pencil"></i> Editar Datos</a></li>
										<li>
											<a data-toggle="collapse" href="#collapseOne">
												<i class="icon-star-empty"></i> Postulaciones
											</a>
											<div id="collapseOne" class="collapse in">
												<ul style="padding-left: 30px;" class="nav nav-pills nav-stacked orange">
													<li class="active"><a>Activas</a></li>	
													<li><a href="<?php echo HOME."/user/results_casting"?>">Resultados</a></li>	
												</ul>
											</div>
										</li>	
										<li><a href="<?php echo HOME."/user/logout";?>"> <i class="icon-off"></i> Cerrar Sesi&oacuten</a></li>					
									</ul>
								</div>
				    		</div>
				    	</div>
				    			    
					    <div class="span8 offset1 user-profile-right">
					    		
							<legend> <h2>Postulaciones Activas</h2></legend>
							
							<div class="row">
								<div class="span1">
									<img src=<? echo HOME."/img/canal-13.jpg"?> />	
								</div>
								<div class="span5">
									<h4>Casting A Canal 13</h4>
								</div>
								<div style="margin-top:2%;" class="span3">
											<i class="icon-time"></i> 132 d&iacuteas
								</div>
								
								<div class"span2">
									<a class="btn" href="#">
										<i class="icon-envelope"></i>                                            
									</a>
									<a class="btn" href="#">
										<i class="icon-remove"></i>                                            
									</a>
								</div>
							</div>
							<div class="row">
								<div class="span6">
									<img id="image_casting" src=<? echo HOME."/img/casting_image/castings_dummy.png"?> />
								</div>
								<div style="padding-left: 1%;" class="span6 list-view-applies-desc">
									<div class="space05"></div>
									<div class="row">
										<h4 id="profile">Descripci&oacuten:</h4>
										<div class="">
											Se buscan Bandas con la pasi&oacuten para triunfar.
										</div>
									</div>
									<div class="space1"></div>
									<div class="row">
											<h4 id="profile">Tags:</h4>
											<ul class="skills-list">
												<li><a href="#">Canto </a></li>
												<li><a href="#">Baile </a></li>
												<li><a href="#">Actuaci&oacute;n </a></li>
											</ul>
									</div>									
								</div>
							</div>
							<div class="space4"></div>
							<div class="row">
								<div class="span1">
									<img src=<? echo HOME."/img/canal-13.jpg"?> />	
								</div>
								<div class="span5">
									<h4>Casting A Canal 13</h4>
								</div>
								<div style="margin-top:2%;" class="span3">
											<i class="icon-time"></i> 132 d&iacuteas
								</div>
								
								<div class"span2">
									<a class="btn" href="#">
										<i class="icon-envelope"></i>                                            
									</a>
									<a class="btn" href="#">
										<i class="icon-remove"></i>                                            
									</a>
								</div>
							</div>
							<div class="row">
								<div class="span6">
									<img id="image_casting" src=<? echo HOME."/img/casting_image/castings_dummy.png"?> />
								</div>
								<div style="padding-left: 1%;" class="span6 list-view-applies-desc">
									<div class="space05"></div>
									<div class="row">
										<h4 id="profile">Descripci&oacuten:</h4>
										<div class="">
											Se buscan Bandas con la pasi&oacuten para triunfar.
										</div>
									</div>
									<div class="space1"></div>
									<div class="row">
											<h4 id="profile">Tags:</h4>
											<ul class="skills-list">
												<li><a href="#">Canto </a></li>
												<li><a href="#">Baile </a></li>
												<li><a href="#">Actuaci&oacute;n </a></li>
											</ul>
									</div>									
								</div>
							</div>
							<div class="space4"></div>
							<div class="row">
								<div class="span1">
									<img src=<? echo HOME."/img/canal-13.jpg"?> />	
								</div>
								<div class="span5">
									<h4>Casting A Canal 13</h4>
								</div>
								<div style="margin-top:2%;" class="span3">
											<i class="icon-time"></i> 132 d&iacuteas
								</div>
								
								<div class"span2">
									<a class="btn" href="#">
										<i class="icon-envelope"></i>                                            
									</a>
									<a class="btn" href="#">
										<i class="icon-remove"></i>                                            
									</a>
								</div>
							</div>
							<div class="row">
								<div class="span6">
									<img id="image_casting" src=<? echo HOME."/img/casting_image/castings_dummy.png"?> />
								</div>
								<div style="padding-left: 1%;" class="span6 list-view-applies-desc">
									<div class="space05"></div>
									<div class="row">
										<h4 id="profile">Descripci&oacuten:</h4>
										<div class="">
											Se buscan Bandas con la pasi&oacuten para triunfar.
										</div>
									</div>
									<div class="space1"></div>
									<div class="row">
											<h4 id="profile">Tags:</h4>
											<ul class="skills-list">
												<li><a href="#">Canto </a></li>
												<li><a href="#">Baile </a></li>
												<li><a href="#">Actuaci&oacute;n </a></li>
											</ul>
									</div>									
								</div>
							</div>
							<div class="space4"></div>
							<div class="row">
								<div class="span1">
									<img src=<? echo HOME."/img/canal-13.jpg"?> />	
								</div>
								<div class="span5">
									<h4>Casting A Canal 13</h4>
								</div>
								<div style="margin-top:2%;" class="span3">
											<i class="icon-time"></i> 132 d&iacuteas
								</div>
								
								<div class"span2">
									<a class="btn" href="#">
										<i class="icon-envelope"></i>                                            
									</a>
									<a class="btn" href="#">
										<i class="icon-remove"></i>                                            
									</a>
								</div>
							</div>
							<div class="row">
								<div class="span6">
									<img id="image_casting" src=<? echo HOME."/img/casting_image/castings_dummy.png"?> />
								</div>
								<div style="padding-left: 1%;" class="span6 list-view-applies-desc">
									<div class="space05"></div>
									<div class="row">
										<h4 id="profile">Descripci&oacuten:</h4>
										<div class="">
											Se buscan Bandas con la pasi&oacuten para triunfar.
										</div>
									</div>
									<div class="space1"></div>
									<div class="row">
											<h4 id="profile">Tags:</h4>
											<ul class="skills-list">
												<li><a href="#">Canto </a></li>
												<li><a href="#">Baile </a></li>
												<li><a href="#">Actuaci&oacute;n </a></li>
											</ul>
									</div>									
								</div>
							</div>
							
							
							<div class="space4"></div>	
							<div class="space4"></div>						
						</div>					
					</div>
