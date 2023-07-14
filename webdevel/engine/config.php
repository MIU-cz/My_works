<?php
    ob_start();
    session_start();

    $protocol = !isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' ? 'http' : 'https'; // protokol
    define('URL', ''. $protocol . '://'. $_SERVER['HTTP_HOST'] . ''); // polnij adres

    require_once('MySQL.php');
    require_once('functions.php');

    //proverka autorizacii
    $user = isset($_SESSION['Login'], $_SESSION['Password']) ? authentication($_SESSION['Login'], $_SESSION['Password']) : 0;

    //vihod iz sesii
    switch ($user && isset($_GET['logout'])) 
    {
        case 'logout':
            unset($_SESSION['Login'], $_SESSION['Password']);
            session_destroy();
            header('Location: ' . URL); // perehod na stranicu posle vihoda
            break; 
    }

?>