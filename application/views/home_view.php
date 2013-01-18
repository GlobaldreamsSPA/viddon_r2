<div class="content" id="content">
	<div class="container-fluid">
		<div class="row">
			<div class= "span8">
		  		<div style="border-radius:25px; padding:40px;" class="row-fluid">
	  				<img style="margin-bottom: 20px;" src="<?php echo HOME.'/img/banner_casting.png';?>">
		  			<h2 id="profile" style="font-weight:bold;"> Videos Mas Visitados</h3>

				<?php
				$i=0; 
				foreach ($video_list as $video) {
					$i++;
					if(($i-1)%2 == 0 or $i==1) echo "<div class='row-fluid'>";
					?>
					<div id="main_videos" class='span4'>
						<div class="space1"></div>
						<iframe width="334" height="197" src="http://www.youtube.com/embed/<?php echo $video[1].'?rel=0'?>" frameborder="0" allowfullscreen></iframe>	
						<span class="arrow"></span>
						<div class="container video_text_main span12">
							<div class="space1"></div>
							<div class="row row_text_main">
								<div class="span3 offset1">
									<?php
										echo "<img class='user_image_main_page' src='".HOME.'/img/profile/'.$video[4]."'/>";
									?>
								</div>
								<div class="span7">
									<p class="home-video-title"><?php echo $video[0]; ?></p>
									<span class="home-video-author">por </span><a class="home-video-author" href="<?php echo HOME.'/user/index/'.$video[2]; ?>"><?php echo $video[3]; ?></a>								
								</div>
							</div>
						</div>
					</div>
			<?php if($i%2 == 0 || $i == count($video_list)) echo "</div>"; }?>
					<div class= "space2"></div>
					<a style="text-decoration: underline; float: right;" href="<?php echo HOME."/home/video_list"?>">(Ver Todos Los Videos)</a>
					<div class= "space2"></div>
				</div>
			</div>
			<div class= "span3 offset1">
		  		<div style="border-radius:25px; padding:52px;"class="row-fluid">
		  			<h2 id="profile"  style=" margin-top: 23px; font-weight:bold;">Castings Destacados</h3>
	  				<img style="margin-top: 34px;" src="<?php echo HOME.'/img/mini_banner_c1.png';?>">
	  				<img style="margin-top: 39px;" src="<?php echo HOME.'/img/mini_banner_c2.png';?>">
	  				<img style="margin-top: 39px;" src="<?php echo HOME.'/img/mini_banner_c1.png';?>">
	  				<img style="margin-top: 39px;" src="<?php echo HOME.'/img/mini_banner_c2.png';?>">
	  				<img style="margin-top: 39px;" src="<?php echo HOME.'/img/mini_banner_c1.png';?>">
	  				<img style="margin-top: 39px;" src="<?php echo HOME.'/img/mini_banner_c2.png';?>">
					<img style="margin-top: 39px;" src="<?php echo HOME.'/img/mini_banner_c1.png';?>">
	  				<img style="margin-top: 39px;" src="<?php echo HOME.'/img/mini_banner_c2.png';?>">
					<img style="margin-top: 39px;" src="<?php echo HOME.'/img/mini_banner_c1.png';?>">
					<div class= "space4"></div>
					<a style="text-decoration: underline; float: right;" ref="#">(Ver Todos Los Castings)</a>
				</div>
			</div>
		
		</div>
  	</div>
  	<div class="space4"></div> 	
</div>