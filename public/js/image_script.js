err = false;

$('.cancel-button').on('click', function(){
	$('.submit-modal-image').remove();
});

function openSubmitModal(href)
{
	const modal = `
		<div class="submit-modal">
			<div class="submit-modal-dialog">
				<div class="submit-modal-content">
					<div class="submit-modal-header">
						<a href="#" title="Close" class="cancel-button">×</a>
					</div>
					<div class="submit-modal-body">    
						<p>Вы уверены, что хотите удалить элемент?</p>
						<a href="${href}" class="btn save-button submit-button" style="margin-right: 10px">Удалить</a>
						<button class="btn danger-button cancel-button">Отменить</button>
					</div>
				</div>
			</div>
		</div>`

	$('body').append(modal);

	$('.cancel-button').on('click', function(){
		$('.submit-modal').remove();
	});
}