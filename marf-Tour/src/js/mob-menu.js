const Menu = document.getElementById('navLinks');
const Btn = document.getElementById('btnBurger'); //burger button

Btn.addEventListener('click', function () {
	Btn.classList.toggle("btn_burger-active");
	Menu.classList.toggle("nav_links-active");
})