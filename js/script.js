$(document).ready(function() {

	$('#tombolCari').hide();

	$('#keyword').on('keyup', function(){

		$('.loader').show();

		
		$.get('ajax/siswa.php?keyword=' + $('#keyword').val(), function(data){

			$('#container').html(data);

			$('.loader').hide();


		}); 


	});



});