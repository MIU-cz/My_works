<h2>stranica LK</h2>

ssilka na vihod -->

//vihod iz sesii
<?php
    switch ($user && isset($_GET['logout'])) 
    {
        case 'logout':
            unset($_SESSION['Login'], $_SESSION['Password']);
            session_destroy();
            header('Location: ' . URL); // Место, куда нас перекинет после выхода
            break; // После, прекращаем выполнение кода.
    }
?>
<a href="<?php echo URL; ?>/?logout">výstup</a>

<div>
   <ul>
       <li><a href="<?php echo URL; ?>">Главная</a></li>
       <li><a href="<?php echo URL; ?>/auth">Вход</a></li>
       <li><a href="<?php echo URL; ?>/reg">Регистрация</a></li>
       <li><a href="<?php echo URL; ?>/?logout">Выход</a></li>
   </ul>
</div>