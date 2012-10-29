<body>
	
	<div class="content" id="content">
	
		<div class="container-fluid">
		  	<div class="row-fluid">
		    	<div class="span3">
					<img class="user_image" src="<?php echo '../img/'.$id.'.jpg' ?>"/>
					<form action="user" method="POST">
						<button id="participate_button" class="btn btn-large btn-success" type="submit" name="apply">POSTULAR A CONCURSO</button>
		    		</form>
		    	</div>
			    
			    <div class="span6">
			    		
			    	<BR>		    			
					<h1> <?php echo $name ?></h1>
					<div class="fb-like" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>
			    	<?php
			    		echo '<ul>' ;
			    		foreach ($tags as $tag) {
							echo '<li class="taglist"> <a href="#">'.$tag.'</a></li>';
						}
						echo '</ul>';
					?>
					<h4 class="profile">Bio</h4>
					<div class="justify"><?php echo $bio;?></div>
					
					<h4 class="profile">Hobbies</h4>
					<div class="justify"><?php echo $bio;?></div>
					
					<h4 class="profile">Mi sueno</h4>
					<div class="justify"><?php echo $bio;?></div>
					
				</div>

			</div>
			

			<div class="row-fluid">
				
				<br>
				<div class="span3">		
					<img class="banner_image" src="<?php echo  base_url().'img/banner.jpg'; ?>">
					<br>
					<br>
					<br>
					<br>
					<br>
					<img class="banner_image" src="<?php echo  base_url().'img/banner.jpg'; ?>">
				</div>
				
				<div class="span6">
					<?php if(isset($video_ID)){?>
						<h2> <?php echo $video_title;?></h3>
						<iframe width="650" height="400" src="http://www.youtube.com/embed/<?php echo $video_ID?>" frameborder="0" allowfullscreen></iframe>
						<br>				
						<div class="fb-like" data-href="http://www.youtube.com/watch?v=<?php echo $video_ID ?>" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>			    							
						<label style="display:inline;">
						<?php
							$JSON = file_get_contents("https://gdata.youtube.com/feeds/api/videos/{$video_ID}?v=2&alt=json");
							$JSON_Data = json_decode($JSON);
							$views = $JSON_Data->{'entry'}->{'yt$statistics'}->{'viewCount'};
							$dislikes = $JSON_Data->{'entry'}->{'yt$rating'}->{'numDislikes'};
							$likes = $JSON_Data->{'entry'}->{'yt$rating'}->{'numLikes'};
							
							echo "<span id='youtubedata' class='badge badge-important'><i class='icon-thumbs-down icon-white'></i>$dislikes</span>";
							echo "<span id='youtubedata' class='badge badge-success'><i class='icon-thumbs-up icon-white'></i>$likes</span>";
							echo "<span id='youtubedata' class='badge badge-info'><i class='icon-eye-open '></i>$views</span>";
							
						?>
						</label>
						<br>
						<div class="justify"><?php echo $video_description;?></div>				
						
					<?php 
					} 
					else
					{?>
							
						<iframe id="widget" type="text/html" width="640" height="390" src="https://www.youtube.com/upload_embed" frameborder="0">
					<?php
					}
					?>
					<br>
					<br>
				</div>
				
			</div>

	  	</div>
	  	<br>
	  	<br>
	</div>
</body>