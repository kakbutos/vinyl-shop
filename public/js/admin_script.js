let obj_struct = [];
let table = 'product';
let global_product_tags = [];
initialize();

function initialize()
{
	$('.add-button').on('click', () => {
		newItem(table);
	});

	$('.nav-button').on('click', function() {
		table = $(this).data('table');

		$('.nav').find('li').removeClass('active');
		$(this).parent().addClass('active');

		$('.table-header-td').empty();
		$('.row').remove();

		getList(table);
	});

	getList('product');
}

function initializeTable(data)
{
	let header = $('.table-header-td');

	for (let i = 0; i < obj_struct.length; i++) {
		const elem = $(`<td class="table-td table-header-td">
							${ obj_struct[i].name }
					  </td>`);
		header.append(elem);
	}
	let additionalButtonsCount = 4;
	for (let i = 1; i < additionalButtonsCount; i++) {
		header.append(`<td class="table-td table-header-td"></td>`);
	}

	for (let i = 0; i < data.length; i++) {
		addNewObj(data[i]);
	}

	$('.cell-input[type=checkbox]').change(function() {
		$(this).val($(this).is(':checked'));
	});

	for (let i = 0; i < obj_struct.length; i++)
	{
		if (obj_struct[i].type === 'select')
		{
			setSelectFieldData(obj_struct[i].field);
		}
	}

	if (table==='product'){
		$.ajax({
			url: '/admin/getList',
			method: 'get',
			dataType: 'json',
			data: { table: 'tag' },
			success: function(data) {
				console.log(data);
			}
		});
	}

}

function addNewObj(obj) {
	const row = $(`<tr class="table-tr row row-${obj[0]}"></tr>`);
	for (let i = 0; i < obj.length; i++) {
		const type = obj_struct[i].type;
		const dataField = obj_struct[i].field;
		const elem = $(`
						<td class="table-td">
							<div class="cell-content-div">
								<div class="cell-text-div"></div>
							</div>
						</td>
					`);

		switch(type) {
			case 'id':
			{
				elem.find('.cell-text-div').append(`<input class="cell-input" type="number" data-field="${dataField}" disabled value="${obj[i]}">`);
				break;
			}
			case 'bool':
			{
				const checked = obj[i] ? 'checked' : '';
				elem.find('.cell-text-div')
					.append(`
									<input class="cell-input toggle" type="checkbox"  data-field="${dataField}"  value="${obj[i]}" ${checked}>
									<label class="toggle-item"></label>
								`);
				break;
			}
			case 'number':
			{
				elem.find('.cell-text-div').append(`<input class="cell-input" type="number" data-field="${dataField}" value="${obj[i]}">`);
				break;
			}
			case 'text':
			{
				elem.find('.cell-text-div').append(`<input class="cell-input" type="text" data-field="${dataField}" value="${obj[i]}">`);
				break;
			}
			case 'select':
			{
				elem.find('.cell-text-div').append(`
					<select class="cell-select" data-field="${dataField}">
						<option value="${obj[i]}" selected>${obj[i]}</option>
					</select>`
				);
				break;
			}
			case 'checkboxes':
			{
				elem.find('.cell-text-div').append(`<input class="cell-input" type="button" data-field="${dataField}" value="${obj[i]}">`);
				break;
			}
			default:
			{
				console.log(type + ' of obj_struct is undefined');
			}
		}

		row.append(elem);
	}

	if (table === 'product')
	{
		row.append(`
			<td class="table-td">
				<div class="cell-content-div">
					<div class="cell-button-div">
						<button class="btn save-button submit-button" onclick = "document.location='admin/image/${obj[0]}/'">Изображения</button>
					</div>
				</div>
			</td>`
		);
	}

	row.append(`
		<td class="table-td">
			<div class="cell-content-div">
				<div class="cell-button-div">
					<button class="btn save-button submit-button" onclick="saveItem(${obj[0]})">Сохранить</button>
				</div>
			</div>
		</td>`
	);

	row.append(`
		<td class="table-td">
			<div class="cell-content-div">
				<div class="cell-button-div">
					<button class="btn delete-button danger-button" onclick="openSubmitModal(${obj[0]})">Удалить</button>
				</div>
			</div>
		</td>`
	);

	$('.admin-table').append(row);
}

