<div class="content" id="content">	
	<div class="container-fluid">
			<div style="border-radius:25px; padding:20px; max-width: 1250px;" class="row-fluid">
						
			<div class="row control-group">
				<div class="span2 offset1">
					<h2 class="control-label" id="profile" name="category">Categor&iacutea</h2>
				</div>
				<div style="margin-top:15px;" class="span2 controls">
					<select>
						<option value="danza">Danza</option>
						<option value="actuacion">Actuaci&oacuten</option>
						<option selected="selected" value="todos">Todos</option>
						<option value="musica">M&uacutesica</option>
			  			<option value="canto">Canto</option>
			  			<option value="otros">Otros</option>
					</select>
				</div>
				<div style="margin-top:15px;" class="span2">
					<button class="btn btn-info">Actualizar</button>
					
				</div>
			</div>
			<?php
				$i=0; 
				foreach ($video_list as $video) {
					$i++;
					if(($i-1)%3 == 0 or $i==1) echo "<div class='row-fluid'>";
					?>
					<div id="main_videos" class='span4'>
						<div class="space1"></div>
						<iframe width="370" height="200" src="http://www.youtube.com/embed/<?php echo $video[1].'?rel=0'?>" frameborder="0" allowfullscreen></iframe>	
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
					  	  
					    <li <?php if($page==1) echo "class='disabled'";?> ><a href=<?php echo base_url()."home/video_list/".($page-1);?>>Prev</a></li>  
						<?php for($i = 1; $i <= $chunks; $i++) { ?>
							<li <?php if($page==$i) echo "class='disabled'";?> ><a href=<?php echo base_url()."home/video_list/".$i;?> > <?php echo $i; ?></a></li>  
						<?php } ?>
					    <li <?php if($page==$chunks) echo "class='disabled'";?> ><a href=<?php echo base_url()."home/video_list/".($page+1);?>>Next</a></li>
					     
					  </ul>  
					</div>  
					<div class="space1"></div>	
				</div>	
			</div>

			

  	</div>
  	<div class="space2"></div>
	</div>