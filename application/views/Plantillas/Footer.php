		<hr />
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<footer class="footer">
				       <p>&copy; LexStanley 2015</p>
				       <?php 	echo base_url();
				       			/*echo $db['default']['hostname'];
				       			echo $db['default']['database'];
								echo $db['default']['dbdriver'];*/
				       ?>
				    </footer>

					<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
					<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
					<script src="<?php echo base_url(); ?>assets/js/fileinput.min.js"></script>
				  <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
				  <script src="<?php echo base_url(); ?>assets/js/twitter-bootstrap-hover-dropdown.min.js"></script>

					<script type='text/javascript'>
					        	// When the document is ready
				            $(document).ready(function () {
											$( "#jsObtenerCodigo" ).click(function() {
								    	var data = $("#jsForm_Agregar_Docs").serializeArray();
								    	//alert( "Handler for .click() called." );
								    	//alert(data);
								    	$.ajax
								    	({
								    		url: '<?= base_url(); ?>' + 'documentos/getCodigoProt',
								    		type: 'post',
								    		datatype: 'json',
								    		data: data,
								    		beforeSend: function(){
								    		$('.think').css('display','inline');
								    	}
								    	})
								    		.done(function(msj){
								    		$('#CodigoProtocolo').val(msj);
												$('#jsObtenerCodigo').hide();
												$('#idEt').prop('disabled', true);
								    	})
								    		.fail(function(){
								    		$('.hola').html("Falso");
								    	})
								    		.always(function(){
								    		setTimeout(function(){
								    		$('.think').hide();
											},500);
								    	});
										});
										$( "#jsNuevaVersion" ).click(function() {
										    var data = $("#jsForm_Agregar_Docs").serializeArray();
										    var canterior = $("#CodigoProtocolo").val();
										    //alert( "Handler for .click() called." );
										    //alert(data);
										    $('#CodigoAnterior').val(canterior);
										    $.ajax
										    ({
										    	url: '<?= base_url(); ?>' + 'documentos/newVersionProt',
										    	type: 'post',
										    	datatype: 'json',
										    	data: data,
										    	beforeSend: function(){
										    		$('.fa').css('display','inline');
										    	}
										    })
										    .done(function(msj){
										    	$('#CodigoProtocolo').val('');
										    	$('#CodigoProtocolo').val(msj);
										    	$('#VersionNueva').val('S');
													$('#jsNuevaVersion').hide();
										    })
										    .fail(function(){
										    	$('.hola').html("Falso");
										    })
										    .always(function(){
										    	setTimeout(function(){
										    		$('.fa').hide();
										    	},1000);
										    });
											});
										});
				            $(document).ready(function() {
							    	$('#dateRangePicker')
							        .datepicker({
							            format: 'yyyy/mm/dd',
							            todayBtn: true,
							            todayHighlight: true
							        })
							        .on('changeDate', function(e) {
							            // Revalidate the date field
							            $('#jsForm_Agregar_Docs').formValidation('revalidateField', 'date');
							        });

							    	$('#jsForm_Agregar_Docs').formValidation({
							        framework: 'bootstrap',
							        icon: {
							            valid: 'glyphicon glyphicon-ok',
							            invalid: 'glyphicon glyphicon-remove',
							            validating: 'glyphicon glyphicon-refresh'
							        },
							        fields: {
							            date: {
							                validators: {
							                    notEmpty: {
							                        message: 'The date is required'
							                    },
							                    date: {
							                        format: 'YYYY/MM/DD',
							                        min: '2014/01/01',
							                        max: '2020/12/30',
							                        message: 'The date is not a valid'
							                    }
							                }
							            }
							        }
							    	});
									});
									$('.mitooltip').tooltip()
									$("#submit").click(function() {
										$('#submit').hide();
									});
        			</script>
			    </div>
		    </div>
		</div>
	</body>
</html>
