<div style="overflow:hidden; padding:2%; margin-left: 2%;" class="row">
	<div class="row">
		<div class="span8">
			<div style="font-size: 18px;" id="profile" ><?php echo $title;?></div>
		</div>
		<div class="span3">
			<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo HOME.'/user/index/'.$iduser; ?>&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=true&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=374106952676336" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>
		</div>
		<div class="span1">
			<a class="close" data-dismiss="modal"><i class="icon-remove"></i></a>  
		</div>
	</div>
	<div class="row">
		<div style="padding:5%;">
			<iframe width="100%" height="270px" src="http://www.youtube.com/embed/<?php echo $id_video.'?rel=0&autoplay=1&showinfo=0'?>" frameborder="0" allowfullscreen></iframe> 
		</div>
	</div>
</div>