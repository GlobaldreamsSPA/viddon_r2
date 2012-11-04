<div class="content" id="content">	
	<div class="container-fluid">
	  		<?php
				$i=0; 
				foreach ($video_list as $video) {
					$i++;
					if(($i-1)%3 == 0 or $i==1) echo "<div class='row-fluid'>";
			?>
			<div id="main_videos" class='span4'>
				<div class="space2"></div>
				<h4> <?php echo $video[0];?></h3>
				<iframe width="410" height="260" src="http://www.youtube.com/embed/<?php echo $video[1]?>" frameborder="0" allowfullscreen></iframe>
				<div class="space1"></div>		
				<div class="fb-like" data-href="http://www.youtube.com/watch?v=<?php echo $video[1] ?>" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>			    							
				<label style="display:inline;">
				<?php

					$JSON = file_get_contents("https://gdata.youtube.com/feeds/api/videos/{$video[1]}?v=2&alt=json");
					$JSON_Data = json_decode($JSON);
					
					if(array_key_exists('yt$statistics', $JSON_Data->{'entry'}))
					{
						$views = $JSON_Data->{'entry'}->{'yt$statistics'}->{'viewCount'};
						$dislikes = $JSON_Data->{'entry'}->{'yt$rating'}->{'numDislikes'};
						$likes = $JSON_Data->{'entry'}->{'yt$rating'}->{'numLikes'};
					}
					else
					{
						$views = "0";
						$dislikes = "0";
						$likes = "0";
					}	
					echo "<span id='youtubedata' class='badge badge-important'><i class='icon-thumbs-down icon-white'></i>$dislikes</span>";
					echo "<span id='youtubedata' class='badge badge-success'><i class='icon-thumbs-up icon-white'></i>$likes</span>";
					echo "<span id='youtubedata' class='badge badge-info'><i class='icon-eye-open '></i>$views</span>";
				?>
				</label>
			</div>
			<?php if($i%3 == 0) echo "</div>"; }?>
			
			<div class="row-fluid">
				<div class="space1"></div>
				<div class="pagination">  
				  <ul id="pagination_bt">
				  	  
				    <li <?php if($page==1) echo "class='disabled'";?> ><a href=<?php echo base_url()."home/index/".($page-1);?>>Prev</a></li>  
					<?php for($i = 1; $i <= $chunks; $i++) { ?>
						<li <?php if($page==$i) echo "class='disabled'";?> ><a href=<?php echo base_url()."home/index/".$i;?> > <?php echo $i; ?></a></li>  
					<?php } ?>
				    <li <?php if($page==$chunks) echo "class='disabled'";?> ><a href=<?php echo base_url()."home/index/".($page+1);?>>Next</a></li>
				     
				  </ul>  
				</div>  
				<div class="space1"></div>	
			</div>	
			

  	</div>
  	<div class="space2"></div>
</div>