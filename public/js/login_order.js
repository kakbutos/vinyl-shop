$('.input-form').on('focus blur', (e) => {
	$(e.target).next().toggleClass('focus-input-gradient');
});

$('.btn-wrap-form').hover(() => {
	$('.btn-bg').css('left', 0);
}, () => {
	$('.btn-bg').css('left', '-100%');
});