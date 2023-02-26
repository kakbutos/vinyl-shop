$('.change-count-button').on('click', () => {
	const count = $('#product-count').val();

	$('.summ').html(count * price + ' руб');
});

window.addEventListener("DOMContentLoaded", function()
{
	[].forEach.call(document.querySelectorAll('.phone'), function(input)
	{
		let keyCode;

		function mask(event) {
			event.keyCode && (keyCode = event.keyCode);
			const pos = this.selectionStart;

			if (pos < 3) event.preventDefault();

			let matrix = "+7 (___) ___-__-__",
				i = 0,
				def = matrix.replace(/\D/g, ""),
				val = this.value.replace(/\D/g, ""),
				new_value = matrix.replace(/[_\d]/g, function(a) {
					return i < val.length ? val.charAt(i++) || def.charAt(i) : a
				});
			i = new_value.indexOf("_");

			if (i !== -1)
			{
				i < 5 && (i = 3);
				new_value = new_value.slice(0, i)
			}

			let reg = matrix.substr(0, this.value.length).replace(/_+/g,
				function(a) {
					return "\\d{1," + a.length + "}"
				}).replace(/[+()]/g, "\\$&");

			reg = new RegExp("^" + reg + "$");

			if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
			if (event.type === "blur" && this.value.length < 5) this.value = "";
		}

		$(input).on("input focus blur keydown", mask);

		// либо
		// const event_list = ["click", "scroll"];
		// event_list.forEach((event) => {
		// 	input.addEventListener(event, mask);
		// });
	});
});