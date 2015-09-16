		<hr />
		<div class="container">
			<div class="row">
				<div class="col-xs-4">
					<footer class="footer">
				       <p>&copy; LexStanley 2015</p>
				       <?php 	echo base_url();?>
				  </footer>
				</div>
				<div class="col-xs-4"></div>
				<div class="col-xs-4"></div>
					<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
					<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
					<script src="<?php echo base_url(); ?>assets/js/fileinput.min.js"></script>
				  <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
				  <script src="<?php echo base_url(); ?>assets/js/twitter-bootstrap-hover-dropdown.min.js"></script>

					<script>
							$(function(){
									$("#enviar").click(function (){

										var archivos = document.getElementById("archivo1");
										var archivo = archivos.files;

										var archivos = new FormData();

										archivos.append("archivo" + 1, archivo[0]);

										$.ajax({
												url: "<?php echo base_url(); ?>Procesos/Upload",
												type: "POST",
												contentType: false,
												data: archivos,
												processData: false,
												cache: false
										})
												.done(function(res){;
														$('#mensaje').val(res);
														$(".bloq0").hide('slow');
														$(".bloq1").show('slow');
										});

									});

									$("#tipo").change(function() {
											var tipo = $(this).val();

											if (tipo !='xls'){
												$(".sep").show('slow');
											}
											else{
												$(".sep").hide('slow');
											}
									});

									$('.mitooltip').tooltip();
							});

			    </script>
		    </div>
		</div>
	</body>
</html>
