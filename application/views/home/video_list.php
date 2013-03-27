<div class="content" id="content">	
	<div class="container-fluid">
			<div style="border-radius: 5px;" class="row-fluid">
						
			<div class="row control-group">
				<div class="span2 offset1">
					<h2 class="control-label" id="profile" name="category">Categor&iacutea</h2>
				</div>
				<div style="margin-top:15px;" class="span2">
					<?php
					
					if($actual_skills != -2)
					{
						$skills_selected= array();
						for ($i=0; $i<sizeof($tags); $i++)
						{
							if(isset($actual_skills[$i]))
								$skills_selected[$i]=$actual_skills[$i];
								
						}
					}
					else
						$skills_selected=-2;

					echo form_multiselect('tags[]', $tags,$skills_selected,"class='chzn-select chosen_filter'  id='filter' style='width:100%' data-placeholder='Selecciona los tags...'");
					?>

				</div>
				<div style="margin-top:15px;" class="span2">
					<a href="<?php echo HOME."/home/video_list/1/-2/"?>" id="filter_button" class="btn btn-info">Actualizar</a>
					
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
									<?php
									if(file_exists(APPPATH.'/../img/gallery/'.$video[4]) == TRUE)
										echo "<img class='user_image_main_page' src='".HOME.'/img/gallery/'.$video[4]."'/>";
									else
										echo "<img class='user_image_main_page' src='".HOME."/img/profile/user.jpg'/>";
									?>
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
					    <li <?php if($page==1) echo "class=disabled";?>><a <?php if($page!=1) echo "href='".base_url()."home/video_list/".($page-1)."/".$actual_skills_url."/'";?>>Prev</a></li>  
						<?php
						$pag_size = 16; 
						$margen = $pag_size/2;
						
						$begin_pag = $page - $margen;
						if($begin_pag < 0) $begin_pag = 1;
						
						$end_pag = $page + $margen;
						if($end_pag > $chunks) $end_pag = $chunks;
						
						for($i = $begin_pag; $i <= $end_pag; $i++){ 
							?>
							<li <?php if($page==$i) echo "class=disabled";?>><a <?php if($page!=$i) echo "href='".base_url()."home/video_list/".$i."/".$actual_skills_url."/'";?> > <?php echo $i; ?></a></li>  
						<?php 
						} 
						?>
					    <li <?php if($page==$chunks) echo "class=disabled";?>><a <?php if($page!=$chunks) echo "href='".base_url()."home/video_list/".($page+1)."/".$actual_skills_url."/'";?>>Next</a></li>
					     
					  </ul>  
					</div>  
					<div class="space1"></div>	
				</div>	
			</div>

			

  	</div>
  	<div class="space2"></div>
	</div>