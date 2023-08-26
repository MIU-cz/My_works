<?php
$page = $_SESSION['page'];

$imgDir = './src/img/' . $page . '/';
$GalerieArr = [];

// ###
// # img
$i = 1;
while (file_exists($imgDir . $page . '-' . $i . '.jpg')) {
	$GalerieArr[] = $imgDir . $page . '-' . $i . '.jpg';
	$i++;
}

$laser = [
	'trumatic' => [
		'name' => 'Laser TRUMPF TRUMATIC L 6050/6000 W',
		'func' => [
			'max. řezná plocha' => '6200 x 2050 mm',
			'max. tl. řezu pro' => '',
			'ocel' => 'do 25 mm',
			'nerez' => 'do 25 mm',
			'AI' => 'do 15 mm',
			'presnost rezu' => '&plusmn;0,10 mm'
		]
	],
	'byspeed' => [
		'name' => 'Laser BYSTRONIC BYSPEED 3015/4400 W',
		'func' => [
			'max. řezná plocha' => '3000 x 1500 mm',
			'max. tl. řezu pro' => '',
			'ocel' => 'do 20 mm',
			'nerez' => 'do 20 mm',
			'AI' => 'do 12 mm',
			'presnost rezu' => '&plusmn;0,10 mm'
		],
	],
	'bystar' => [
		'name' => 'Laser BYSTRONIC BYSTAR 3015/4400 W',
		'func' => [
			'max. řezná plocha' => '3000 x 1500 mm',
			'max. tl. řezu pro' => '',
			'ocel' => 'do 20 mm',
			'nerez' => 'do 20 mm',
			'AI' => 'do 12 mm',
			'presnost rezu' => '&plusmn;0,10 mm'
		],
	]
];

// ###
// # tvar_links
$linkArr = [
	'tvareni',
	'obrabeni',
	'svarovani',
	'upravy',
	'montaz'
];


?>

<div class="tvar_container">
	<div class="tvar_header">
		<?php echo '<h2>' . $title . '</h2><p>' . $description . '</p>'; ?>
	</div>

	<div class="tvar_items">
		<?php
		foreach ($laser as $name => $item) {
			echo '
			<div class="item_laser">
				<div class="item_func">';

			foreach ($item as $index => $itemContent) {
				if (!is_array($itemContent)) {
					echo '
					<h3>' . $itemContent . '</h3>
					<table>';
				} else {
					foreach ($itemContent as $func => $value) {
						echo '
						<tr>
							<td>' . $func . '</td>
							<td>' . $value . '</td>
						</tr>
						';
					}
				}
			}

			echo '
				</table>
				</div>
				<div class="item_foto">
					<img src="' . $imgDir . $name . '.jpg" alt="' . $name . '-foto">
				</div>
			</div>
			';
		}
		?>



	</div>

	<!-- =============================== -->
	<!-- # Gallerie -->
	<div class="tvar_gallerie">
		<div class="gallerie_title">
			<?php echo '<h2>' . $titleGalerie . '</h2>'; ?>
		</div>

		<div class="gallerie_container">
			<div class="container_line">
				<?php
				foreach ($GalerieArr as $img) {
					echo '
				<div class="image_container">
				<img src="' . $img . '" alt="gallerie-picture">
				</div>
				';
				}
				// for ($i = 0; $i < 3; $i++) {
				// 	echo '
				// 	<div class="image_container">
				// 	<img src="' . $GalerieArr[$i] . '" alt="gallerie-picture">
				// 	</div>
				// 	';
				// }
				?>
			</div>
		</div>

		<div class="container_btn">
			<button class="btn" id="btn-back">
				<div class="btn_ico"></div>
			</button>
			<button class="btn" id="btn-forward">
				<div class="btn_ico"></div>
			</button>
		</div>

	</div>

	<!-- =============================== -->
	<!-- # links -->

	<div class="tvar_links">
		<div class="links_title">
			<?php echo '<h2>' . $titleLinks . '</h2>'; ?>
		</div>

		<div class="links_content">
			<?php
			foreach ($linkArr as $link) {
				echo '<div class="links_item"><a href="?page=' . $link . '">' . $$link . ' </a></div>';
			}
			?>
		</div>
	</div>

</div>

<script src="./src/js/slider.js"