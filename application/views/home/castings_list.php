<div class="content" id="content">	
	<div class="container-fluid">
			<div style="border-radius: 5px;" class="row-fluid">
			
			<div class="row control-group">
				<div class="span2 offset1">
					<h2 class="control-label" id="profile" name="category">Categor&iacutea</h2>
				</div>
				<div style="margin-top:15px;" class="span2 controls">
					<select>
						<option value="reality">Reality</option>
						<option value="teleserie">Teleserie</option>
						<option selected="selected" value="todos">Todos</option>			  			
						<option value="show_talentos">Show de Talentos</option>
			  			<option value="documental">Documental</option>
			  			<option value="festival">Festival</option>
			  			<option value="otros">Otros</option>
					</select>
				</div>
				<div style="margin-top:15px;" class="span2">
					<button class="btn btn-info">Actualizar</button>
					
				</div>
			</div>
			<?php
				$i=0; 
				foreach ($casting_list as $casting) {
					$i++;
					if(($i-1)%3 == 0 or $i==1) echo "<div class='row-fluid'>";
					?>
					<div id="main_casting" class='span4'>
						<div class="space1"></div>
							<img style='height:100%; width: 99%;' src="<?php echo $casting['image']; ?>"/>
						<div class="container video_text_main span12">
							<div class="space1"></div>
							<div class="row row_text_main">
								<div class="span3 offset1">
									<img class='user_image_main_page' src="<?php echo $casting['logo'] ?>"/>
								</div>
								<div style="margin-top:2%;font-weight:bold;" class="span3">
									<p><?php echo $casting['title'] ?></p>
								</div>
								<div class="span4">
									<button style="margin-top:3%; margin-left: 5%; font-weight:bold;" class="btn btn-success" onclick="window.location = '<?php echo site_url("home/casting_detail"); ?>'">MAS INFORMACI&OacuteN</button>
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
</div>
