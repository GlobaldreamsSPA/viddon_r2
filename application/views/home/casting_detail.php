<div id="postulation-result" class="modal hide fade in">
<div class="modal-header">
<a class="close" data-dismiss="modal"><i class="icon-remove"></i></a>  
</div>
<div class="modal-body">
<h4>Aviso</h4>
<p><?php if(isset($postulation_message)) echo $postulation_message; ?></p>              
</div>
<div class="modal-footer">
<?php echo anchor(HOME,'Volver al Home',"class='btn btn-green'"); ?>
<a href="#" class="btn" data-dismiss="modal">Cerrar</a>
</div>
</div>

<?php if(isset($postulation_message)){ ?>
<script type="text/javascript">

  $('#postulation-result').modal({
    show: true
  });
</script>
<?php } ?>

<div class="content" id="content">
	<div class="container-fluid">
		<div class="row">
			<div class= "span8">
		  		<div style="border-radius: 5px; margin-left:3%;" id="variable" class="row-fluid">

		  			<div class="space05"></div>
		  			<h2 style="margin-left:10%;font-weight:bold;" id="profile"><?php echo $casting['title']; ?></h3>
		  			<div class="space2"></div>
					<img style="margin-left:12%; margin-top:10px; height: 300px; width: 75%;" src="<?php echo $casting['full_image'] ?>">
					<div class="space2"></div>
					<h3 style="margin-left:10%;" id="profile" style="font-weight:bold;">Caza Talentos</h3>
					<div class="row">
						<div style="margin-left:12%;" class="span1">
							<img class='user_image_main_page' src="<?php echo $casting['logo'] ?>"/>
						</div>
						<div class="span5">
							<h4  style="margin-left:10%; margin-top: 15px;" style="font-weight:bold;"><?php echo $casting['department'] ?></h4>
						</div>
					</div>
					<div class="space2"></div>
					<h3 style="margin-left:10%;" id="profile" style="font-weight:bold;">Categorias</h3>
					<div class="space05"></div>
					<?php
								if(isset($tags))
								{
						    		echo '<ul style="margin-left:75px;" class="skills-list">';
						    		foreach ($tags as $tag) {
										echo '<li> <a href="#">'.$tag.'</a></li>';
									}
									echo '</ul>';
								}
					?>
					<div class="space2"></div>
		  			<h3 style="margin-left:10%;" id="profile" style="font-weight:bold;"> Descripci&oacuten</h3>
		  			<div style="padding-top:35px; padding-right:75px; padding-left:75px; text-align:justify;">
		  				<?php echo $casting['description'] ?></div>

					<div class="space2"></div>
					<h3 style="margin-left:10%;" id="profile" style="font-weight:bold;">Detalles generales del Casting</h3>
					<ul style="padding-top:20px; padding-right:75px; padding-left:75px; text-align:justify;">
						<li>El Casting empezó el d&iacutea: <?php echo $casting['start_date'] ?>.</li>
						<li>El Casting termina el d&iacutea: <?php echo $casting['end_date'] ?>.</li>
						<li>Han postulado <?php echo $casting['applies'] ?> personas a este casting.</li>
						<li>Edad preferida: <?php echo $casting['age'] ?>.</li>
						<li>G&eacutenero preferido: <?php echo $casting['sex'] ?>.</li>
					</ul>
					<div class="space2"></div>
					<a style="margin-left:10%;" href="<?php echo HOME."/home/apply_casting/".$casting['id'];?>" id="participate_button" class="btn btn-large btn-success" type="submit" name="apply">POSTULAR</a>
					<div class="space4"></div>
				</div>
			</div>
			<div class="span4">
			  	<div style="border-radius: 5px; margin-left:8%; text-align:center;" id="grow" class="row-fluid">
			  		<div class="space1"></div>
			  		<h2 id="profile"  style="font-weight:bold;">Castings Viddon</h3>
			  		<?php foreach($castings as $casting){ ?>
			  			<a href="<?php echo site_url("home/casting_detail/".$casting['id']); ?>">
		  					<img style="margin-top: 7%; width: 84%; " src="<?php echo $casting['image']; ?>">
		  				</a>
		  			<?php } ?>
					<div class= "space2"></div>
					<div class= "space2"></div>
					<div style="height: 41px;"></div>	
					<div style="margin-left: 5%;" class="span11">
					<a class="twitter-timeline" href="https://twitter.com/ViddonCom" data-widget-id="316343995661959169">Tweets por @ViddonCom</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</div>
				</div>
			</div>
		</div>
  	</div>
  	<div class="space4"></div> 	
</div>