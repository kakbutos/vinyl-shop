var count = 0;
var obj_struct = [];
var table = 'product';
var data = [
	[1, 'Highway To Hell', 'A1 Highway To Hell', 'G+', 'Потёртый', 5580, 1979, true, 'AC/DC'],
	[2, 'fqwfqwfwq To Hell', 'A2 Hisafasasghway To Hell', 'G-', 'Класный', 5580, 1979, true, 'AC/DC']
];

initialize();

function initialize()
{
	$('.add-button').on('click',function(){
		newItem(table);
	});

	$('.nav-button').on('click',function(){
		table = $(this).data('table');

		$('.nav').find('li').removeClass('active');
		$(this).parent().addClass('active');

		$('.table-header-td').empty();
		$('.row').remove();
		getList(table);
	});
	getList('product');
}


function initializeTable (obj_struct, data) {
	let header = $('.table-header-td');
	for (var i = 0; i < obj_struct.length; i++) {
		let elem = $(`<td class="table-td table-header-td">
							${obj_struct[i].name}
					  </td>`);
		header.append(elem);
	}
	header.append(`<td class="table-td table-header-td"></td>`);


	for (var i = 0; i < data.length; i++) {
		addNewObj(obj_struct, data[i], i)
		count = i;
	}

}


function addNewObj(obj_struct, obj) {
	let row = $(`
				<tr class="table-tr row row-${count}">

				</tr>
			`)
		for (var i = 0; i < obj.length; i++) {
			let type = obj_struct[i].type;

			let elem = $(`
					<td class="table-td">
						<div class="cell-content-div">
							<div class="cell-text-div">
								
							</div>	
						</div>
					</td>
				`);

			switch(type) {
				case 'id':
			    {
			    	elem.find('.cell-text-div').append(`<input class="cell-input" type="number" data-name="" disabled value="${obj[i]}">`);
			    	break;

			    }
			  	case 'bool':
			    {
			    	elem.find('.cell-text-div').append(`<input class="cell-input" type="text" value="${obj[i]}">`);
			    	break;

			    }
			  	case 'number':
			    {
			    	elem.find('.cell-text-div').append(`<input class="cell-input" type="number" value="${obj[i]}">`);
			    	break;

			    }
			  	case 'text':
			    {
			    	elem.find('.cell-text-div').append(`<input class="cell-input" type="text" value="${obj[i]}">`);
			    	break;

			    }

			  	default:
			    {
			    	console.log( 'obj_struct type is undefined');

			    }
			}
			row.append(elem);
		}
		row.append(`
			<td class="table-td">
				<div class="cell-content-div">
					<div class="cell-button-div">
						<button class="btn save-button">Сохранить</button>
					</div>
				</div>
			</td>`
		);
		$('.admin-table').append(row);
		count++;
}

function getList(dataTable)
{
	$.ajax({
		url: '/admin/getList',         /* Куда отправить запрос */
		method: 'get',             /* Метод запроса (post или get) */
		dataType: 'json',          /* Тип данных в ответе (xml, json, script, html). */
		data: {table: dataTable},     /* Данные передаваемые в массиве */
		success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
			console.log(data);
			initializeTable( data[0], data[1]);/* В переменной data содержится ответ от index.php. */
		}
	});
}

function newItem(table){

	$.ajax({
		url: '/admin/newItem',
		method: 'get',
		dataType: 'json',
		data: {table: table},
		success: function(data){
			addNewObj(obj_struct, data);
		}
	});
}



