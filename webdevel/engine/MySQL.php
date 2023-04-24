<?php
    // MYSQL

    define('DB_Host', 'webdevel');
    define('DB_User', 'hr-gen');
    define('DB_Password', 'admin');
    define('DB_Name', 'webdevel');

    $db = mysqli_connect(DB_Host, DB_User, DB_Password, DB_Name); // 1
    mysqli_query($db, "SET NAMES utf8"); // 2

?>