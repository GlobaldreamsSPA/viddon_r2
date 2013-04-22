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
			  		<div class="space1"></div>
		  			<h2 style="margin-left:10%;font-weight:bold;" id="profile"><?php echo $casting['title']; ?></h3>
					<img style="margin-left:8%; margin-top:4%; width: 85%;" src="<?php echo $casting['full_image'] ?>">
					<div class="space2"></div>
					<h3 style="margin-left:10%;" id="profile" style="font-weight:bold;">Caza Talentos</h3>
					<div class="row">
						<div style="margin-left:12%;" class="span1">
							<img class='hunter_casting_logo_detail' src="<?php echo $casting['logo'] ?>"/>
						</div>
						<div class="span5">
							<h4  style="margin-top: 6%;" style="font-weight:bold;"><?php echo $casting['department'] ?></h4>
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
					<form action="<?php echo HOME.'/home/apply_casting/'.$casting['id']; ?>" method="POST">
					<?php
						if($custom_options)
						{
							for($i=0; $i < count($custom_options); $i++) {
								if(strcmp($custom_options[$i]['type'], 'text') == 0)
								{
									//Pregunta va h5 y texto es textarea
									echo "<h5>".$custom_options[$i]['text']."</h5>";
									echo "<textarea name='custom_text_answer_".$custom_options[$i]['id']."'style='resize: none; width: 97%; margin-top: 15px;' cols='50' rows='3' placeholder='La respuesta del postulante iría acá'></textarea>";
								}
								if(strcmp($custom_options[$i]['type'], 'select') == 0)
								{
									//Pregunta va h5 y se crea un select con varios options
									echo "<h5>".$custom_options[$i]['text']."</h5>";
									echo "<select name='custom_select_answer_".$custom_options[$i]['id']."'>";
									foreach ($custom_options[$i]['options'] as $option)
									{
										echo "<option value='".$option['id']."'>".$option['option']."</option>";
									}
									echo "</select>";
								}
								if(strcmp($custom_options[$i]['type'], 'multiselect') == 0)
								{
									//Pregunta va h5 y se crea un select chozen
									echo "<h5>".$custom_options[$i]['text']."</h5>";

									$options =  array();
									foreach ($custom_options[$i]['options'] as $option)
									{
										$options[$option['id']] = $option['option'];
									}

									echo form_multiselect("custom_multiselect_answer_".$custom_options[$i]['id']."[]", $options ,NULL,"class='chzn-select chosen_filter' style='width:60%' data-placeholder='Selecciona los tags...'");
								}
							}
						}
					?>

					<div class="space2"></div>
					<button style="margin-left:10%;" id="participate_button" class="btn btn-large btn-success" type="submit">POSTULAR</button>
					</form>
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