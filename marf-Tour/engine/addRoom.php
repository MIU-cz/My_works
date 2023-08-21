<div class="form__container">
	<h2>zde můžete přidat nový pokoj:</h2>

	<form enctype="multipart/form-data" method="post">
		<div class="form_wraper">

			<div class="content_wraper">
				<input type="text" name="title" class="item_title" placeholder="Zadejte název" required>
				<select name="rooms" class="item_roomcol">
					<option value="Jeden">Jeden</option>
					<option value="Dva">Dva</option>
					<option value="Tri">Tri</option>
					<option value="Studio">Studio</option>
					<option value="Luxus">Luxus</option>
				</select>
				<textarea type="textarea" name="description" class="item_description" placeholder="Zadejte popis" required></textarea>
			</div>

			<div class="content_wraper">
				<input type="file" name="file1" class="item_foto" required>
				<input type="file" name="file2" class="item_foto" required>
				<input type="file" name="file3" class="item_foto" required>
				<input type="file" name="file4" class="item_foto" required>
			</div>
		</div>

		<button class="item_btn" type="submit">přidat nový pokoj</button>
	</form>
</div>
</div>

<?php
$submit = $_SERVER['REQUEST_METHOD'];
$fotoDir = './src/img/rooms/';
include "./engine/mysqlConnect.php";
$linkdb = new mysqli($host, $name, $pass, $db);

if ($submit == 'POST') {
	$title = htmlspecialchars($_POST['title']);
	$description = htmlspecialchars($_POST['description']);
	$rooms = $_POST['rooms'];

	$file1 = $fotoDir . ($_FILES['file1']['name'] ?? '');
	$file2 = $fotoDir . ($_FILES['file2']['name'] ?? '');
	$file3 = $fotoDir . ($_FILES['file3']['name'] ?? '');
	$file4 = $fotoDir . ($_FILES['file4']['name'] ?? '');

	$query = "INSERT INTO `Rooms` (photo1, photo2, photo3, photo4, name, description, room) 
	VALUES ('$file1', '$file2', '$file3', '$file4', '$title', '$description', '$rooms')";

	$linkdb->query($query);
}

$linkdb->close();
?>