function newItem(table) {
	$.ajax({
		url: '/admin/newItem',
		method: 'get',
		dataType: 'json',
		data: { table },
		success: function(data) {
			addNewObj(data);
		}
	});
}

function saveItem(id) {
	const inputs = $(`.row-${id}`).find('input');
	const obj = [];

	inputs.push($(`.row-${id}`).find('select'));

	for (let i = 0; i < inputs.length; i++)
	{
		const newField = {};

		newField.field = $(inputs[i]).data('field');
		newField.value = $(inputs[i]).val();

		obj.push(newField);
	}

	$.ajax({
		url: '/admin/setItem',
		method: 'post',
		dataType: 'json',
		data: { table, obj },
		success: function(data) {
			if (Array.isArray(data) && data.length)
			{
				alert(data[0]);
			}
		}
	});
}

function getList(dataTable)
{
	$.ajax({
		url: '/admin/getList',
		method: 'get',
		dataType: 'json',
		data: { table: dataTable },
		success: function(data) {
			obj_struct = data[0];
			console.log(obj_struct);
			initializeTable(data[1]);
		}
	});
}

function openSelectTagModal(){
	const modal = `
		<div class="tags-modal">
			<div class="tags-modal-dialog">
				<div class="tags-modal-content">
					<div class="tags-modal-header">
						<a href="#" title="Close" class="cancel-button">×</a>
					</div>
					<div class="tags-modal-body">    
						<fieldset class="tags-modal-tags-set">
							<legend>Теги:</legend>
						
							<div>
							  <input type="checkbox" id="scales" name="scales" checked>
							  <label for="scales">Scales</label>
							</div>
							
							<div>
							  <input type="checkbox" id="horns" name="horns">
							  <label for="horns">Horns</label>
							</div>
							
						</fieldset>
					</div>
					<div class="tags-modal-footer">
						<button class="btn save-button submit-button" style="margin-right: 10px">Ок</button>
					</div>
				</div>
			</div>
		</div>
	`;
	$('body').append(modal);
}

function setSelectFieldData(field) {
	$.ajax({
		url: '/admin/getSelectFieldData',
		method: 'get',
		dataType: 'json',
		data: { field },
		success: function(data) {
			const selects = $(`*[data-field = ${field}]`);

			for (let i = 0; i < selects.length; i++)
			{
				for (let j = 0; j < data.length; j++)
				{
					if ( $(selects[i]).find('option:selected').val() != data[j] ) {
						$(selects[i]).append(`<option value="${data[j]}">${data[j]}</option>`);
					}
				}
			}
		}
	});

}

function openSubmitModal(id) {
	const modal = `
		<div class="submit-modal">
			<div class="submit-modal-dialog">
				<div class="submit-modal-content">
					<div class="submit-modal-header">
						<a href="#" title="Close" class="cancel-button">×</a>
					</div>
					<div class="submit-modal-body">    
						<p>Вы уверены, что хотите удалить элемент?</p>
						<button class="btn save-button submit-button" style="margin-right: 10px">Удалить</button>
						<button class="btn danger-button cancel-button">Отменить</button>
					</div>
				</div>
			</div>
		</div>`

	$('body').append(modal);

	$('.cancel-button').on('click', () => {
		$('.submit-modal').remove();
	});

	$('.submit-modal').find('.submit-button').on('click', function() {
		$.ajax({
			url: '/admin/deleteItem',
			method: 'post',
			dataType: 'json',
			data: { table, id},
			success: function(data) {
				if (data) {
					$(`.row-${id}`).remove();
					$('.submit-modal').remove();
				}
				else {
					alert('Что-то пошло не так!');
				}
			}
		});
	});
}


