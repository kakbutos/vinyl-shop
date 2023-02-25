err = false;

$('.cancel-button').on('click', function(){
	$('.submit-modal-image').remove();
});

$('.image-button').on('click',function(){
	$('.submit-modal-image').addClass('modal-error-info');
});


