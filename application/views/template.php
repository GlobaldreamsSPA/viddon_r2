<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Viddon - Tu Talento, Nuestra Pasi&oacuten</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keyword" content="">

	<link href="<?php echo base_url()?>style/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/jquery.dataTables.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/jquery.cleditor.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/main.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/list-castings.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/list-view.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/publish-view.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/uniform.default.css" rel="stylesheet"/>
	<link href="<?php echo base_url()?>style/datepicker.css" rel="stylesheet"/>

 	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>	
	<script src="<?php echo base_url()?>js/bootstrap.js"></script>
	<script src="<?php echo base_url()?>js/jquery.cleditor.js"></script>
	<script src="<?php echo base_url()?>js/jquery.uniform.js"></script>
	<script src="<?php echo base_url()?>js/jquery.dataTables.js"></script>
	<script src="<?php echo base_url()?>js/bootstrap-datepicker.js"></script>

	<script type="text/javascript">
	      $(document).ready(function() {
	        $("textarea.rich_textarea").cleditor({
	          width:        500, // width not including margins, borders or padding
	          height:       200, // height not including margins, borders or padding
	          controls:     // controls to add to the toolbar
	                        "bold italic underline strikethrough subscript superscript | font size " +
	                        "style | color highlight removeformat | bullets numbering | outdent " +
	                        "indent | alignleft center alignright justify | undo redo | " +
	                        "link unlink",
	          colors:       // colors in the color popup
	                        "FFF FCC FC9 FF9 FFC 9F9 9FF CFF CCF FCF " +
	                        "CCC F66 F96 FF6 FF3 6F9 3FF 6FF 99F F9F " +
	                        "BBB F00 F90 FC6 FF0 3F3 6CC 3CF 66C C6C " +
	                        "999 C00 F60 FC3 FC0 3C0 0CC 36F 63F C3C " +
	                        "666 900 C60 C93 990 090 399 33F 60C 939 " +
	                        "333 600 930 963 660 060 366 009 339 636 " +
	                        "000 300 630 633 330 030 033 006 309 303",    
	          fonts:        // font names in the font popup
	                        "Arial,Arial Black,Comic Sans MS,Courier New,Narrow,Garamond," +
	                        "Georgia,Impact,Sans Serif,Serif,Tahoma,Trebuchet MS,Verdana",
	          sizes:        // sizes in the font size popup
	                        "1,2,3,4,5,6,7",
	          styles:       // styles in the style popup
	                        [["Paragraph", "<p>"], ["Header 1", "<h1>"], ["Header 2", "<h2>"],
	                        ["Header 3", "<h3>"],  ["Header 4","<h4>"],  ["Header 5","<h5>"],
	                        ["Header 6","<h6>"]],
	          useCSS:       false, // use CSS to style HTML when possible (not supported in ie)
	          docType:      // Document type contained within the editor
	                        '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
	          docCSSFile:   // CSS file used to style the document contained within the editor
	                        "", 
	          bodyStyle:    // style to assign to document body contained within the editor
	                        "margin:4px; font:10pt Arial,Verdana; cursor:text"
	        });
	      });
      
		$(document).ready(function() {
		    $('#datatables').dataTable({
        	"sPaginationType": "full_numbers"
    		});
		});

		$(function(){
			window.prettyPrint && prettyPrint();
			$('#dp1').datepicker();
		});

		/* comentarios perfil usuario*/
		function get()
		{
		 var input = $('#comment').val();
		 if ( $('#comment').val() == '' ){
		 alert('Empty!!!');}
		 else{
		 $('#post').prepend('<img src="img/profile/user.jpg" width="40px" height="40px"style="display:inline;float:left;">&nbsp;'+'<span style="color:gray;font-family:times new roman;"> Usuario </span> &nbsp;'+input + '<br/><br/> <hr>');}
		 $('#comment').val('');
		 };
		
    </script>

</head>

