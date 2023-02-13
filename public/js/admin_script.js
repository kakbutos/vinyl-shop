var count = 0;
var obj_struct = [
	{
		name: 'ID',
		type: 'id',
		field: 'ID'
	},
	{
		name: 'Название',
		type: 'text',
		field: 'NAME'
	},
	{
		name: 'Треки',
		type: 'text',
		field: 'TRACKS'
	},
	{
		name: 'Качество винила',
		type: 'text',
		field: 'VINIL_STATUS'
	},
	{
		name: 'Качество конверта',
		type: 'text',
		field: 'COVER_STATUS'
	},
	{
		name: 'Цена',
		type: 'number',
		field: 'PRICE'
	},
	{
		name: 'Дата релиза',
		type: 'number',
		field: 'RELEASE_DATE'
	},
	{
		name: 'Активен',
		type: 'bool',
		field: 'IS_ACTIVE'
	},
	{
		name: 'Исполнитель',
		type: 'text',
		field: 'ARTIST'
	},
];

var data = [
	[1, 'Highway To Hell', 'A1 Highway To Hell', 'G+', 'Потёртый', 5580, 1979, true, 'AC/DC'],
	[2, 'fqwfqwfwq To Hell', 'A2 Hisafasasghway To Hell', 'G-', 'Класный', 5580, 1979, true, 'AC/DC']
]


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

initializeTable(obj_struct, data);

function addNewObj(obj_struct, obj) {
	let row = $(`
				<tr class="table-tr row-${count}">

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
$('.add-button').on('click',function(){
	newObj = [count+1, 'Новый', 'Новый', '', '', 0, 0, false, 'ACTOR'];
	addNewObj(obj_struct, newObj);
});

$.ajax({
	url: '/admin',         /* Куда отправить запрос */
	method: 'get',             /* Метод запроса (post или get) */
	dataType: 'json',          /* Тип данных в ответе (xml, json, script, html). */
	success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
		console.log(data); /* В переменной data содержится ответ от index.php. */
	}
});