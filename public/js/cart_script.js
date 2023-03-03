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

// $('.decr-count-button').on('click', function(e) {
// 	let id = e.target.id;
// 	let count = document.getElementById('product-count' + id).value;
// 	let price = document.getElementById('price' +id).textContent;
// 	price = Number(price.replace(/[a-zа-яё]/gi, ''));
// 	$('#sum' + id).html(count*price + ' руб');
// 	if (count <=1 ){
// 		$(`#item-${id}`).remove();
// 	}
//
// 	let allProductsCount = $('.cart-product-item').length;
// 	if (allProductsCount <= 0){
// 		$('.content').empty().append('Корзина пуста');
// 	}
//
// 	$.ajax({
// 		url: '/cart/reduce/' + id +'/',
// 		type: 'GET',
// 		success: function(result){
// 			if (!result)
// 			{
// 			 alert('Продукта с таким id не существует.')
// 			}
// 		},
// 		error: function(){
// 			alert('Не удалось уменьшить количество товара в корзине')
// 		}
// 	})
//
// 	let quantity = document.getElementById('quantity').textContent;
// 	if (quantity >= 1) {
// 		let newQuantity = Number(quantity) - 1;
// 		$('.products-quantity').html(newQuantity);
// 	}
// });

$('.decr-count-button').on('click', function(e) {
	let id = e.target.id;
	let count = document.getElementById('product-count' + id).value;
	let price = document.getElementById('price' +id).textContent;
	price = Number(price.replace(/[a-zа-яё]/gi, ''));
	$('#sum' + id).html(count*price + ' руб');
	if (count <=1 ){
		$(`#item-${id}`).remove();
	}

	let allProductsCount = $('.cart-product-item').length;
	if (allProductsCount <= 0){
		$('.content').empty().append('Корзина пуста');
	}

	$.ajax({
		url: '/cart/reduce/' + id +'/',
		type: 'GET',
		success: function(result){
			if (!result)
			{
				alert('Продукта с таким id не существует.')
			}
		},
		error: function(){
			alert('Не удалось уменьшить количество товара в корзине')
		}
	})

	let quantity = document.getElementById('quantity').textContent;
	if (quantity >= 1) {
		let newQuantity = Number(quantity) - 1;
		$('.products-quantity').html(newQuantity);
	}
});