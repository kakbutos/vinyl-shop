

$('.change-count-button').on('click', function() {
	let count = $('#product-count').val();

	console.log(count * price);
	$('.summ').html(count * price + ' руб');
});

// document.addEventListener("DOMContentLoaded", function () {
// 	var eventCalllback = function (e) {
// 		var el = e.target,
// 			clearVal = el.dataset.phoneClear,
// 			pattern = el.dataset.phonePattern,
// 			matrix_def = "+7(___) ___-__-__",
// 			matrix = pattern ? pattern : matrix_def,
// 			i = 0,
// 			def = matrix.replace(/\D/g, ""),
// 			val = e.target.value.replace(/\D/g, "");
// 		if (clearVal !== 'false' && e.type === 'blur') {
// 			if (val.length < matrix.match(/([\_\d])/g).length) {
// 				e.target.value = '';
// 				return;
// 			}
// 		}
// 		if (def.length >= val.length) val = def;
// 		e.target.value = matrix.replace(/./g, function (a) {
// 			return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? "" : a
// 		});
// 	}
// 	var phone_inputs = document.querySelectorAll('[data-phone-pattern]');
// 	for (let elem of phone_inputs) {
// 		for (let ev of ['input', 'blur', 'focus']) {
// 			elem.addEventListener(ev, eventCalllback);
// 		}
// 	}
// });

window.addEventListener("DOMContentLoaded", function()
{
	[].forEach.call( document.querySelectorAll('.phone'), function(input)
	{
		var keyCode;
		function mask(event) {
			event.keyCode && (keyCode = event.keyCode);
			var pos = this.selectionStart;
			if (pos < 3) event.preventDefault();
			var matrix = "+7 (___) ___-__-__",
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
			var reg = matrix.substr(0, this.value.length).replace(/_+/g,
				function(a) {
					return "\\d{1," + a.length + "}"
				}).replace(/[+()]/g, "\\$&");
			reg = new RegExp("^" + reg + "$");
			if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
			if (event.type === "blur" && this.value.length < 5)  this.value = ""
		}

		input.addEventListener("input", mask, false);
		input.addEventListener("focus", mask, false);
		input.addEventListener("blur", mask, false);
		input.addEventListener("keydown", mask, false)

	});
});