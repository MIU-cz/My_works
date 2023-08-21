// room-card library
// =====================================================
function changeImage(image) {
	// console.log(image);
	let id = image.getAttribute("data-id");
	document.getElementById("mainFoto-" + id).src = image.src;
}