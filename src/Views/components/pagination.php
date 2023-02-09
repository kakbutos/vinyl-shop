<?php

use Eshop\src\Service\Pagination;

/**
 * @var Pagination[] $pagination
 */

?>

<div class="pagination">
	<?php
		echo $pagination ? $pagination->get_html() : '';
	?>
</div>
