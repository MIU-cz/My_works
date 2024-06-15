<?php
if (isset($_GET['keyword'])) {
    $keyword = urlencode($_GET['keyword']);
    $url = "https://www.google.com/search?q={$keyword}";

    $options = [
        'http' => [
            'method' => "GET",
            'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3"
        ]
    ];
    $context = stream_context_create($options);
    $html = file_get_contents($url, false, $context);

    require 'parser/simple_html_dom.php';
    $dom = new simple_html_dom();
    $dom->load($html);

    $results = [];
    foreach ($dom->find('div.g') as $result) {
        $titleElement = $result->find('h3', 0);
        $linkElement = $result->find('a', 0);
        if ($titleElement && $linkElement) {
            $results[] = [
                'title' => trim($titleElement->plaintext),
                'link' => trim($linkElement->href)
            ];
        }
    }

    header('Content-Type: application/json');
    echo json_encode($results);
}
?>
