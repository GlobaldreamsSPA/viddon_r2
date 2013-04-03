<div class="content" id="content">
	<div class="container-fluid">
		<div class="row">
			<div class= "span8">
		  		<div style="border-radius: 5px; margin-left:3%;" id="variable" class="row-fluid">
		  			
		  			<div style="margin-left: 5%; margin-top:5%; width: 90%;" id="myCarousel" class="carousel slide">
					  <!-- Carousel items -->
					  <div class="carousel-inner">
					    <div class="active item">
					    	<a href="<?php echo base_url().'user/fb_login'; ?>">	
		  						<img style="height:100%; width:100%;" src="<?php echo HOME."/img/concursoLlolapaloozaweb.jpg" ?>">
		  					</a>
						</div>
						<div class="item">
					    	<a href="<?php echo base_url().'user/fb_login'; ?>">	
		  						<img style="height:100%; width:100%;" src="<?php echo HOME."/img/home_viddon_graphic.jpg" ?>">
		  					</a>
						</div>
					  </div>
					  <!-- Carousel nav -->
					  <a style="margin-top:2%;" class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
					  <a style="margin-top:2%;" class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
					</div>
					<div class="space1"></div>
		  			<h2 style="margin-left:5%;" id="profile" style="font-weight:bold;"> Últimos Videos</h3>
		  			
				<?php
				$i=0; 
				foreach ($video_list as $video) {
					$i++;
					if(($i-1)%2 == 0 or $i==1) echo "<div class='row-fluid'>";
					?>
					<div id="main_videos" class='span4'>
						<div class="space1"></div>
						<iframe width="100%" height="200px" src="http://www.youtube.com/embed/<?php echo $video[1].'?rel=0'?>" frameborder="0" allowfullscreen></iframe>	
						<span class="arrow"></span>
						<div class="container video_text_main span12">
							<div class="space1"></div>
							<div class="row row_text_main">
								<div class="span3 offset1">
								<a class="home-video-author" href="<?php echo HOME.'/user/index/'.$video[2]; ?>">
									<?php
									if(file_exists(APPPATH.'/../img/gallery/'.$video[4]) == TRUE)
										echo "<img class='user_image_main_page' src='".HOME.'/img/gallery/'.$video[4]."'/>";
									else
										echo "<img class='user_image_main_page' src='".HOME."/img/profile/user.jpg'/>";
									?>
								</a>
								</div>
								<div class="span7">
									<p class="home-video-title"><?php echo $video[0]; ?></p>
									<span class="home-video-author">por </span><a class="home-video-author" href="<?php echo HOME.'/user/index/'.$video[2]; ?>"><?php echo $video[3]; ?></a>								
								</div>
							</div>
						</div>
					</div>
			<?php if($i%2 == 0 || $i == count($video_list)) echo "</div>"; }?>
					<a class="MBT-readmore" style="margin-right:5%; float: right;" href="<?php echo HOME."/home/video_list"?>">Todos Los Videos >></a>
					<div class= "space2"></div>
					<div class= "space2"></div>
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