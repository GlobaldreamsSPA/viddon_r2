<div class="content" id="content">
	<div class="container-fluid">
	  	<div class="row">
	  		<div class="span9">
	  			<div style="padding: 25px; border-radius: 5px; height:610px;"class="row-fluid">
	  				<div class="space2"></div>
	  				<image src='<?php echo HOME; ?>/img/foto_login_hunter.png' />
	  			</div>
	  		</div>
	  		<div class="span4">
	  			<div class="span3">
		  			<div class="row-fluid" style="border-radius: 5px; padding:35px; min-width: 290px;">	
				  		<?php echo form_open('hunter/verifylogin', array('class' => 'form-horizontal')); ?>
				  			<h4>Ingreso Hunter</h4>
							<input class="input-xlarge" name="email" value="<?php echo set_value('email'); ?>" type="text" id="inputEmail" placeholder="Email">
							<?php echo form_error('email'); ?>
							<div class="space05"></div>
							<input class="input-medium" name="password" value="<?php echo set_value('password'); ?>" type="password" id="inputPassword" placeholder="Password">
							<button style="margin-left: 30px;" type="submit" class="btn btn-primary">Ingresar</button>
							<?php echo form_error('password'); ?>
						</form>
					</div>
					<div class="space1"></div>
					<div class="row-fluid" style="border-radius: 5px; padding:26px; min-width: 307px;">
						<form class="form-horizontal">
							<h4>Cont&aacutectanos</h4>
				            <input class="input-xlarge" type="text" name="contact_name" id="input1" placeholder="Nombre">
							<div class="space1"></div>		            
				            <input class="input-xlarge" type="text" name="contact_email" id="input2" placeholder="Correo">
				           	<div class="space1"></div>
				           	<textarea class="input-xlarge" name="contact_message" id="input3" rows="7" class="span5" placeholder="Mensaje de Contacto"></textarea>
							<div class="space1"></div>
							<button type="submit" class="btn btn-primary">Enviar</button>
				        </form>
			        </div>	
			       	<div class="space1"></div>	
				</div>   	
	  		</div>
	  		<div class="space4"></div>
		</div>
  	</div>
  	<div class="space2"></div> 	
</div>