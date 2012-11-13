
<div id="success" class="modal hide fade in" >  
<div class="modal-header">  
<a class="close" data-dismiss="modal">×</a>  
<h3>This is a Modal Heading</h3>  
</div>  
<div class="modal-body">  
<h4>Aviso</h4>  
<p>Tu inscripcion ha sido realizada</p>                
</div>  
<div class="modal-footer">   
<a href="#" class="btn" data-dismiss="modal">Close</a>  
</div>  
</div>


<div id="error" class="modal hide fade in" >  
<div class="modal-header">  
<a class="close" data-dismiss="modal">×</a>  
<h3>This is a Modal Heading</h3>  
</div>  
<div class="modal-body">  
<h4>Aviso</h4>  
<p><?php if(isset($postulation_message)) echo $postulation_message; ?></p>                
</div>  
<div class="modal-footer">   
<a href="#" class="btn" data-dismiss="modal">Close</a>  
</div>  
</div>

<?php if($success_flag){ ?>
<script type="text/javascript">

  $('#success').modal({
    show: true
  });
</script>
<?php } ?>


<div class="content" id="content">
	
	<div class="container-fluid">
	  	<div class="row-fluid">
	    	<div class="span3 offset1 user-profile-left">
				<img class="user_image" src="<?php echo base_url().'img/profile/'.$image_profile ?>"/>
				<form action="user" method="POST">
					<?php if($postulation_flag) {?>
					<button id="participate_button" class="btn btn-large btn-success" type="submit" name="apply">POSTULAR A CONCURSO</button>
					<input type="hidden" name="validate" value="1"/>
					<?php } else{ ?>
					<button data-toggle="modal" id="participate_button" href="#error" class="btn btn-success btn-large">POSTULAR A CONCURSO</button>
	    			<?php } ?>
	    		</form>
	    	</div>
		    
		    <div class="span6 user-profile-right">
		    		
		    	<div class="space1"></div>
				<h1 class="profile-title"> <?php echo $name ?></h1>
				<div class="fb-like" data-send="true" data-layout="button_count" data-width="450" data-show-faces="false"></div>
		    	<?php
		    		echo '<ul class="skills-list">' ;
		    		foreach ($tags as $tag) {
						echo '<li> <a href="#">'.$tag.'</a></li>';
					}
					echo '</ul>';
				?>
				<h2 class="profile">Bio</h2>
				<div class="justify profile-content"><?php echo $bio;?></div>
				<div class="space1"></div>
				
				<h2 class="profile">Hobbies</h2>
				<div class="justify profile-content"><?php echo $hobbies;?></div>
				<div class="space1"></div>
				
				<h2 class="profile">Dreams</h2>
				<div class="justify profile-content"><?php echo $dreams;?></div>
				<div class="space1"></div>
				
			</div>
		</div>
		
		<div class="row-fluid">	
			<div class="space4"></div>	
		</div>
		
		<div class="row-fluid">			
			<div class="span3 offset1">		
				
			</div>
				
			<div class="span6">
				<?php if(isset($video_ID)){?>
					<h3> <?php echo $video_title;?></h3>
					<iframe width="600" height="400" src="http://www.youtube.com/embed/<?php echo $video_ID?>" frameborder="0" allowfullscreen></iframe>
					<br>
					
					<div class="social_data_container">			
						<div class="fb-like" data-href="http://www.youtube.com/watch?v=<?php echo $video_ID ?>" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>			    							
						<label class="youtubedata">
						<?php
							/*
							echo "<span id='youtubedata' class='badge badge-important'><i class='icon-thumbs-down icon-white'></i>$dislikes</span>";
							echo "<span id='youtubedata' class='badge badge-success'><i class='icon-thumbs-up icon-white'></i>$likes</span>";
							echo "<span id='youtubedata' class='badge badge-info'><i class='icon-eye-open '></i>$views</span>";
							*/
						?>
						</label>
					</div>	
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
					
				<form id="video_upload_form" action="" class="tab-content"  method="post">
					 
					<div class='tab-pane active' id='tab1'>
				   
					   	<div id="form_camera_video" style="display: block"> 
					   		<input name="name_cw" class="input-xlarge" type="text" placeholder="nombre-video">
							<div class="space1"></div>			
							<textarea name="description_cw" rows="3" class="video_description" placeholder="descripcion-video"></textarea>
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
					    	<div class="space1"></div>
					    	<a onclick="toggleContent()" class="btn">cancelar</a>
					    	<input type="hidden" name="id_cw" value="0"/>
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
					            'onUploadSuccess': onProcessingComplete
					          }
					        });
					      }
					
					      // 4. This function is called when a video has been successfully uploaded.
					      function onProcessingComplete(event) {

					      	document.forms["video_upload_form"].elements["id_cw"].value= event.data.videoId;
					      	
					      	document.forms["video_upload_form"].submit();
					      }
					
					    </script>
					</div>
					
					<div class='tab-pane' id='tab2'>
							
						<input name="url_ytb" class="input-xlarge" type="text" placeholder="url-video" value="">
						<input name="name_ytb" class="input-xlarge" type="text" placeholder="nombre-video">
						<div class="space1"></div>	
						<textarea name="description_ytb" rows="3" class="video_description" placeholder="descripcion-video"></textarea>
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

