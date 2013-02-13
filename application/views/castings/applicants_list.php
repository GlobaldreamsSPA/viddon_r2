<?php	for ($i=1; $i <5 ; $i++) {?>
	<div id="modal<?php echo $i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
	    <h3 id="myModalLabel">Observaciones</h3>
	  </div>
	  <div class="modal-body">
		<input type="text" value="" placeholder="campo no obligatorio">
	  </div>
	  <div class="modal-footer">
	    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
	    <button class="btn btn-primary">Guardar</button>
	  </div>
	</div>
<?php }	?>

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
							
							<div class="span9 offset1">
								<select style="width:150px;">
									<option value="sin_revisar">Sin Revisar</option>
									<option value="aceptados">Aceptados</option>
									<option value="rechazados">Rechazados</option>
									<option value="todos">Todos</option>
								</select>
								
								<select data-placeholder="Selecciona los tags..." class="chzn-select" style="width:150px;" multiple>
								 	<option value=""></option> 
								 	<option value="sin_revisar">Cantante</option>
									<option value="aceptados">Actor</option>
									<option value="rechazados">Bailarin</option>
									<option value="todos">Escritor</option>
									<option value="aceptados">Poeta</option>
									<option value="rechazados">Callejero</option>
								</select>
								<btn style="float:right;" class="btn btn"> Filtar</btn>
							</div>
					    </div>
					    
					    <div class="span8 offset1 user-profile-right">
					    		
							<legend><h3 class="profile-title"><a href="<?php echo HOME.'/hunter/casting_list' ?>">Castings/</a><a href="<?php echo HOME.'/hunter/casting_detail' ?>">Casting A/</a> Lista Postulantes </h3></legend>
							<div class="row" style="margin-left:1px; width: 100%; height: 180px;"> 
					    		<div class="span7">
					    		<iframe width="100%" height="210" src="http://www.youtube.com/embed/vHmGyrq2YhE" frameborder="0" allowfullscreen></iframe>
					    		</div>
					    		<div class="span5">
						    		<row>
							    		<div class="span4">
							    			<img style="max-width: 80%; max-height: 80%;" src="<?php echo HOME."/img/profile/5.jpeg" ?>"/>
										</div>
										<div class="span6">
											<h5>
												Iv&aacuten Vald&eacutes Riesco
											</h5>
										</div>
										<div class="span1">
											<button style="margin-top: 100%;">
												<i class="icon-search"></i>
											</button>
										</div>
									</row>
									<row>
										<ul style="font-size: 9px;"class="skills-list">
											<li>Cantante</li>
											<li>Actor</li>
											<li>Bailarin</li>
										</ul>
									</row>
									
									<row>
							    		<p style="text-align:justify;">
							    			La inform&aacutetica es mi hobby, mi profesi&oacuten y mi pasi&oacuten. Soy un afortunado usuario y desarrollador de software libre.
							    		</p>
									</row>
									
									<row style="float: right;">
										
										<a data-toggle="modal" href="#modal1" style="text-align: right;" class="btn btn-success">
											<i class="icon-ok"></i>
										</a>
										
										<a style="text-align: right;" class="btn btn-danger">
											<i class="icon-remove"></i>
										</a>
										
									</row>
								</div>
							</div>
				
							<div class="space4"></div>
							<div class="space2"></div>
							
							<div class="row" style="margin-left:1px; width: 100%; height: 180px;"> 
					    		<div class="span7">
					    		<iframe width="100%" height="210" src="http://www.youtube.com/embed/vHmGyrq2YhE" frameborder="0" allowfullscreen></iframe>
					    		</div>
					    		<div class="span5">
						    		<row>
							    		<div class="span4">
							    			<img style="max-width: 80%; max-height: 80%;" src="<?php echo HOME."/img/profile/5.jpeg" ?>"/>
										</div>
										<div class="span6">
											<h5>
												Iv&aacuten Vald&eacutes Riesco
											</h5>
										</div>
										<div class="span1">
											<button style="margin-top: 100%;">
												<i class="icon-search"></i>
											</button>
										</div>
									</row>
									<row>
										<ul style="font-size: 9px;"class="skills-list">
											<li>Cantante</li>
											<li>Actor</li>
											<li>Bailarin</li>
										</ul>
									</row>
									
									<row>
							    		<p style="text-align:justify;">
							    			La inform&aacutetica es mi hobby, mi profesi&oacuten y mi pasi&oacuten. Soy un afortunado usuario y desarrollador de software libre.
							    		</p>
									</row>
									
									<row style="float: right;">
										
										<a data-toggle="modal" href="#modal1" style="text-align: right;" class="btn btn-success">
											<i class="icon-ok"></i>
										</a>
										
										<a style="text-align: right;" class="btn btn-danger">
											<i class="icon-remove"></i>
										</a>
										
									</row>
								</div>
							</div>
				
							<div class="space4"></div>
							<div class="space2"></div>

							<div class="row" style="margin-left:1px; width: 100%; height: 180px;"> 
					    		<div class="span7">
					    		<iframe width="100%" height="210" src="http://www.youtube.com/embed/vHmGyrq2YhE" frameborder="0" allowfullscreen></iframe>
					    		</div>
					    		<div class="span5">
						    		<row>
							    		<div class="span4">
							    			<img style="max-width: 80%; max-height: 80%;" src="<?php echo HOME."/img/profile/5.jpeg" ?>"/>
										</div>
										<div class="span6">
											<h5>
												Iv&aacuten Vald&eacutes Riesco
											</h5>
										</div>
										<div class="span1">
											<button style="margin-top: 100%;">
												<i class="icon-search"></i>
											</button>
										</div>
									</row>
									<row>
										<ul style="font-size: 9px;"class="skills-list">
											<li>Cantante</li>
											<li>Actor</li>
											<li>Bailarin</li>
										</ul>
									</row>
									
									<row>
							    		<p style="text-align:justify;">
							    			La inform&aacutetica es mi hobby, mi profesi&oacuten y mi pasi&oacuten. Soy un afortunado usuario y desarrollador de software libre.
							    		</p>
									</row>
									
									<row style="float: right;">
										
										<a data-toggle="modal" href="#modal1" style="text-align: right;" class="btn btn-success">
											<i class="icon-ok"></i>
										</a>
										
										<a style="text-align: right;" class="btn btn-danger">
											<i class="icon-remove"></i>
										</a>
										
									</row>
								</div>
							</div>
				
							<div class="space4"></div>
							<div class="space2"></div>
							
							<div class="row" style="margin-left:1px; width: 100%; height: 180px;"> 
					    		<div class="span7">
					    		<iframe width="100%" height="210" src="http://www.youtube.com/embed/vHmGyrq2YhE" frameborder="0" allowfullscreen></iframe>
					    		</div>
					    		<div class="span5">
						    		<row>
							    		<div class="span4">
							    			<img style="max-width: 80%; max-height: 80%;" src="<?php echo HOME."/img/profile/5.jpeg" ?>"/>
										</div>
										<div class="span6">
											<h5>
												Iv&aacuten Vald&eacutes Riesco
											</h5>
										</div>
										<div class="span1">
											<button style="margin-top: 100%;">
												<i class="icon-search"></i>
											</button>
										</div>
									</row>
									<row>
										<ul style="font-size: 9px;"class="skills-list">
											<li>Cantante</li>
											<li>Actor</li>
											<li>Bailarin</li>
										</ul>
									</row>
									
									<row>
							    		<p style="text-align:justify;">
							    			La inform&aacutetica es mi hobby, mi profesi&oacuten y mi pasi&oacuten. Soy un afortunado usuario y desarrollador de software libre.
							    		</p>
									</row>
									
									<row style="float: right;">
										
										<a data-toggle="modal" href="#modal1" style="text-align: right;" class="btn btn-success">
											<i class="icon-ok"></i>
										</a>
										
										<a style="text-align: right;" class="btn btn-danger">
											<i class="icon-remove"></i>
										</a>
										
									</row>
								</div>
							</div>
				
								
						</div>
					</div>
					<div class="row-fluid">	
						<div class="space4"></div>	
					</div>