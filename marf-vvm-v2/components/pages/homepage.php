<div class="main_content_grid">

	<?php
	$linkArr = [
		'onas',
		'galerie',
		'kvalita',
		'kariera',
		'kontakty',
		'napisnam',
		'delni',
		'tvareni',
		'obrabeni',
		'svarovani',
		'upravy',
		'montaz'
	];

	foreach ($linkArr as $link) {
		echo '<div class="grid_item"><a href="?page=' . $link . '">' . $$link . ' </a></div>';
	}
	?>

</div>