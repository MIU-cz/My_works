<div >
    <form method="post">
        <label for="login_input">Jmeno</label>
        <input name="Login" type="text" id="login_input" placeholder="Vase Jmeno:" required>
        
        <label for="password_input">Cislo</label>
        <input name="Password" type="password" id="password_input" placeholder="Vase Cislo:" required>
        <br><br>
        <button type="submit" class="">Vstup</button>
    </form>
</div>

<?php
    //if (isset($login)){ $login = $_POST['Login']; }
    //if (isset($password)) {$password = md5($_POST['Password']); }
    $login = $_POST['Login'];
    $password = md5($_POST['Password']);

    if ( !$user ) 
    {
        if (isset($login, $password)) 
        {
            if ($result = !authentication($login, $password)) 
            {
                echo '<span style="color: #ff0000; ">Zkontrolujte data !!</span><br>';
            } 
            else 
            {
                $_SESSION = array(
                    'Login' => $login,
                    'Password' => $password
                );
                header('Location: ' . URL . '/');
                exit;
            }
        }
    }
    else {
        header('Location: ' . 'auth/lk.php');
        exit;
    }
?>