<?php
class RoomCard
{
	private $row;
	// private $index;

	public function setArr($row)
	{
		$this->row = $row;
	}

	public function constructContent()
	{
		$row = $this->row;

		$mainFoto = '<img id="mainFoto-' . $row['id'] . '" src="' . $row['photo1'] . '" alt="room-foto">';
		$nextFoto = '
		<ul class="foto_grid_links">
				<li><img src="' . $row['photo1'] . '" alt="room-foto" data-id="' . $row['id'] . '" onclick="changeImage(this);"></li>
				<li><img src="' . $row['photo2'] . '" alt="room-foto" data-id="' . $row['id'] . '" onclick="changeImage(this);"></li>
				<li><img src="' . $row['photo3'] . '" alt="room-foto" data-id="' . $row['id'] . '" onclick="changeImage(this);"></li>
				<li><img src="' . $row['photo4'] . '" alt="room-foto" data-id="' . $row['id'] . '" onclick="changeImage(this);"></li>
			</ul>
		';
		$cardTitle = '<h2>' . $row['name'] . ' - cislo pokoje: ' . $row['room'] . '</h2>';
		$cardDescription = '<p>' . $row['description'] . '</p>';

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

			<div class="card_cpecfication">
			<div class="card_title">
				' . $cardTitle . '
			</div>

			<div class="card_description">
				' . $cardDescription . '
			</div>
			</div>
			
		</div>	
		';

		return $content;
	}

	public function render()
	{
		return $this->constructContent();
	}
}
