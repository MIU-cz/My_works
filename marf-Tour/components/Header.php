<?php
session_start();
class Header
{
	public static function constractContent()
	{
		$brand = '
		<div class="navbar_brand">
				<a href="./">
					<span>marf-travel</span>
					<img src="./src/icons/ico-marf-bg.png" alt="">
				</a>
			</div>
			';

		$navBar = '
		<nav class="navbar_nav">
				<ul class="nav_links" id="navLinks">
					<li class="links_item"><a href="./">Domu</a></li>
					<li class="links_item"><a href="index.php?page=nabitka">Horka Nabitka</a></li>
					<li class="links_item"><a href="index.php?page=kontakty">Kontakty</a></li>
					<!-- https://www.marf.cz/kontakty
					target="_blank" -->
				</ul>
				<div class="nav_user">
					<a href="#" onclick="showAuthForm()">
						<svg viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M28 14C28 21.732 21.732 28 14 28C6.26801 28 0 21.732 0 14C0 6.26801 6.26801 0 14 0C21.732 0 28 6.26801 28 14ZM18.6667 7.77778C18.6667 10.3551 16.5774 12.4444 14.0001 12.4444C11.4227 12.4444 9.33339 10.3551 9.33339 7.77778C9.33339 5.20045 11.4227 3.11111 14.0001 3.11111C16.5774 3.11111 18.6667 5.20045 18.6667 7.77778ZM19.4998 16.2781C20.9584 17.7367 21.7778 19.715 21.7778 21.7778H14L6.22225 21.7778C6.22225 19.715 7.0417 17.7367 8.50031 16.2781C9.95893 14.8194 11.9372 14 14 14C16.0628 14 18.0411 14.8194 19.4998 16.2781Z" fill="currentColor" />
						</svg>
					</a>
				</div>
				<!-- Burger button -->
				<button class="btn_burger " id="btnBurger" >
					<span></span>
				</button>
			</nav>
		';

		$headerNav = '
		<div class="header__navbar_wraper">
			' . $brand . $navBar . '			
		</div>
		';

		$btnExit = '
		<form action="./engine/logout.php" method="post">
		<input type="submit" value="exit">
		</form>
		';

		if (isset($_SESSION['userName']) && isset($_SESSION['mail'])) {
			$userInfo = $_SESSION['userName'] . ' | ' . $_SESSION['mail'] . ' | ' . $btnExit;
		} else {
			$userInfo = '';
		}

		$headerContent = '
		<div class="header__content_wraper">
			<div class="header__content_container">
				<div class="user_info">
				' . $userInfo . '
				</div>

				<div class="header__content">
					<h1 class="content_title">marf-travel</h1>
					<p class="content_description">Zapomeň na starosti</p>
					<p class="content_description">a přijeď k nám na bavosti</p>
				</div>
			</div>

		</div>
		';

		$content = $headerNav . $headerContent;

		return $content;
	}

	public static function render()
	{
		return self::constractContent();
	}
}
