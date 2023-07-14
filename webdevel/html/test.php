<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/main.css">
        <title>WebDevel-MIU testovoe zadanije</title>
    </head>

    <body>
        <header id="Top">
            <a href="index.html" name="Top">
                <img src="imgages/logo.png">
            </a>
            <div id="Menu">
                <a href="index.html">KARIERA</a>
                <a href="onas.html">O NAS</a>
                <a href="vhod.html">AUTORIZACIE</a>
                <a href="kontakty.html">KONTAKTY</a>
            </div>
            
            <div id="Top">
                <h1>KARIERA</h1>
                <p>/ / / / /</p>
            </div>
        </header>

        <div id="Body"> <!-- rabota s massivom -->
            <?php
                $zamestanec = [
                    [
                        'id' => 0,
                        'name' => 'Igor',
                        'priname' => 'Mykhaylenko',
                        'rod' => '18.12.1982',
                        'age' => 40,
                        'vs' => 'VSB',
                        'job' => true
                    ],
                    [
                        'id' => 1,
                        'name' => 'Frantisek',
                        'priname' => 'Hanna',
                        'rod' => '21.03.1984',
                        'age' => 38,
                        'vs' => 'Ostravska Univerzita',
                        'job' => true
                    ],
                    [
                        'id' => 2,
                        'name' => 'Dalibor',
                        'priname' => 'Verovsky',
                        'rod' => '21.03.1981',
                        'age' => 41,
                        'vs' => 'Ne',
                        'job' => false
                    ]

                ];
                                           
                echo $zamestanec[1]['name'].'<br>';
                
                echo '<pre>';
                var_dump($zamestanec);

                $zamestanec[2]['up'] =true;

                echo '<pre>';
                var_dump($zamestanec);

                $zamestanec[] = [
                        'id' => 3,
                        'name' => 'Anna',
                        'priname' => 'bogova',
                        'rod' => '21.03.1985',
                        'age' => 37,
                        'vs' => 'Kollege',
                        'job' => true,
                        'up' => false
                ];

                echo '<pre>';
                var_dump($zamestanec);
                
                foreach($zamestanec as $key => $x) { 
                    echo 'Key - '.$key.'<br>';
                    echo $x['id'].'<br>';
                    echo $x['name'].'<br>';
                    echo $x['priname'].'<br>';
                    echo $x['rod'].'<br>';
                    echo $x['age'].'<br>';
                    echo $x['vs'].'<br>';
                    echo $x['job'].'<br>';
                    echo $x['up'].'<br>';
                    echo '<hr>';
                }

                echo '<pre>';
                var_dump($_GET);

            ?>
        
        </div>
        
        <div id="Body"> <!-- rabota s perehodami po ssilkam -->
            <?php
                $page = $_GET['page'];
                if (!isset($page)) {echo 'kontent for main page';}
                elseif ($page == 'onas') {echo 'stranica - "o nas"';}
                elseif ($page == 'kontakty') {echo 'stranica - "kontakty"';}
                else {echo 'takoj stranici net!';}

                echo '<pre>';
                var_dump($_GET);
            ?>
        </div>
              
        <footer id="Sklep">
            <a href="#Top">zpet nahoru</a>
            <div id="Img">
                <img src="imgages/logo.png">
            </div>           
        </footer>
    </body>
</html>