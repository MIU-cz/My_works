
<?php include('templates/top.php'); ?>

<!-- generacija stranic -->
<div id="Body"> 
    <?php
        if (!isset($_GET['page'])) {require('templates/main.php');}
        else
        {
            $page = $_GET['page'];
            if ($page == 'onas') {require('templates/onas.php');}
            elseif ($page == 'vhod') {require('templates/vhod.php');}
            elseif ($page == 'kontakty') {require('templates/kontakty.php');}
            else {require('templates/404.php');}
        }
    ?>
</div>
              
<?php include('templates/sklep.php'); ?>       