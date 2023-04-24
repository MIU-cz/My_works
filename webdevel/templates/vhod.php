<div id="Main">
    <h1>AUTORIZACIE</h1>
    <p>/ / / / /</p>
</div>

<?php 
    require_once('engine/config.php'); 
    
?>

<div id="Forma">
    <div id="Mod">
        <h5><a href="index.php?page=vhod">Zadejte svůj osobní účet</a></h5>
    </div>
    <div id="Mod">
        <h5><a href="index.php?page=vhod&id=reg">Registrovat se</a></h5>
    </div>
    <div id="Mod">
        <h5><a href="index.php?page=vhod&id=hr">Jsem zaměstnanec</a></h5>
    </div>
    
    <div id="Content">
        <h4>tut budet content formi</h4>
        <?php 
            if(!isset($_GET['id'])) {require_once('auth/auth.php');}
            else
            {
                $id = $_GET['id'];
                switch ($id)
                {
                    case 'reg': require_once('auth/reg.php'); break;    
                    case 'hr': require_once('auth/hr.php'); break;    
                }
            }
            
        ?>
    </div>
</div>