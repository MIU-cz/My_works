<?php
$page = $_SESSION['page'];
$imgArr = [];
$imgDir = './src/img/' . $page . '/';

$i = 1;
while (file_exists($imgDir . $page . '-' . $i . '.jpg')) {
	$imgArr[] = $imgDir . $page . '-' . $i . '.jpg';
	$i++;
}

?>

<div class="main_grid">
	<div class="grid_item">
		<div class="item_text bg-blue">
			<div class="text_title">
				<h3><?php echo $textTitleBg; ?></h3>
			</div>
			<div class="text_content">
				<div><?php echo $textContentBg; ?></div>
			</div>
		</div>

		<div class="item_text">
			<div class="text_title">
				<h3><?php echo $textTitle; ?></h3>
			</div>
			<div class="text_content">
				<div><?php echo $textContent; ?></div>
			</div>
		</div>
	</div>

	<div class="grid_item">
		<?php
		foreach ($imgArr as $src) {
			echo '<img src="' . $src . '" alt="image o nas">';
		}
		?>
	</div>

</div>