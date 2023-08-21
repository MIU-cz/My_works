const formFilter = document.getElementById('formFilter');
const errorForm = document.getElementById('errorForm');
const btnSubmit = formFilter.elements['btnSubmit'];
const formWraper = document.querySelector('.form_wraper');

function showFilter() {
	formWraper.classList.toggle('hide');
}


let errDate = 'wrong date';
let errDepDateNote = 'input date more then tomorow';
let errNightsNote = 'minimal booking for 2 nights';
let errArrDateNote = 'input date more then 2 days from arrival date';

formFilter.addEventListener('input', function (e) {
	let curDate = new Date();
	let arrDate = formFilter.arrivalDate.value;
	let night = formFilter.nightsCol.value;
	let depDate = formFilter.departureDate.value;

	errorForm.innerHTML = '';
	btnSubmit.disabled = false;

	if (Date.parse(arrDate) <= curDate.setDate(curDate.getDate() + 1)) {
		errorForm.innerHTML = errDate + '<br>' + errDepDateNote;
		btnSubmit.disabled = true;
	}

	if (e.target == formFilter.nightsCol) {
		if (night < 2) {
			errorForm.innerHTML = errDate + '<br>' + errNightsNote;
			btnSubmit.disabled = true;
		}
		else {
			depDate = Date.parse(arrDate) + (night * 24 * 60 * 60 * 1000);
			let newDepDate = new Date(depDate).toISOString().slice(0, 10);
			formFilter.departureDate.value = newDepDate;
		}
	}

	if (e.target == formFilter.departureDate) {
		night = (Date.parse(depDate) - Date.parse(arrDate)) / (24 * 60 * 60 * 1000);

		if (night < 2) {
			errorForm.innerHTML = errDate + '<br>' + errArrDateNote;
			btnSubmit.disabled = true;
		}
		else {
			formFilter.nightsCol.value = night;
		}
	}
})

