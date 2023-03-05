$('.buy-button').on('click', function(e) {
	e.preventDefault();
	let id = $(this).data('id');
	$.ajax({
		url: '/cart/add',
		type: 'POST',
		data: {id: id},
		success: function(result){
			if (!result)
			{
				alert('Продукта с таким id не существует.')
			}
			else
			{
				showMessage();
			}
		},
		error: function(){
			alert('Не удалось добавить товар в корзину.')
		}
	})
});

function showMessage() {
	let modal = document.getElementById("modal");
	let span = document.getElementsByClassName("close")[0];
	modal.style.display = "block";
	span.onclick = function() {
		modal.style.display = "none";
	}
	window.onclick = function(event) {
		if (event.target === modal)
		{
			modal.style.display = "none"
		}
	}
	let quantity = document.getElementById('quantity').textContent;
	let newQuantity = Number(quantity) + 1;
	$('.products-quantity').html(newQuantity);
}

$('.delete-product-button').on('click', function(e) {
	e.preventDefault();
	let id = $(this).data('id');
	$.ajax({
		url: '/cart/delete',
		type: 'POST',
		data: {id: id},
		success: function(result){
			if (!result)
			{
				alert('Продукта с таким id не существует.')
			}
			else
			{
				let quantity = document.getElementById('quantity').textContent;
				let deleteQuantity = $('#product-count' + id).val();

				if (quantity >= deleteQuantity)
				{
					let newQuantity = Number(quantity) - deleteQuantity;
					$('.products-quantity').html(newQuantity);
				}
				$(`#item-${id}`).remove();
				isEmpty();
			}
		},
		error: function(){
			alert('Не удалось удалить товар из корзины.')
		}
	})
});

function isEmpty()
{
	let allProductsCount = $('.cart-product-item').length;
	if (allProductsCount <= 0)
	{
		$('.content').empty().append('Корзина пуста');
	}
}

$('.incr-count-button').on('click', function(e) {
	let id = e.target.id;
	let count = document.getElementById("product-count" + id).value;
	let price = document.getElementById('price' +id).textContent;
	price = Number(price.replace(/[a-zа-яё]/gi, ''));
	$('#sum' + id).html(count*price + ' руб');
	$.ajax({
		url: '/cart/add',
		type: 'POST',
		data: {id: id},
		success: function(result){
			if (!result) alert('Продукта с таким id не существует.')
		},
		error: function(){
			alert('Не удалось добавить товар в корзину.')
		}
	})

	let quantity = document.getElementById('quantity').textContent;
	let newQuantity = Number(quantity) + 1;
	$('.products-quantity').html(newQuantity);
});

$('.decr-count-button').on('click', function(e) {
	let id = e.target.id;
	let count = document.getElementById('product-count' + id).value;
	let price = document.getElementById('price' + id).textContent;
	console.log(count);

	if (Number(count) === 1 )
	{
		$.ajax({
			url: '/cart/delete',
			type: 'POST',
			data: {id: id},
			success: function(result){
				if (!result)
				{
					alert('Продукта с таким id не существует.')
				}
				else
				{
					$(`#item-${id}`).remove();
					isEmpty();
				}
			},
			error: function(){
				alert('Не удалось удалить товар из корзины.')
			}
		});
	}
	else
	{
		$.ajax({
			url: '/cart/reduce',
			type: 'POST',
			data: {id: id},
			success: function(result){
				if (!result)
				{
					alert('Продукта с таким id не существует.')
				}
			},
			error: function(){
				alert('Не удалось уменьшить количество товара в корзине')
			}
		});
	}

	$('#product-count' + id).val($('#product-count' + id).val()-1);

	price = Number(price.replace(/[a-zа-яё]/gi, ''));
	$('#sum' + id).html((count-1)*price + ' руб');

	let quantity = document.getElementById('quantity').textContent;
	if (quantity >= 1) {
		let newQuantity = Number(quantity) - 1;
		$('.products-quantity').html(newQuantity);
	}
});