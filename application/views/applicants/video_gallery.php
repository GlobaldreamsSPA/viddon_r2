<style>
.glow {
border: 1px solid #4C3C1B;
 background-color: #EFEECB;
}
</style>

<div class="row-fluid">		
	<div class="span3 user-profile-left">
		<div class="row">
		<?php 

			echo "<a href= '".HOME."/user/photo_gallery/'>";

			if(file_exists(APPPATH.'/../img/gallery/'.$image_profile_name) == TRUE)
				echo "<img class='user_image' src='".HOME.'/img/gallery/'.$image_profile_name."'/>";
			else
				echo "<img class='user_image' src='".HOME."/img/profile/user.jpg'/>";
		
			echo "</a>";

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
					<li class="active"><a href="<?php echo HOME."/user/";?>"> <i class="icon-user"></i> Perfil</a>
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
			</div><!--NAVEGACION LATERAL IZQUIERDA -->
		</div>
		<?php } ?>
	</div>

    <div class="span8 offset1 user-profile-right"> <!-- CARGAREMOS LOS DATOS DE LA GALERIA -->
		<div class="row">
			<div class="span8">
	    	<h2>Galeria de videos</h2>
			</div>
			<div style="margin-top:15px;" class="span4">
					<button data-toggle="modal"  href="#add_video" class="btn btn-primary">Agregar Video</button>
			</div>
			<legend></legend>
		</div>

    	<!-- CARGO EL MODAL-->
			<div id="add_video" class="modal hide fade" style="width: 430px !important;" tabindex="-1" role="dialog" aria-labelledby="AgregaVideo" aria-hidden="true">
				<form id="video_upload_form" action="<?php echo HOME.'/user/'?>" method="post">
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="myModalLabel">Agregar video</h3>
					</div>
					<div class="modal-body">
							<div>	
								<input name="url_ytb" style="width:96%" type="text" placeholder="Dirección - URL Video" value="" required="required">
								<input name="name_ytb" style="width:96%" type="text" placeholder="Nombre">
								<div class="space1"></div>	
								<textarea class="rich_textarea_pop_up" name="description_ytb" rows="6" placeholder="Descripción"></textarea>
								<input type="hidden" name="from_gallery" value="yes" />
								<div class="space1"></div>	
							</div>
					</div>
					<div class="modal-footer" style="height: 30px;">
						<button type="submit" class="btn btn-primary">Guardar</button>
						<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
					</div>
				</form>
			</div>    	<!-- MODAL-->
    	
    	<?php
    	//video[0] => titulo
    	//video[1]=> link
    	//video[2]=> descripcion
    	//video[3] => id del video
    	$i=0;
    	foreach($videos as $video){
    		$i++;
			if($i%2 == 0 )								
    			if($video[3] == $id_main_video) echo '<div style="padding:8px;" title="Video Principal" class="span6 glow">'; //carga el efecto de "brillo"
				else echo '<div style="padding:8px;" class="span6">';	
			else
				{
				echo '<div class="space1"></div>';
				echo '<div class="row">';
				if($video[3] == $id_main_video) echo '<div style="padding:8px;" title="Video Principal" class="span6 glow">';//carga el efecto de "brillo"
				else echo '<div style="padding:8px;" class="span6">';
				}		
				
    	?>
    			
    			<div>
						<div style="min-height: 15px !important;" class="span10">
							<label style="font-size: 150%;" id="profile" ><?php echo $video[0]; ?></label>
						</div>
						<?php if(!$public) {?>
							<div class="span1">
								<a class="btn-del" title="Establecer como principal" href="<?php echo HOME."/user/video_gallery/".$page."/1/".$video[3];?>" class="btn btn-primary"><i class="icon-star-empty"></i></a>
							</div>
							<div style="margin-left: 5px;" class="span1">
								<a class="btn-del" title="Eliminar video" href="<?php echo HOME."/user/video_gallery/".$page."/2/".$video[3];?>" class="btn btn-primary"><i class="icon-remove"></i></a>
							</div>
							
						<?php } ?>
				</div>
	    		<iframe width="100%" height="200px" src="http://www.youtube.com/embed/<?php echo $video[1].'?rel=0'?>" frameborder="0" allowfullscreen></iframe>	
				
			</div>
	    <?php 
		if($i%2 == 0 )								
    			echo '</div>';	
		if($i%2 != 0 && $i == count($videos))
				echo '</div>';	
			
		}?>	
		<div class="row-fluid">
	        <div class="space1"></div>
		        <div class="pagination">  
		            <ul id="pagination_bt">
		                <li <?php if($page==1) echo "class='disabled'";?> ><a <?php if($page!=1) echo "href= '".base_url()."user/video_gallery/".($page-1)."/'";?>>Prev</a></li>  
		                <?php 
		                
		                $pag_size = 6; //se puede fijar una constante que lo maneje
						$margen = $pag_size/2;
						
						$begin_pag = $page - $margen;
						if($begin_pag < 0) $begin_pag = 1;
						
						$end_pag = $page + $margen;
						if($end_pag > $chunks) $end_pag = $chunks;
						
					 
		                for($i = $begin_pag; $i <= $end_pag; $i++) 
		                { ?>
		                	<li <?php if($page==$i) echo "class='disabled'";?> ><a <?php if($page!=$i) echo "href= '".base_url()."user/video_gallery/".$i."/'";?> > <?php echo $i; ?></a></li>  
		                <?php } ?>
		                <li <?php if($page==$chunks) echo "class='disabled'";?> ><a <?php if($page!=$chunks) echo "href= '".base_url()."user/video_gallery/".($page+1)."/'";?>>Next</a></li>
		            </ul>  
		        </div>  
	        <div class="space1"></div>  
   		</div>    
	</div>
	
</div>
	
	

	
