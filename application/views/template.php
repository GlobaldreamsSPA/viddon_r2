<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Viddon - Tu Talento, Nuestra Pasi&oacute;n</title>
	<meta name="description" content="">
	<meta name="keyword" content="">


	<link href="<?php echo base_url()?>style/main.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/jquery.dataTables.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/jquery.cleditor.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/list-castings.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/list-view.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/publish-view.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/uniform.default.css" rel="stylesheet"/>
	<link href="<?php echo base_url()?>style/datepicker.css" rel="stylesheet"/>
	<link href="<?php echo base_url()?>style/chosen.css" rel="stylesheet"/>

 	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>	
 	<script src="<?php echo base_url()?>js/chosen.jquery.js"></script>
	<script src="<?php echo base_url()?>js/bootstrap.js"></script>
	<script src="<?php echo base_url()?>js/jquery.cleditor.js"></script>
	<script src="<?php echo base_url()?>js/jquery.uniform.js"></script>
	<script src="<?php echo base_url()?>js/jquery.dataTables.js"></script>
	<script src="<?php echo base_url()?>js/bootstrap-datepicker.js"></script>	
	<script src="<?php echo base_url()?>js/chosen.jquery.js"></script>


</head>

<body>	
	<div id="fb-root"></div>
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
		    <div class="row-fluid" >
		    	<div class="span5 header-text-left">
					<a class="anchor-image-logo" href="<?php echo HOME?>" style="margin-left: 50px;"title="Volver a la P&aacute;ina Principal">
						<img class="image-logo" src="<?php echo base_url(); ?>img/logo.png"/>
					</a>
					<a href="<?php echo HOME?>/home/what_is" style="color:white; font-weight: bold; margin-left: 15px;">
						Tu Talento, Nuestra Pasi&oacute;n
					</a>
					<div style="float: right;" class="fb-like" data-send="true" data-layout="button_count" data-width="450" data-show-faces="false"></div>
				</div>
				<div class="span2">
					<a  href="http://www.facebook.com/pages/Viddoncom/499177723428347?ref=hl"> <img style="width: 25px; height: 25px;" src="<?php echo base_url(); ?>img/fb-logo.png"/></a>
					<a href="https://twitter.com/ViddonCom"><img style="width: 25px; height: 25px;" src="<?php echo base_url(); ?>img/twitter-logo.png"/></a>
				</div>
				<div class="span4">
					<?php
					
						/*verificacion usuario postulante*/
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
						
						/*verificacion ususario hunter*/
						$id_h = $this->session->userdata('logged_in');				
						if($id_h)
						{
							$name = $this->session->userdata('logged_in');
							$name= $name["name"];
						}
						
						if($id)
						{
							echo "<div class='span11 offset1'>";						
							echo "<li class='welcome-login'> Bienvenido ".anchor('user', $user).' '.anchor('user/logout',' (Cerrar sesi&oacuten)');
							echo "</div>";
						}
						
						elseif ($id_h) 
						{
							echo "<div class='span11 offset1'>";													
							echo "<li class='welcome-login'> Bienvenido ".anchor('hunter', $name).' '.anchor('hunter/logout',' (Cerrar sesi&oacuten)');
							echo "</div>";
						
						}
						else
						{
							echo "<div class='span5 offset2'>";
							echo "<i class='icon-star icon-white'></i>";
							echo "<a href='".base_url()."home/login_hunter'>&iquestBuscas Talento?</a>";
							echo "</div>";
							
						}
					
						if(!$id && !$id_h)
						{
							echo "<div id='login-button-container' class='span5'>";
							echo "<form action='".$auth_url."' method='POST'>";
							echo "<button id='login-button'>";
							echo "<img id='login-button-image' src='".HOME."/img/login-gmail-es.png' />";
							echo "</button>";
							echo "</form>";
							echo "</div>";
						}
					
					?>				
				</div>
				
		    </div>	
	    </div>
		
		<div id="lowerhalf">
			<div class="space05"></div>
			<div class="row offset1">
		 		
				
				
				<!--
				<form class="form-search offset2 span3">
			  		<input type="text" class="input-medium">
			  		<button type="submit" class="btn search-btn">Search</button>
				</form>
				-->
			</div>
		</div>
	</div>

	<?php $this->load->view($content,$inner_args); ?>
	
	<script type="text/javascript">
	      
	    if($(".chzn-select").length > 0)
			$(".chzn-select").chosen({no_results_text: "No se encontraron resultados"});

		if($(".rich_textarea").length > 0)	      
	        $("document").ready(function() {
			    $("textarea.rich_textarea").cleditor({
			          width:        $('.span12').width(), // width not including margins, borders or padding
			          height:       230, // height not including margins, borders or padding
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
		
		if($(".rich_textarea_pop_up").length > 0)	      
	        $("document").ready(function() {
			    $("textarea.rich_textarea_pop_up").cleditor({
			          width:        400, // width not including margins, borders or padding
			          height:       230, // height not including margins, borders or padding
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
		
      	if($("#datatables").length > 0)
      		$(document).ready(function() {
			    $('#datatables').dataTable({
		    	"sPaginationType": "full_numbers"
				});
			});
		
		if($("#dp1").length > 0)
			$(function(){
				window.prettyPrint && prettyPrint();
				$("#dp1").datepicker();
			});
		
		if($("#dp2").length > 0)
			$(function(){
				window.prettyPrint && prettyPrint();
				$("#dp2").datepicker();
			});
		
		/* comentarios perfil usuario*/
		function get()
		{
			 var input = $('#comment').val();
			 
			 if ( $('#comment').val() == '' )
			 {
			 	alert('Debes escribir un comentario antes de Enviarlo. Intenta nuevamente');
			 }
			 else
			 {
			 	$('#post1').prepend('<img src="../img/profile/user.jpg" width="40px" height="40px"style="display:inline;float:left;">&nbsp;'+'<span style="color:gray;font-family:times new roman;"> Usuario </span> &nbsp;'+input + '<br/><br/> <hr>');
			 }
			 $('#comment').val('');
		};
		 
		if($(".chzn-select").length > 0)
			$(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true});
   		
		if($("#file").length > 0)
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

		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
    	
    	if($("#grow").length > 0 && $("#variable").length > 0  )
		{
			$('#grow').css({
				'height': $('#variable').height()
			});
		    	
		    jQuery('#variable').bind( 'resize', function(e) {
					  
				$('#grow').css({
					    'height': $('#variable').height()
				});
			});
			
		}
		
		if($(".chosen_filter").length > 0)
		{
			var function_clean_select_all = function () 
			{
				
				 $("option",this).each(function () {
					if(this.selected && this.value == -1)
					{
						$(this).parent().children("option").each(function () {
							if($(this).val() == -2)
								$(this).prop('selected', false);
							else
								$(this).prop('selected', true);
						});
						$(this).prop('selected', false);
						$(this).parent().trigger('liszt:updated');
						return false;
					}
					
					if(this.selected && this.value == -2)
					{
						$(this).parent().children("option").each(function () {
							$(this).prop('selected', false);
						});
						$(this).prop('selected', false);
						$(this).parent().trigger('liszt:updated');
						return false;
					}
					
			      });
			};

			$(".chosen_filter").change(function_clean_select_all);
			$('.chosen_filter').trigger('change');

		}



		var update_chosen_filter = function (event) 
		{
			
			var regExp1 = new RegExp(event.data.regexp); 
	        var result = regExp1.exec($(event.data.target).attr("href"));
	        var temp = (""+result).substr(0,(""+result).length - 1);
	        temp = temp.substr(0,temp.lastIndexOf('/')+1)
	        var uri="";
			
			$("option",this).each(function () {
				if(this.selected)
			    	uri= uri + this.value +"_";
			});
			     
			uri= uri.substr(0,uri.length - 1);
			if(uri=="")
				uri=-2;
	        result = temp + uri + "/";
			    
			$(event.data.target).attr("href",$(event.data.target).attr("href").replace(regExp1,result));

		};	

		if($("#filter").length > 0)
		{
			$("#filter").change({regexp: '/[0-9]+/[0-9_-]+/',target: '#filter_button'},update_chosen_filter);
			$('#filter').trigger('change');
		}

		if($("#filter_a1").length > 0)
		{
			$("#filter_a1").change({regexp: '/applicants_list/[0-9]+/[0-9]+/[0-3]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/',target: '#filter_button'},update_chosen_filter);
			$('#filter_a1').trigger('change');
		}

		if($("#filter_a8").length > 0)
		{
			$("#filter_a8").change({regexp: '/applicants_list/[0-9]+/[0-9]+/[0-3]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/',target: '#filter_button'},update_chosen_filter);
			$('#filter_a8').trigger('change');
		}

		if($("#filter_a7").length > 0)
		{
			$("#filter_a7").change({regexp: '/applicants_list/[0-9]+/[0-9]+/[0-3]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/',target: '#filter_button'},update_chosen_filter);
			$('#filter_a7').trigger('change');
		}

		if($("#filter_a6").length > 0)
		{
			$("#filter_a6").change({regexp: '/applicants_list/[0-9]+/[0-9]+/[0-3]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/',target: '#filter_button'},update_chosen_filter);
			$('#filter_a6').trigger('change');
		}

		if($("#filter_a5").length > 0)
		{
			$("#filter_a5").change({regexp: '/applicants_list/[0-9]+/[0-9]+/[0-3]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/',target: '#filter_button'},update_chosen_filter);
			$('#filter_a5').trigger('change');
		}

		if($("#filter_a4").length > 0)
		{
			$("#filter_a4").change({regexp: '/applicants_list/[0-9]+/[0-9]+/[0-3]+/[0-9_-]+/[0-9_-]+/[0-9_-]+/',target: '#filter_button'},update_chosen_filter);
			$('#filter_a4').trigger('change');
		}

		if($("#filter_a3").length > 0)
		{
			$("#filter_a3").change({regexp: '/applicants_list/[0-9]+/[0-9]+/[0-3]+/[0-9_-]+/[0-9_-]+/',target: '#filter_button'},update_chosen_filter);
			$('#filter_a3').trigger('change');
		}

		if($("#filter_a2").length > 0)
		{
			$("#filter_a2").change({regexp: '/applicants_list/[0-9]+/[0-9]+/[0-3]+/[0-9_-]+/',target: '#filter_button'},update_chosen_filter);
			$('#filter_a2').trigger('change');
		}


		

		var update_state_filter = function (event) 
		{
			
			var regExp1 = new RegExp(event.data.regexp); 
	        var result = regExp1.exec($(event.data.target).attr("href"));
	        var temp = (""+result).substr(0,(""+result).length - 2);
	            
	        result = temp + $(event.data.src).val() + "/";
			    
			$(event.data.target).attr("href",$(event.data.target).attr("href").replace(regExp1,result));

		};	
		
		if($("#apply_status").length > 0)
		{
			
			$("#apply_status").change({regexp: '/applicants_list/[0-9]+/[0-9]+/[0-3]/',target: '#filter_button',src: '#apply_status'},update_state_filter);
			$('#apply_status').trigger('change');
		}

		if($("#casting_status").length > 0)
		{				
			$("#casting_status").change({regexp: '/[0-9]+/[0-3]/',target: '#filter_button',src: '#casting_status'},update_state_filter);
			$('#casting_status').trigger('change');
		}



		if($("iframe").attr('src').indexOf("youtube") >= 0){
			$("iframe").each(function(){
			  var ifr_source = $(this).attr('src');
			  var wmode = "&wmode=opaque";
			  $(this).attr('src',ifr_source+wmode);
			});
		}
			    	    
    </script>
</body>

<footer>

<ul class"row">
	<li class="span8"><p class="second">GlobalDreams SPA | Las Violetas 2267, Providencia, Santiago | <a href="<?php echo base_url();?>docs/terms.pdf">T&eacuterminos y condiciones</a> | <a href="mailto:contacto@viddon.com">Cont&aacutectanos</a></p></p></li>
</ul>
<ul class"row">
	<li class="span8"><p class="second">Viddon &copy; 2013 | Todos los derechos reservados</p></li>
</ul>
</footer>