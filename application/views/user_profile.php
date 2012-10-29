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
			    		
			    	<div class="space1"></div>			    			
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
				
				<div class="space1"></div>	
				<div class="span3">		
					<img class="banner_image" src="<?php echo  base_url().'img/banner.jpg'; ?>">
					<div class="space4"></div>
					<img class="banner_image" src="<?php echo  base_url().'img/banner.jpg'; ?>">
					<div class="space4"></div>
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
						<div class="space1"></div>	
						<div class="justify"><?php echo $video_description;?></div>				
						
					<?php 
					} 
					else
					{?>
												
					<script>$('#tab a[href="#client_tab2"]').tab('show');​</script>
					
					<ul class='nav nav-tabs' id='tab'>
					  <li class="active"><a href="#tab1" data-toggle="tab">Subir Video Webcam</a></li>
					  <li><a href="#tab2" data-toggle="tab">Subir Via URL Youtube</a></li>
					
					</ul>
					
					<form action="" class="tab-content"  method="post" >
					 
					  <div class='tab-pane active' id='tab1'>
					   
					   	<div id="form_camera_video" style="display: block"> 
					   		<input class="input-xlarge" type="text" placeholder="nombre-video">
							<div class="space1"></div>			
							<textarea rows="3" id="video_description" placeholder="descripcion-video"></textarea>
							<div class="space1"></div>			
							<a onclick="toggleContent()" class="btn btn-primary">Siguiente</a>
					   	</div>
					   	
					   	<script>
					   		function toggleContent() 
					   		{
							  var form_camera_video = document.getElementById("form_camera_video");
							  var widget_youtube = document.getElementById("widget");
							  var widget_youtube_button = document.getElementById("button-widget");
							  
							  if (form_camera_video.style.display == "block")
							  {
							  	widget_youtube.style.display = "block";
							  	form_camera_video.style.display = "none";
							  	widget_youtube_button.style.display = "block";
							  } 
							  else 
							  {
							  	widget_youtube.style.display = "none";
							  	form_camera_video.style.display = "block";
							  	widget_youtube_button.style.display = "none";	
							  }
							   
							}
					   	</script>
					   	 
					    <div id="widget" style="display: none">
					    </div>
					    <div id="button-widget" style="display: none">
					    	<a onclick="toggleContent()" class="btn">cancelar</a>
					    </div>
					   
					    <script>
					      // 2. Asynchronously load the Upload Widget and Player API code.
					      var tag = document.createElement('script');
					      tag.src = "//www.youtube.com/iframe_api";
					      var firstScriptTag = document.getElementsByTagName('script')[0];
					      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
					
					      // 3. Define global variables for the widget and the player.
					      //    The function loads the widget after the JavaScript code
					      //    has downloaded and defines event handlers for callback
					      //    notifications related to the widget.
					      var widget;
					      function onYouTubeIframeAPIReady() {
					        widget = new YT.UploadWidget('widget', {
					          width: 500,
					          events: {
					            'onUploadSuccess': onUploadSuccess,
					          }
					        });
					      }
					
					      // 4. This function is called when a video has been successfully uploaded.
					      function onUploadSuccess(event) {
					        alert('Video ID ' + event.data.videoId + ' was uploaded and is currently being processed.');
					      }
					
					    </script>
					  </div>
					
					  <div class='tab-pane' id='tab2'>
							
							<input class="input-xlarge" type="text" placeholder="url-video">
							<input class="input-xlarge" type="text" placeholder="nombre-video">
							<div class="space1"></div>	
							<textarea rows="3" id="video_description" placeholder="descripcion-video"></textarea>
							<div class="space1"></div>	
							<button type="submit" class="btn btn-primary">Guardar</button>
							<button type="button" class="btn">Cancelar</button>
							
					
					  </div>
					</form>
					<?php
					}
					?>
					<div class="space2"></div>	
				</div>
				
			</div>

	  	</div>
	  	<div class="space2"></div>	
	</div>
</body>