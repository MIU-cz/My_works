<?php
if (isset($_GET['keyword'])) {
    $keyword = urlencode($_GET['keyword']);
    $url = "https://www.google.com/search?q={$keyword}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3");

    $html = curl_exec($ch);
    curl_close($ch);

    // check: create my debug file for structure html
    $debugFile = __DIR__ . '/debug.html';
    file_put_contents($debugFile, $html);

    require 'engine/parser/simple_html_dom.php';

    $dom = new simple_html_dom();
    $dom->load($html);

    $results = [];
    $counter = 0;

    // call parser
    foreach ($dom->find('div.Gx5Zad') as $result) {
        $titleElement = $result->find('div.BNeawe.vvjwJb.AP7Wnd.UwRFLe', 0);
        $linkElement = $result->find('div.BNeawe.UPmit.AP7Wnd.lRVwie', 0);

        if ($titleElement && $linkElement) {
            
            $title = trim($titleElement->plaintext);
            $link = trim($linkElement->plaintext);

            $results[] = [
                'title' => $title,
                'link' => $link
            ];
        }
        $counter++;
    }

    // check: how many items parser find
    if ($counter == 0) {
        echo json_encode(['error' => 'No results found']);
    } else {
        header('Content-Type: application/json');
        echo json_encode($results);
    }
}
?>
