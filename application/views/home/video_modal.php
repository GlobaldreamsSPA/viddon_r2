<script type="text/javascript">
		(function(d, s, id) 
		{
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
</script>



<div style="margin-left:10px;" class="row">
	<div class="span4">
		<div style="margin-bottom: 10px;font-size: 18px;" id="profile" ><?php echo $name;?></div>
		<div style= "overflow-y: scroll; height: 130px; width: 100%;"><?php echo $description;?></div>
		
		<div class="row">
			<div class="span6">
				<a class="home-video-author" href="<?php echo HOME.'/user/index/'.$iduser; ?>">
					<?php
					if(file_exists(APPPATH.'/../img/gallery/'.$image) == TRUE)
						echo "<img class='user_image_main_page' src='".HOME.'/img/gallery/'.$image."'/>";
					else
						echo "<img class='user_image_main_page' src='".HOME."/img/profile/user.jpg'/>";
					?>
				</a>
			</div>
			<div class="span6">
				<div class="fb-like" data-href="<?php echo HOME.'/user/index/'.$iduser; ?>" data-send="true" data-layout="box_count" data-width="450" data-show-faces="true"></div>
				<div style="margin-top: 15%; margin-left:2%;" >
					<a class="home-video-author" href="<?php echo HOME.'/user/index/'.$iduser; ?>"><?php echo $username." ".$userlastname; ?></a>								
				</div>
			</div>
		</div>
		


	</div>
	<div class="span8">
		<div style="text-align: center">
			<iframe width="100%" height="270px" src="http://www.youtube.com/embed/<?php echo $id_video.'?rel=0&autoplay=1'?>" frameborder="0" allowfullscreen></iframe> 
		</div>
	</div>
</div>