<div class="content" id="content">
	<div class="container-fluid">
		<div class="row">
			<div class= "span8">
		  		<div style="border-radius: 5px; margin-left:3%;" id="variable" class="row-fluid">
		  			
		  			<div style="margin-left: 15%; margin-top:10%; height:270px; width: 70%;" id="myCarousel" class="carousel slide">
					  <!-- Carousel items -->
					  <div class="carousel-inner">
					    <div class="active item">
					    	<a href="<?php echo site_url("home/casting_detail/".$castings[0]['id']); ?>">
								<img style="height:100%; width:100%;" src="<?php echo $castings[0]['full_image']; ?>">
							</a>
						</div>
						<?php for($i=1; $i<8; $i++){ ?>
						<div class="item">
						    <a href="<?php echo site_url("home/casting_detail/".$castings[$i]['id']); ?>">
								<img style="height:100%; width:100%;" src="<?php echo $castings[$i]['full_image']; ?>">
							</a>
						</div>
					    <?php } ?>
					  </div>
					  <!-- Carousel nav -->
					  <a style="margin-top:5%;" class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
					  <a style="margin-top:5%;" class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
					</div>
					
					<div class="space1"></div>
		  			<h2 style="margin-left:5%;" id="profile" style="font-weight:bold;"> Videos Mas Visitados</h3>

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
					<a class="MBT-readmore" style="float: right;" href="<?php echo HOME."/home/video_list"?>">Todos Los Videos >></a>
					<div class= "space2"></div>
				</div>
			</div>
			<div class="span4">
			  	<div style="border-radius: 5px; margin-left:8%; text-align:center;" id="grow" class="row-fluid">
			  		<div class="space1"></div>
			  		<h2 id="profile"  style="font-weight:bold;">Castings Destacados</h3>
			  		<?php foreach($castings as $casting){ ?>
			  			<a href="<?php echo site_url("home/casting_detail/".$casting['id']); ?>">
		  					<img style="margin-top: 44px; width: 70%; height: 170px;" src="<?php echo $casting['image']; ?>">
		  				</a>
		  			<?php } ?>
					<div class= "space2"></div>
					<div class="space1"></div>
					<a class="MBT-readmore" style="float: right;" href="<?php echo HOME;?>/home/casting_list">Todos Los Castings >></a>
				</div>
			</div>	
		</div>
  	</div>
  	<div class="space4"></div> 	
</div>