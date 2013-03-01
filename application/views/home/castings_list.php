<div class="content" id="content">	
	<div class="container-fluid">
			<div style="border-radius: 5px;" class="row-fluid">
			
			<div class="row control-group">
				<div class="span2 offset1">
					<h2 class="control-label" id="profile" name="category">Categor&iacutea</h2>
				
				
				<?php
					//if(isset($actual_categories)) var_dump($actual_categories);
					//if(isset($categories)) var_dump($categories);
					//if(isset($categories_cant)) echo $categories_cant." categorias.<br />";
				?>
				</div>
						
				<div style="margin-top:15px;" class="span2 controls">
					<?php 						
						echo form_multiselect('categories[]', $categories, $actual_categories,"class='chzn-select' id='filter' style='width:100%' data-placeholder='Filtra por categoria'");
					?>
				</div>
				
				<div style="margin-top:15px;" class="span2">
					<a href="<?php echo HOME."/home/casting_list/1/"?>" id="filter_button" class="btn btn-info">Actualizar</a>
					
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
							<a href="<?php echo site_url("home/casting_detail/".$casting['id']); ?>">
	 							<img style='height:100%; width: 99%;' src="<?php echo $casting['full_image']; ?>"/>
							</a>
							<div class="container video_text_main span12">
							<div class="space1"></div>
							<div class="row row_text_main">
								<div class="span3">
									<img class='user_image_main_page' src="<?php echo $casting['logo'] ?>"/>
								</div>
								<div style="margin-top:2%;font-weight:bold;" class="span4">
									<p><?php echo $casting['title'] ?></p>
								</div>
								<div class="span4">
									<button style="margin-top:3%; margin-left: 5%; width: 100%; text-align:center font-weight:bold;" class="btn btn-success" onclick="window.location = '<?php echo site_url("home/casting_detail/".$casting['id']); ?>'">MAS INFORMACI&OacuteN</button>
								</div>
							</div>
						</div>
					</div>
				<?php if($i%3 == 0 || $i == count($casting_list)) echo "</div>"; }?>
				<div class="row-fluid">
					<div class="space1"></div>
					<div class="pagination">  
					  <ul id="pagination_bt">
					  	  
					  	<li <?php if($page==1) echo "class='disabled'";?> ><a <?if($page!=1) echo "href= '".base_url()."home/casting_list/".($page-1)."/".$actual_categories_url."'";?>>Prev</a></li>  
						<?php for($i = 1; $i <= $chunks; $i++) { ?>
							<li <?php if($page==$i) echo "class='disabled'";?> ><a <?if($page!=$i) echo "href= '".base_url()."home/casting_list/".$i."/".$actual_categories_url."'";?> > <?php echo $i; ?></a></li>  
						<?php } ?>
					    <li <?php if($page==$chunks) echo "class='disabled'";?> ><a <?if($page!=$chunks) echo "href= '".base_url()."home/casting_list/".($page+1)."/".$actual_categories_url."'";?>>Next</a></li>
					     
					  </ul>  
					</div>  
					<div class="space1"></div>	
				</div>	
			</div>

			

  	</div>
  	<div class="space2"></div>
</div>
