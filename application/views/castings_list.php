<div class="content" id="content">	
	<div class="container-fluid">
			<div style="border-radius:25px; padding:20px; max-width: 1250px;" class="row-fluid">
			<?php
				$i=0; 
				foreach ($casting_list as $casting) {
					$i++;
					if(($i-1)%3 == 0 or $i==1) echo "<div class='row-fluid'>";
					?>
					<div id="main_casting" class='span4'>
						<div class="space1"></div>
						<?php
							echo "<img style='height:100%; width: 100%;' src='".HOME.'/img/casting_image/'.$casting[0].".png'/>";
						?>
						<div class="container video_text_main span12">
							<div class="space1"></div>
							<div class="row row_text_main">
								<div class="span3 offset1">
									<?php
										echo "<img class='user_image_main_page' src='".HOME.'/img/logo_hunter/'.$casting[2].".jpg'/>";
									?>
								</div>
								<div class="span4 offset3">
									<button style="margin-top:10px; margin-left: 15px; font-weight:bold;" class="btn btn-success"> VER MAS INFORMACI&OacuteN</button>
								</div>
							</div>
						</div>
					</div>
				<?php if($i%3 == 0 || $i == count($casting_list)) echo "</div>"; }?>
				<div class="row-fluid">
					<div class="space1"></div>
					<div class="pagination">  
					  <ul id="pagination_bt">
					  	  
					    <li <?php if($page==1) echo "class='disabled'";?> ><a href=<?php echo base_url()."home/casting_list/".($page-1);?>>Prev</a></li>  
						<?php for($i = 1; $i <= $chunks; $i++) { ?>
							<li <?php if($page==$i) echo "class='disabled'";?> ><a href=<?php echo base_url()."home/casting_list/".$i;?> > <?php echo $i; ?></a></li>  
						<?php } ?>
					    <li <?php if($page==$chunks) echo "class='disabled'";?> ><a href=<?php echo base_url()."home/casting_list/".($page+1);?>>Next</a></li>
					     
					  </ul>  
					</div>  
					<div class="space1"></div>	
				</div>	
			</div>

			

  	</div>
  	<div class="space2"></div>
/div>