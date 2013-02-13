<div class="content" id="content">
	<div class="container-fluid">
		<div class="row">
			<div class= "span9">
		  		<div style="border-radius: 5px; padding:25px;" id="variable" class="row-fluid">

		  			<div class="space05"></div>
		  			<h2 style="margin-left:75px;" id="profile" style="font-weight:bold;"><?php echo $casting['title']; ?></h3>
		  			<div class="space2"></div>
					<img style="margin-left:75px; margin-top:10px; height: 350px; width: 700px;" src="<?php echo $casting['image'] ?>">
					<div class="space2"></div>
					<h2 style="margin-left:75px;" id="profile" style="font-weight:bold;">Caza Talentos</h3>
					<div class="row">
						<div style="margin-left: 85px;" class="span1">
							<img class='user_image_main_page' src="<?php echo $casting['logo'] ?>"/>
						</div>
						<div class="span5">
							<h4  style="margin-left:75px; margin-top: 15px;" style="font-weight:bold;"><?php echo $casting['department'] ?></h4>
						</div>
					</div>
					<div class="space2"></div>
					<h2 style="margin-left:75px;" id="profile" style="font-weight:bold;">Categorias</h3>
					<div class="space05"></div>
					<?php
					    		echo '<ul style="margin-left:75px;" class="skills-list">';
					    		foreach ($tags as $tag) {
									echo '<li> <a href="#">'.$tag.'</a></li>';
								}
								echo '</ul>';
					?>
					<div class="space2"></div>
		  			<h2 style="margin-left:75px;" id="profile" style="font-weight:bold;"> Descripci&oacuten</h3>
		  			<p style="padding-top:35px; padding-right:75px; padding-left:75px; text-align:justify;">
		  				<?php echo $casting['description'] ?></p>

					<div class="space2"></div>
					<h2 style="margin-left:75px;" id="profile" style="font-weight:bold;">Detalles generales del Casting</h3>
					<ul style="padding-top:20px; padding-right:75px; padding-left:75px; text-align:justify;">
						<li>El Casting empezó el d&iacutea: <?php echo $casting['start_date'] ?>.</li>
						<li>El Casting termina el d&iacutea: <?php echo $casting['end_date'] ?>.</li>
						<li>El Casting requiere un máximo de: <?php echo $casting['max_applies'] ?> personas.</li>
						<li><?php echo $casting['applies'] ?> Personas ya han postulado a este casting.</li>
						<li>Las habilidades requeridas para este casting son: <?php echo $casting['skills'] ?>.</li>
					</ul>
					<div class="space2"></div>
					<h2 style="margin-left:75px;" id="profile" style="font-weight:bold;">Detalles generales del Casting</h3>
					<ul style="padding-top:20px; padding-right:75px; padding-left:75px; text-align:justify;">
						<li>Color de ojos preferido: <?php echo $casting['eyes-color'] ?>.</li>
						<li>Color de ojos preferido: <?php echo $casting['eyes-color'] ?>.</li>
						<li>Color de piel preferido: <?php echo $casting['skin-color'] ?>.</li>
						<li>Color de pelo preferido: <?php echo $casting['hair-color'] ?>.</li>
						<li>Altura del postulante: <?php echo $casting['height'] ?>.</li>
						<li>Edad preferida: <?php echo $casting['age'] ?> a&ntildeos.</li>
						<li>G&eacutenero preferido: <?php echo $casting['sex'] ?>.</li>
					</ul>
					<div class="space2"></div>
					<button style="margin-left:75px;" id="participate_button" class="btn btn-large btn-success" type="submit" name="apply">POSTULAR</button>
					<div class="space4"></div>
				</div>
			</div>
			<div class="span4">
				<div class="span3">
			  		<div style="border-radius: 5px; padding:25px; min-width: 290px;" id="grow" class="row-fluid">
			  			<h2 id="profile"  style="font-weight:bold;">Castings Relacionados</h3>
		  				<img style="margin-top: 41px;" src="<?php echo HOME.'/img/casting_image/mini_banner_c1.png';?>">
		  				<img style="margin-top: 50px;" src="<?php echo HOME.'/img/casting_image/mini_banner_c2.png';?>">
		  				<img style="margin-top: 50px;" src="<?php echo HOME.'/img/casting_image/mini_banner_c1.png';?>">
		  				<img style="margin-top: 50px;" src="<?php echo HOME.'/img/casting_image/mini_banner_c2.png';?>">
		  				<img style="margin-top: 50px;" src="<?php echo HOME.'/img/casting_image/mini_banner_c1.png';?>">
		  				<img style="margin-top: 50px;" src="<?php echo HOME.'/img/casting_image/mini_banner_c2.png';?>">
						<div class= "space4"></div>
						<a style="text-decoration: underline; float: right;" href="<?php echo HOME;?>/home/casting_list">(Ver Todos Los Castings)</a>
					</div>
				</div>
			</div>	
		</div>
  	</div>
  	<div class="space4"></div> 	
</div>