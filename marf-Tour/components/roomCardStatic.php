<?php
class RoomCardStatic
{
	private static $id;
	public static function setId($id)
	{
		self::$id = $id;
	}

	public static function constructContent()
	{
		$mainFoto = '<img id="mainFoto-' . self::$id . '" src="./src/img/rooms/room-1.jpeg" alt="room-foto">';
		$nextFoto = '
		<ul class="foto_grid_links">
				<li><img src="./src/img/rooms/room-1.jpeg" alt="room-foto" data-id="' . self::$id . '" onclick="changeImage(this);"></li>
				<li><img src="./src/img/rooms/room-2.jpeg" alt="room-foto" data-id="' . self::$id . '" onclick="changeImage(this);"></li>
				<li><img src="./src/img/rooms/room-3.jpeg" alt="room-foto" data-id="' . self::$id . '" onclick="changeImage(this);"></li>
				<li><img src="./src/img/rooms/room-4.jpeg" alt="room-foto" data-id="' . self::$id . '" onclick="changeImage(this);"></li>
			</ul>
		';
		$cardTitle = '<h2>pěkný pokoj s krásným výhledem</h2>';
		$cardDescription = '
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores nam recusandae cupiditate, inventore blanditiis voluptas, odit cumque iure ex velit hic quia repudiandae qui laudantium reprehenderit voluptatibus et molestias nostrum!</p>
		';
		$cardBtn = '<button class="btn_booking" id="btnBooking">chci to</button>';

		$content = '
		<div class="room__card">
			<div class="card_foto">
				<div class="main_foto">
				' . $mainFoto . '
				</div>

				<div class="next_foto">
				' . $nextFoto . '
				</div>
			</div>

			<div class="card_title">
				' . $cardTitle . '
			</div>

			<div class="card_description">
				' . $cardDescription . '
			</div>

			<div class="card_booking">
				' . $cardBtn . '
			</div>
		</div>	
		';

		return $content;
	}

	public static function render()
	{
		return self::constructContent();
	}
}

?>

<script src="./src/js/room-view-img.js"></script>