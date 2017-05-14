$(document).ready(function(){
	$('.wrap').on('click', '.btn', function() {
		var dataAtr = $(this).data('form');
		if(dataAtr === 'htmlTable'){
			$('#loadPic').css('display','none');
			$('#loadExcel').css('display','flex');
		}
		else{
			$('#loadExcel').css('display','none');
			$('#loadPic').css('display','flex');
		}
	});

});