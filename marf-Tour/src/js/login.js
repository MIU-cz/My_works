const Body = document.querySelector(".body");
const authForm = document.getElementById('engModuls');
const authWraper = document.getElementById('authWraper');
// const formWraper = document.querySelector(".form__wraper");

function showAuthForm() {
	authForm.classList.toggle("eng_moduls-active");
	Body.classList.toggle("bg_lock");

	authWraper.addEventListener('click', function (e) {
		// console.log(e.target);
		// console.log(e.currentTarget);

		if (e.target == authWraper) {
			authForm.classList.remove("eng_moduls-active");
			Body.classList.remove("bg_lock");

		}
	});
}