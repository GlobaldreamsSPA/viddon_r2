<div class="content" id="content">
	<div class="container-fluid">
	  	<div class="row">
	  		<div class="span8">
	  			<div id="grow" style="border-radius: 5px; margin-left:3%;" class="row-fluid">
	  				<image style="margin:5%; margin-left:6% !important; width:87%;" src='<?php echo HOME; ?>/img/foto_login_hunter.png' />
	  			</div>
	  		</div>
	  		<div class="span4" id="variable" style="min-height: 0px !important; ">
		  			<div class="row-fluid" style="border-radius: 5px; margin-left:8%">	
		  				<h4 style="margin-left:15%;">Ingreso Hunter</h4>
				  		<?php echo form_open('hunter/verifylogin', array('class' => 'form-horizontal')); ?>
							<div  style="text-align:center;">
								<input style="width:65%;" name="email" value="<?php echo set_value('email'); ?>" type="text" id="inputEmail" placeholder="Email">
								<?php echo form_error('email'); ?>
								<div class="space05"></div>
								<input style="width:35%;" name="password" value="<?php echo set_value('password'); ?>" type="password" id="inputPassword" placeholder="Password">
								<button style="margin-left: 9%; width:20% !important;" type="submit" class="btn btn-primary">Entrar</button>
							</div>
							<?php echo form_error('password'); ?>
						</form>
					</div>
					<div class="space1"></div>
					<div class="row-fluid" style="border-radius: 5px; margin-left:8%;">
						<form class="form-horizontal">
							<h4 style="margin-left:15%;">Cont&aacutectanos</h4>
							<div  style="text-align:center;">
					            <input style="width:65%;" type="text" name="contact_name" id="input1" placeholder="Nombre">
								<div class="space1"></div>		            
					            <input style="width:65%;" type="text" name="contact_email" id="input2" placeholder="Correo">
					           	<div class="space1"></div>
					           	<textarea style="width:69%;" name="contact_message" id="input3" rows="7" class="span5" placeholder="Mensaje de Contacto"></textarea>
							</div>
							<div class="space1"></div>
							<button style="margin-left:15%;  width:20% !important;" type="submit" class="btn btn-primary">Enviar</button>
				        </form>
			        </div>	
	  		</div>
		</div>
  	</div>
  	<div class="space2"></div> 	
</div>