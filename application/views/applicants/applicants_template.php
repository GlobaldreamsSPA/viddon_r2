<div id="error" class="modal hide fade in">
<div class="modal-header">
<a class="close" data-dismiss="modal"><i class="icon-remove"></i></a>  
</div>
<div class="modal-body">
<h4>Aviso</h4>
<p><?php if(isset($postulation_message)) echo $postulation_message; ?></p>              
</div>
<div class="modal-footer">
<?php echo anchor(HOME,'Volver al Home',"class='btn btn-green'"); ?>
<a href="#" class="btn" data-dismiss="modal">Volver al Perfil</a>
</div>
</div>

<div id="del-video" class="modal hide fade in" >
<div class="modal-header">  
<a class="close" data-dismiss="modal"><i class="icon-remove"></i></a> 
</div>
<div class="modal-body">
<h4>Aviso</h4>
<p><?php if(isset($delete_video_message)) echo $delete_video_message; ?></p>      
</div>
<div class="modal-footer">
<?php echo anchor('user', 'Volver al Perfil',"class='btn'") ?>
</div>
</div>

<?php if(isset($delete_video_message)){ ?>
<script type="text/javascript">

  $('#del-video').modal({
    show: true
  });
</script>
<?php } ?>

<div class="content" id="content">
	<div class="container-fluid">
	  	<div class="row">
	  		<div class="span8">
	  			<div  style="border-radius: 5px; margin-left:3%;" id="variable" class="row-fluid">
		  			<div style="padding: 2%;">
		  				<?php $this->load->view($applicant_content);  ?>
		  			</div>
		  		</div>
			</div>	
		
			<div class="span4">
				<div  style="border-radius: 5px; margin-left:8%; text-align:center;" id="grow" class="row-fluid">
					<h3 id="profile" >Casting recomendado</h3>
					<img style="margin-top: 16px;" src="<?php echo HOME.'/img/casting_image/mini_banner_c1.png';?>">
		  			<div class="space2"></div>
					<h3 id="profile" >Galeria Videos</h3>
					<img style="margin-top: 16px;" src="<?php echo HOME.'/img/dummy_galeria_videos.png';?>">
		  			<a class="MBT-readmore" style="float: right;" ref="#">Ver m&aacute;s >></a>
		  			<div class="space2"></div>						
					<h3 id="profile" >Galeria Fotos</h3>
					<img style="margin-top: 16px;"  src="<?php echo HOME.'/img/dummy_galeria_fotos.png';?>">
					<a class="MBT-readmore"  style="float: right;" ref="#">Ver m&aacute;s >></a>
					<div class="space4"></div>
				</div>
			</div>
			
		</div>
		
		</div>
</div>