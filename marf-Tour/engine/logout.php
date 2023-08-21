<?php
session_start();

$_SESSION['errors'] = false;
unset($_SESSION['errmsg']);
unset($_SESSION['mail']);
unset($_SESSION['userName']);

header('Location: ../');

session_destroy();
exit();
