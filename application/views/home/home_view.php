<script>
	$(document).ready(function() {
		$('#rankingdatatable').dataTable( {
			"aaSorting": [[ 3, "desc" ]]
		} );
	} );
</script>

<div class="modal fade hide" id="playermodal" tabindex="-1" role="dialog" aria-hidden="true">
	<div style="padding: 0px;" class="modal-body">
	</div>
</div>

<div class="content" id="content">
	<div class="container-fluid">
		<div class="row">
			<div class= "span8">
		  		<div style="border-radius: 5px; margin-left:3%;" id="variable" class="row-fluid">
		  			<div style="padding-top:2.8%; border-top-left-radius: 5px; border-top-right-radius: 5px; padding-bottom:0.5%; background:url(<?php echo HOME."/img/bgslide.png" ?>)">
			  			<div style="margin-left: 2.5%; width: 95%;" id="myCarousel" class="carousel slide">
							<!-- Carousel items -->
							<div class="carousel-inner">
							    <div class="active item">
							    	<a href="<?php echo base_url().'user/fb_login'; ?>">	
				  						<img style="height:100%; width:100%;" src="<?php echo HOME."/img/concurso200k.png" ?>">
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
					</div>
					
					<div class="space1"></div>

					<ul style="border-bottom: 0px;" class="nav nav-tabs">
						<li class="active"><a class="home_tabs" href="#videos" data-toggle="tab">Últimos Videos</a></li>
						<li><a href="#ranking" class="home_tabs" data-toggle="tab">Artistas más populares</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane active" id="videos">		
			  			<div class="row">
				  			<?php echo form_open('home',array('method' => 'get')); ?>
								<div style="margin-left: 6%; margin-top:15px;" class="span3">
									<input id='filter' style='width:110%;' placeholder="Busca por t&iacute;tulo" name="search_terms"></input>
								</div>
								<div style="margin-top:15px;" class="span2">
									<input type="submit" style="position: relative; bottom: 03px; left: 15px;" id="filter_button" class="btn btn-info" value="Buscar"/>
								</div>
							</form>
						</div>
					
						<?php
						$i=0; 
						foreach ($video_list as $video) {
							$i++;
							if(($i-1)%3 == 0 or $i==1) 
								echo "<div style='margin-left: 1px;' class='row'>";
							?>
							<div id="main_videos_list" class='span4'>
								<div class="space1"></div>
								<a href="<?php echo HOME.'/home/video?id='.urlencode($video[1]).'&name='. urlencode($video[0]).'&iduser='.urlencode($video[2]).'&username='.urlencode($video[4]).'&description='.urlencode($video[3]).'&userlastname='.urlencode($video[6]).'&image='.urlencode($video[5]) ?>" data-target="#playermodal" data-toggle="modal">							
									<div class="image">
										<img class="fade_new" src="<?php echo 'http://img.youtube.com/vi/'.$video[1].'/0.jpg'; ?>" alt=""/>
									    <img class="hoverimage" src="<?php echo HOME.'/img/player_arrow.png'; ?>" alt="" />
									</div>
								</a>
								<span class="arrow"></span>
								<div class="container video_text_main span12">
									<div class="space1"></div>
									<div class="row row_text_main">
										<div class="span3 offset1">
										<a class="home-video-author" href="<?php echo HOME.'/user/index/'.$video[2]; ?>">
											<?php
											if(file_exists(APPPATH.'/../img/gallery/'.$video[5]) == TRUE)
												echo "<img class='user_image_main_page' src='".HOME.'/img/gallery/'.$video[5]."'/>";
											else
												echo "<img class='user_image_main_page' src='".HOME."/img/profile/user.jpg'/>";
											?>
										</a>
										</div>
										<div class="span7">
											<div style="margin-bottom: 7px;"class="home-video-title"><?php echo $video[0]; ?></div>
											<span class="home-video-author">por </span><a class="home-video-author" href="<?php echo HOME.'/user/index/'.$video[2]; ?>"><?php echo $video[4]; ?></a>								
										</div>
									</div>
								</div>
							</div>
						<?php 
							if($i%3 == 0 || $i == count($video_list)) 
								echo "</div>"; 
						}?>
						<div class="row">
							<div class="space1"></div>
							<div class="pagination">  
							  <ul id="pagination_bt">
							    <li <?php if($page==1) echo "class=disabled";?>><a <?php if($page!=1) echo "href='".base_url()."home/index/".($page-1).$get_uri."'";?>>Prev</a></li>  
								<?php
								$pag_size = 16; 
								$margen = $pag_size/2;
								
								$begin_pag = $page - $margen;
								if($begin_pag < 0) $begin_pag = 1;
								
								$end_pag = $page + $margen;
								if($end_pag > $chunks) $end_pag = $chunks;
								
								for($i = $begin_pag; $i <= $end_pag; $i++){ 
									?>
									<li <?php if($page==$i) echo "class=disabled";?>><a <?php if($page!=$i) echo "href='".base_url()."home/index/".$i.$get_uri."'";?> > <?php echo $i; ?></a></li>  
								<?php 
								} 
								?>
							    <li <?php if($page==$chunks) echo "class=disabled";?>><a <?php if($page!=$chunks) echo "href='".base_url()."home/index/".($page+1).$get_uri."'";?>>Next</a></li>
							     
							  </ul>  
							</div>  
							<div class="space1"></div>	
						</div>	
					</div>
			    	<div class="tab-pane" id="ranking">
			    		<div class="space1"></div>
		  				<div class="row" style="padding-right: 5%;padding-left: 4%">
		  					<table id="rankingdatatable" class="table">
			          			<thead>
						            <tr>
							            <th>Imagen</th>
							            <th>Bio</th>
							            <th>Video Principal</th>
							            <th>Likes</th>
						            </tr>
			          			</thead>
				          		<tbody>
				          	
					          	<?php
					          	 if(isset($ranking))
						          	foreach ($ranking as $applicant) {?>
										<tr>
								            <td style="width: 15%; vertical-align:middle;">
								            	<a class="home-video-author" href="<?php echo HOME.'/user/index/'.$applicant['id'] ?>">
													<?php
													if(file_exists(APPPATH.'/../img/gallery/'.$applicant["image"]) == TRUE)
														echo "<img class='user_image_main_page' src='".HOME."/img/gallery/".$applicant['image']."'/>";
													else
														echo "<img class='user_image_main_page' src='".HOME."/img/profile/user.jpg'/>";
													?>
												</a>
											</td>
								            <td style="vertical-align:middle;">
								            	<a class="home-video-author" href="<?php echo HOME.'/user/index/'.$applicant['id'] ?>">
								            		<?php echo $applicant["first_name"]." ".$applicant["last_name"]?>
								            	</a>
								            	<br>
								            	<?php echo substr(strip_tags($applicant['bio']),0,120)."..";?> <a href="<?php echo HOME.'/user/index/'.$applicant['id'] ?>">
								            		(ver m&aacute;s)
								            	</a>
								            </td>
								            <td style="width: 30%; vertical-align:middle;">
								            	<a href="<?php echo HOME.'/home/video_ranking?id='.urlencode($applicant["video_id_y"]).'&title='. urlencode($applicant["video_title"]).'&iduser='.urlencode($applicant['id']) ?>" data-target="#playermodal" data-toggle="modal">							
													<div class="image">
														<img class="fade_new" src="<?php echo 'http://img.youtube.com/vi/'.$applicant["video_id_y"].'/0.jpg'; ?>" alt=""/>
													    <img class="hoverimage" src="<?php echo HOME.'/img/player_arrow.png'; ?>" alt="" />
													</div>
												</a>
								            </td>
								            <td style="font-weight:bold;vertical-align:middle;"><?php echo $applicant["likes"]?></td>
							            </tr>    
					              	<?php }?>
				          		</tbody>
			        		</table>
			        		<div class="space2"></div>
			        		<div class="space2"></div>

			    		</div>
			  		</div>
				</div>
			</div>
		</div>
			<div class="span4">
			  	<div style="border-radius: 5px; margin-left:8%; text-align:center;" id="grow" class="row-fluid">
			  		<div class="space1"></div>
			  		<h2 id="profile"  style="font-weight:bold;">Casting Viddon</h3>
			  		<?php foreach($castings as $casting){ ?>
			  			<a href="<?php echo site_url("home/casting_detail/".$casting['id']); ?>">
		  					<img style="margin-top: 7%; width: 84%; " src="<?php echo $casting['image']; ?>">
		  				</a>
		  			<?php } ?>
					<div class= "space2"></div>
					<div class= "space2"></div>
					<div class="social_container">
						<h3 id="profile"> Buscanos en Redes</h3>
					
						<div class="row">
							<div class="span4">
								<a href="https://twitter.com/ViddonCom" target=”_blank”>
			  						<img style="margin-top: 7%; width: 74%; " src="<?php echo HOME."/img/social_container_t.png"; ?>">
			  					</a>
			  				</div>
			  				<div class="span4">	
			  					<a  href="http://www.facebook.com/pages/Viddoncom/499177723428347?ref=hl" target=”_blank”>
			  						<img style="margin-top: 7%; width: 74%; " src="<?php echo HOME."/img/social_container_f.png"; ?>">
			  					</a>
			  				</div>
			  				<div class="span4">	
			  					<img style="margin-top: 7%; width: 74%; " src="<?php echo HOME."/img/social_container_w.png"; ?>">
			  				</div>
		  				</div>
					</div>
					
					<div class= "space2"></div>

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