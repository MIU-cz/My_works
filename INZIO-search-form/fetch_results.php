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

    // Сохранение HTML в файл для отладки
    $debugFile = __DIR__ . '/debug.html';
    file_put_contents($debugFile, $html);

    require 'parser/simple_html_dom.php';

    $dom = new simple_html_dom();
    $dom->load($html);

    $results = [];
    $counter = 0;

    // Обновленные селекторы для заголовков и ссылок
    foreach ($dom->find('div.Gx5Zad') as $result) {
        $titleElement = $result->find('div.BNeawe.vvjwJb.AP7Wnd.UwRFLe', 0);
        $linkElement = $result->find('div.BNeawe.UPmit.AP7Wnd.lRVwie', 0);

        if ($titleElement && $linkElement) {
            // Извлекаем текст из элементов
            $title = trim($titleElement->plaintext);
            $link = trim($linkElement->plaintext);

            // Добавляем результат в массив
            $results[] = [
                'title' => $title,
                'link' => $link
            ];
        }
        $counter++;
    }

    // Проверка, нашлись ли элементы
    if ($counter == 0) {
        echo json_encode(['error' => 'No results found']);
    } else {
        header('Content-Type: application/json');
        echo json_encode($results);
    }
}
?>
