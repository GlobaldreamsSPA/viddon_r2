<body>
 <div id="casting-container">
  <div id="casting-body">
  	<div class="col-left"></div>
  	<div class="row-fluid list-castings">
  	<h1>Castings Activos</h1>
		<div class="casting-item">
				<div class="left">
					<p class="title">Titulo Largo del Casting</p>
					<div id="image">
						<ul id="start-end">
							<li id="start-time">Inicio: 12/09/12</li>
							<li id="end-time">Término: 12/10/12</li>
						</ul>
					</div>
					<p class="footer">Casting creado por: Canal 13</p>
				</div>
				<div class="right">
					<p class="applies"></p>
					<img src="<?php echo base_url(); ?>img/canal-13.jpg"/>
					<p class="desc"></p>
					<p class="req"></p>
					<p class="cat"></p>
					<p class="time-left"></p>
					<button class="apply"></button>
				</div>
		</div>
	<p><?php echo $data['links']; ?></p>
	</div>
  </div>
 </div>
</body>