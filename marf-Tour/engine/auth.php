<?php
session_start();
// unset($_SESSION['mail']);
?>

<div class="authorizacion__wraper" id="authWraper">
	<div class="form__wraper">

		<form method="post" action="?page=authChek">
			<div class="form_conteiner">
				<input class="form_item" type="email" name="usermail" id="userMail" placeholder="zadejte vas e-mail" required>
				<button class="btn_submit" type="submit">vchod</button>
			</div>
		</form>
	</div>
</div>