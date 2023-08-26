<?php
class Footer
{
	public static function constractContent()
	{
		$footerDecoLine = '	<div class="footer_container deco_line"></div>';

		$mainAddres = '
		<div class="addres_title">
			<div class="addres_ico">
				<a href="?page=homepage">
					<svg fill="currentColor" height="100%" width="100%" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
						<path d="M256,0L0,256l42.7,42.7l64-64V512h298.7V234.7l64,64L512,256L256,0z M234.7,448h-64v-64h64V448z M234.7,341.3h-64v-64h64 V341.3z M341.3,448h-64v-64h64V448z M341.3,341.3h-64v-64h64V341.3z M426.7,0h-64v42.7l64,64V0z" />
					</svg>
				</a>
			</div>

			<p><strong>Sídlo společnosti:</strong>
				<a href="https://mapy.cz/s/bofezujuku"  target="_blank">Opavská 569, 742 45 Fulnek, Česká republika</a> |
				Tel.: <a href="tel:00420556787500"> 00420 556 787 500</a>
			</p>
		</div>
		';

		$addres1 = '
		<div class="footer_addres">
			<div class="addres_title">
				<p><strong>Provozovna OPAVSKÁ:</strong></p>
			</div>
			<div class="addres_desc">
				<div class="footer_addres">
					<p>Opavská 569</p>
					<p>742 45 Fulnek</p>
					<p>Česká republika </p>
				</div>
				<div class="footer_addres">
					<div class="addres_title">
						<p><strong>Souřadnice GPS:</strong></p>
					</div>
					<div class="addres_desc">
						<a href="https://mapy.cz/s/bofezujuku"  target="_blank">49.7183417N 17.9106669E</a>
					</div>
				</div>
			</div>
		</div>
		';

		$addres2 = '
		<div class="footer_addres">
			<div class="addres_title">
				<p><strong>Provozovna JERLOCHOVICE:</strong></p>
			</div>
			<div class="addres_desc">
				<div class="footer_addres">
					<p>Jerlochovice 133</p>
					<p>742 45 Fulnek</p>
					<p>Česká republika </p>
				</div>
				<div class="footer_addres">
					<div class="addres_title">
						<p><strong>Souřadnice GPS:</strong></p>
					</div>
					<div class="addres_desc">
						<a href="https://mapy.cz/s/jolamurate"  target="_blank">49.7111294N 17.8886200E</a>
					</div>
				</div>
			</div>
		</div>
		';

		$addres = '
		<div class="footer_container footer_content">
			<div class="container_content">		
				<div class="footer_addres">
					' . $mainAddres . '					
						<div class="addres_desc">
					' . $addres1 . $addres2 . '										
					</div>		
				</div>		
			</div>
		</div>
		';

		$marf = '
		<div class="footer_container_atribution">
			<div class="container_content">
				<p>&copy; ' . date("Y") . ' <a href="https://www.marf.cz/" target="_blank"> MARF reklamní agentura</a></p>
			</div>
		</div>
		';

		$autor = '
			<div id="autor"></div>
			<script src="./components/autor-resourse/autor-footer-script.js"></script>
		';

		$content = $footerDecoLine . $addres . $marf . $autor;
		return $content;
	}

	public static function render()
	{
		return self::constractContent();
	}
}