<body>	
	<div id="fb-root"></div>
	<script>
	    $(function () {

	        $("#file").uniform();

	    });
	    
		(function(d, s, id) 
		{
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	<!-- Codigo para el boton de loggin de google -->
	<?php
		require_once OPENID;
		$openid = new LightOpenID(HOME);
		$openid->identity = 'https://www.google.com/accounts/o8/id';
		$openid->required = array(
					'contact/email',
					'pref/language',
					'namePerson'
					);
		$openid->returnUrl = HOME.'/user/login';
		$auth_url = $openid->authUrl();
	?>

	<div id="headercontent">
	    <div id="upperhalf">
		    <div class="row-fluid">
		    	<div class="span5 header-text-left">
		    		<div style="float: right;margin-top: 3px;"class="fb-like" data-send="true" data-layout="button_count" data-width="450" data-show-faces="false"></div>
					<label style="color:white; font-weight: bold; margin-left: 55px; margin-top: 3px;">Viddon - Tu Talento, Nuestra Pasi&oacuten</label>
				</div>
				<div style="margin-top: 3px;" class="span2">
					<a  href="https://twitter.com/viddoncom" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @viddoncom</a>					
				</div>
				<div class="span4 offset1">
					<ul>
					<?php
						$id = $this->session->userdata('id');

						if($this->session->userdata('name') != FALSE)
						{
							$user = $this->session->userdata('name');
						}
						else if($this->session->userdata('email') != FALSE)
						{
							$user = $this->session->userdata('email');
						}
						else
							$user = "";

						if($id)
							echo "<li class='welcome-login'> Bienvenido ".anchor('user', $user).' '.anchor('user/logout',' (Cerrar sesión)');
						else
						{
							echo "<i class='icon-star icon-white'></i>";
							echo "<a href='".base_url()."home/login_hunter'>&iquestBuscas Talento?</a>";
							
						}
					?>
					</ul>
				</div>
				
		    </div>	
	    </div>
		
		<div id="lowerhalf">
			<div class="space05"></div>
			<div class="row offset1">
		 		<a class="anchor-image-logo span4" href="<?php echo HOME?>" title="Volver a la P&aacuteina Principal">
					<img class="image-logo" src="<?php echo base_url(); ?>img/Logo2.png"/>
				</a>
				
				<?php		
					if(!$id)
					{
						echo "<form action='".$auth_url."' method='POST'>";
						echo "<button id='login-button'/>";
						echo "</form>";
					}
				?>
				<!--
				<form class="form-search offset2 span3">
			  		<input type="text" class="input-medium">
			  		<button type="submit" class="btn search-btn">Search</button>
				</form>
				-->
			</div>
		</div>
	</div>
	<?php $this->load->view($content); ?>
</body>

<footer>
<ul class="row first">
	<li class="span3 offset1 footer-logo">
		<a href="<?php echo HOME?>"><img src="<?php echo base_url(); ?>img/logo-footer.png"/></a>
	</li>
	<li class="span2 offset1">
		<ul id="que-es-viddon">
			<li>
				<p>&iquestQU&Eacute ES VIDDON?</p>
			</li>
			<li>
				<a href="<?php echo HOME?>/home/what_is">ENT&EacuteRATE AQU&Iacute</a>
			</li>
		</ul>
	</li>
	<li class="span2">
		<ul id="siguenos">
			<li>
				<p>S&IacuteGUENOS</p>
			</li>
			<li>
				<ul>
					<li><a href="http://www.facebook.com/pages/Viddoncom/499177723428347?ref=hl"><img src="<?php echo base_url(); ?>img/fb-logo.png"/></a></li>
					<li><a href="https://twitter.com/ViddonCom"><img src="<?php echo base_url(); ?>img/twitter-logo.png"/></a></li>
				</ul>
			</li>
		</ul>
	</li>
	<li class="span3">
		<ul id="contacto">
			<li >
				<p>CONTACTO</p>
			</li>
			<li>
				<ul>
					<li><p>Email: <a href="mailto:contacto@viddon.com"><img src="<?php echo base_url(); ?>img/contacto.png"/></a></p></li>
					<li><p>Direcci&oacuten: <font color="#FF3D01">Las Violetas 2267</font></p></li>
					<li><p><font color="#FF3D01">Providencia, Santiago</font></p></li>
				</ul>
			</li>
		</ul>
	</li>
</ul>
<ul class"row">
	<li class="span8 offset1"><p class="second">Viddon - Copyright 2012</p></li>
</ul>
<ul class"row second">
	<li class="span4 offset1"><p class="second">Todos los derechos reservados | <a href="<?php echo base_url();?>docs/terms.pdf">Términos y condiciones</a></p></li>
</ul>
</footer>
<div class="space1"></div>
