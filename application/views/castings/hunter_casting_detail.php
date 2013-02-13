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
						<div class= "span8 offset1">			
					  			<legend><h3 class="profile-title"> <a href="<?php echo HOME.'/hunter/casting_list' ?>">Castings/</a> Detalle Castings </h3></legend>
					  			<div class="space05"></div>
					  			<row>
						  			<div class="span3">
						  				<h3 id="profile" style="font-weight:bold;"> Casting A</h3>
						  			</div>					  				
						  			<div style="margin-top:15px;" class="span4">
						  				<button> Vista Publica</button>
						  				<button> Editar</button>
						  			</div>
					  			</row>
					  			<div class="space2"></div>
								<img style=" margin-top:10px; height: 250px; width: 500px;" src="<?php echo HOME.'/img/casting_image/mini_banner_c1.png';?>">
								<div class="space2"></div>
								<h2 id="profile" style="font-weight:bold;"> Categorias</h2>
								<div class="space05"></div>
								<?php
								    		echo '<ul class="skills-list">';
								    		foreach ($tags as $tag) {
												echo '<li> <a href="#">'.$tag.'</a></li>';
											}
											echo '</ul>';
								?>
								<div class="space2"></div>
								<h3 id="profile" style="font-weight:bold;"> Estadisticas</h3>
								<div class ="row">
									<div style="margin-left: 30px;"  class="span8">						
										<div class="space1"></div>
										<p>
											Visitas pagina casting: 12000
										</p>
										<div class="space1"></div>
										
										<p>
											Tiempo restante: 0 d&iacuteas
										</p>
										<div class="space1"></div>
										
										<p>
											Estado: revisando postulaciones
										</p>										
										<div class="space1"></div>
																						
										<p>
											Meta de postulantes: 5000 personas de 1000
										</p>
										<div class="progress">
											<div class="bar bar-success" style="width: 100%;">100%</div>
										</div>
										
										<div class="space1"></div>
										
										<p>
											Postulantes revisados: 2500 personas de 5000
										</p>
										<div class="progress">
										    <div class="bar bar-warning" style="width: 50%;">50%</div>
										</div>
									
										<div class="space1"></div>
									</div>
								</div>
								<h3 id="profile" style="font-weight:bold;"> Postulantes</h3>
								<img style=" margin-top:10px; height: 150px; width: 600px;" src="<?php echo HOME.'/img/lista_usuarios_dummy.png';?>">
								<a href="<?php echo HOME.'/hunter/applicants_list' ?>" style="float: right;"> (Ver Todos Los Postulantes)</a>
								<div class="space2"></div>
								<h3 id="profile" style="font-weight:bold;"> Seleccionados</h3>
								<img style=" margin-top:10px; height: 150px; width: 600px;" src="<?php echo HOME.'/img/lista_usuarios_dummy.png';?>">
								<a href="<?php echo HOME.'/hunter/accepted_list' ?>" style="float: right;"> (Ver Todos Los Seleccionados)</a>
						</div>
						    
					    
					</div>
					<div class="row-fluid">	
						<div class="space4"></div>	
					</div>
