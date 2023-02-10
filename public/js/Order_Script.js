

$('.change-count-button').on('click', function() {
	let count = $('#product-count').val();

	console.log(count * price);
	$('.summ').html(count * price + ' руб');
});