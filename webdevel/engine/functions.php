<?php
    // Функция проверки пользователя

    function authentication($Login, $Password)
    {
        global $db;
        $query = "SELECT * FROM Accounts WHERE Login = '{$Login}' AND Password = '{$Password}' LIMIT 1";
        return mysqli_fetch_assoc(mysqli_query($db, $query));
    }

?>