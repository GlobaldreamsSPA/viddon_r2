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

<div class="content" id="content">
	<div class="container-fluid">
	  	<div class="row">
	  		<div class="span9">
	  			<div  style="border-radius: 5px; padding: 25px;" class="row-fluid">
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
									<li>
										<a data-toggle="collapse" href="#collapseOne">
											<i class="icon-star-empty"></i> Postulaciones
										</a>
										<div id="collapseOne" class="collapse in">
											<ul style="padding-left: 30px;" class="nav nav-pills nav-stacked orange">
												<li><a href="<?php echo HOME;?>./user/active_casting_list">Activas</a></li>	
												<li class="active"><a>Resultados</a></li>	
											</ul>
										</div>
									</li>	
									<li><a href="<?php echo HOME."/user/logout";?>"> <i class="icon-off"></i> Cerrar Sesi&oacuten</a></li>					
								</ul>
							</div>
				    	</div>
				    
					    <div class="span8 offset1 user-profile-right">
					    		
							<legend> <h2>Resultados Postulaciones</h2></legend>
							<table id="datatables" class="table">
				              <thead>
				                <tr>
				                  <th>Fecha</th>
				                  <th>Nombre</th>
				                  <th>Estado</th>
				                  <th>Acci&oacuten</th>
				                </tr>
				              </thead>
				              <tbody>
				                <tr>
				                  <td>21/02/2013</td>
				                  <td>Mark</td>
				                  <td><span class="label label-warning">Pendiente</span></td>
				                  <td class="center ">
									<a class="btn" href="#">
										<i class="icon-zoom-in"></i>                                            
									</a>
									<a class="btn" href="#">
										<i class="icon-question-sign"></i>                                            
									</a>
								  </td>
				                </tr>
				                <tr>
				                  <td>25/02/2013</td>
				                  <td>Jacob</td>
				                  <td><span class="label label-warning">Pendiente</span></td>
				                  <td class="center ">
									<a class="btn" href="#">
										<i class="icon-zoom-in"></i>                                            
									</a>
									<a class="btn" href="#">
										<i class="icon-question-sign"></i>                                            
									</a>
								  </td>
				                </tr>
				                <tr>
				                  <td>28/02/2013</td>
				                  <td>Larry</td>
				                  <td><span class="label label-warning">Pendiente</span></td>
				                  <td class="center ">
									<a class="btn" href="#">
										<i class="icon-zoom-in"></i>                                            
									</a>
									<a class="btn" href="#">
										<i class="icon-question-sign"></i>                                            
									</a>
								  </td>
				                </tr>
				              	<tr>
				                  <td>08/04/2013</td>
				                  <td>Mark</td>
				                  <td><span class="label label-info">Revisado</span></td>
				                  <td class="center ">
									<a class="btn" href="#">
										<i class="icon-zoom-in"></i>                                            
									</a>
									<a class="btn" href="#">
										<i class="icon-question-sign"></i>                                            
									</a>
								  </td>
				                </tr>
				                <tr>
				                  <td>14/05/2013</td>
				                  <td>Jacob</td>
				                  <td><span class="label label-info">Revisado</span></td>
				                  <td class="center ">
									<a class="btn" href="#">
										<i class="icon-zoom-in"></i>                                            
									</a>
									<a class="btn" href="#">
										<i class="icon-question-sign"></i>                                            
									</a>
								  </td>
				                </tr>
				                <tr>
				                  <td>04/06/2013</td>
				                  <td>Larry</td>
				                  <td><span class="label label-info">Revisado</span></td>
				                  <td class="center ">
									<a class="btn" href="#">
										<i class="icon-zoom-in"></i>                                            
									</a>
									<a class="btn" href="#">
										<i class="icon-question-sign"></i>                                            
									</a>
								  </td>
				                </tr>
				              	<tr>
				                  <td>02/09/2013</td>
				                  <td>Mark</td>
				                  <td><span class="label label-success">Seleccionado</span></td>
				                  <td class="center ">
									<a class="btn" href="#">
										<i class="icon-zoom-in"></i>                                            
									</a>
									<a class="btn" href="#">
										<i class="icon-question-sign"></i>                                            
									</a>
								  </td>
				                </tr>
				                <tr>
				                  <td>13/09/2013</td>
				                  <td>Jacob</td>
				                  <td><span class="label label-success">Seleccionado</span></td>
				                  <td class="center ">
									<a class="btn" href="#">
										<i class="icon-zoom-in"></i>                                            
									</a>
									<a class="btn" href="#">
										<i class="icon-question-sign"></i>                                            
									</a>
								  </td>
				                </tr>
				                <tr>
				                  <td>03/12/2013</td>
				                  <td>Larry</td>
				                  <td><span class="label label-important">Rechazado</span></td>
				                  <td class="center ">
									<a class="btn" href="#">
										<i class="icon-zoom-in"></i>                                            
									</a>
									<a class="btn" href="#">
										<i class="icon-question-sign"></i>                                            
									</a>
								  </td>
				                </tr>			
				                <tr>
				                  <td>05/12/2013</td>
				                  <td>Jacob</td>
				                  <td><span class="label label-important">Rechazado</span></td>
				                  <td class="center ">
									<a class="btn" href="#">
										<i class="icon-zoom-in"></i>                                            
									</a>
									<a class="btn" href="#">
										<i class="icon-question-sign"></i>                                            
									</a>
								  </td>
				                </tr>
				                <tr>
				                  <td>17/12/2013</td>
				                  <td>Larry</td>
				                  <td><span class="label label-important">Rechazado</span></td>
				                  <td class="center ">
									<a class="btn" href="#">
										<i class="icon-zoom-in"></i>                                            
									</a>
									<a class="btn" href="#">
										<i class="icon-question-sign"></i>                                            
									</a>
								  </td>
				                </tr>		              
				              </tbody>
				            </table>
							<div class="space4"></div>	
							<div class="space4"></div>						
						</div>					
					</div>
				</div>
			</div>	
		
			<div class="span4">
				<div class="span3">
					<div  style="border-radius: 5px; padding: 35px; min-width: 290px;" class="row-fluid">
						<h3 id="profile" >Casting recomendado</h3>
						<img style="margin-top: 16px;" src="<?php echo HOME.'/img/casting_image/mini_banner_c1.png';?>">
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