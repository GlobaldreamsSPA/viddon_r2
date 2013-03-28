<div class="content" id="content">	
	<div class="container-fluid">
			<div style="border-radius: 5px;" class="row-fluid">
						
			<h2 style="margin-left:5%;" id="profile" style="font-weight:bold;"> Todos los Videos</h3>

			<div class="row control-group">

				<div style="margin-top:15px;"  class="span1 offset1">
					<h4 class="control-label" style="position: relative; bottom: 17px; left: -20px;" name="category">Buscar un video</h4>
				</div>
				<?php echo form_open('home/video_list',array('method' => 'get')); ?>
				<div style="margin-top:15px;" class="span2">
					<input id='filter' style='width:1020;' placeholder="Ingresa un termino" name="search_terms"></input>
				</div>
				<div style="margin-top:15px;" class="span2">
					<input type="submit" style="position: relative; bottom: 03px; left: 15px;" id="filter_button" class="btn btn-info" value="Buscar"/>
				</form>
				</div>
			</div>
			<?php
				$i=0; 
				foreach ($video_list as $video) {
					$i++;
					if(($i-1)%3 == 0 or $i==1) echo "<div class='row-fluid'>";
					?>
					<div id="main_videos_list" class='span4'>
						<div class="space1"></div>
						<iframe width="100%" height="200" src="http://www.youtube.com/embed/<?php echo $video[1].'?rel=0'?>" frameborder="0" allowfullscreen></iframe>	
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
							<div class="row row_text_main">
								<div class="span11 offset1">
									<div class="space05"></div>
									<div class="fb-button">
										<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo HOME.'/user/index/'.$video[2]; ?>" scrolling="no" frameborder="0" style="margin-top: 0; position: relative; top: -5px; margin-left: 5px; border:none; width:225px; height:80px"></iframe>									
		        						<label style="display: inline;">
		        					</div>					
									</label>
								</div>
							</div>
						</div>
					</div>
				<?php if($i%3 == 0 || $i == count($video_list)) echo "</div>"; }?>
				<div class="row-fluid">
					<div class="space1"></div>
					<div class="pagination">  
					  <ul id="pagination_bt">
					    <li <?php if($page==1) echo "class=disabled";?>><a <?php if($page!=1) echo "href='".base_url()."home/video_list/".($page-1).$get_uri."'";?>>Prev</a></li>  
						<?php
						$pag_size = 16; 
						$margen = $pag_size/2;
						
						$begin_pag = $page - $margen;
						if($begin_pag < 0) $begin_pag = 1;
						
						$end_pag = $page + $margen;
						if($end_pag > $chunks) $end_pag = $chunks;
						
						for($i = $begin_pag; $i <= $end_pag; $i++){ 
							?>
							<li <?php if($page==$i) echo "class=disabled";?>><a <?php if($page!=$i) echo "href='".base_url()."home/video_list/".$i.$get_uri."'";?> > <?php echo $i; ?></a></li>  
						<?php 
						} 
						?>
					    <li <?php if($page==$chunks) echo "class=disabled";?>><a <?php if($page!=$chunks) echo "href='".base_url()."home/video_list/".($page+1).$get_uri."'";?>>Next</a></li>
					     
					  </ul>  
					</div>  
					<div class="space1"></div>	
				</div>	
			</div>

			

  	</div>
  	<div class="space2"></div>
	</div>