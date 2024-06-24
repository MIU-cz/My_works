<?php
header('Content-Type: application/json');
require 'parser/simple_html_dom.php'; 

use simplehtmldom\HtmlWeb;

// Получение данных из запроса
$data = json_decode(file_get_contents('php://input'), true);

// Проверка необходимых полей
if (!isset($data['name'], $data['email'], $data['phone'], $data['product'], $data['price'], $data['quantity'], $data['totalPrice'])) {
    echo json_encode(['error' => 'Invalid data']);
    exit;
}

// Конвертация валюты
$currency = 'USD'; // Или другая нужная валюта
$exchangeRate = 1; // По умолчанию, если не удается получить курс

// URL страницы с курсами валют
$url = 'https://www.kurzy.cz/kurzy-men/kurzovni-listek/';

$html = new HtmlWeb();
$response = $html->load($url);

if ($response !== false) {
    $exchangeData = [];
    foreach ($response->find('table.table-striped tbody tr') as $row) {
        $cells = $row->find('td');
        if (count($cells) >= 3) {
            $currencyCode = trim($cells[1]->plaintext);
            $rate = floatval(str_replace(',', '.', trim($cells[2]->plaintext)));
            $exchangeData[$currencyCode] = $rate;
        }
    }

    if (isset($exchangeData[$currency])) {
        $exchangeRate = $exchangeData[$currency];
    }

    // Логирование полученных данных
    file_put_contents('exchange_rate_log.txt', print_r($exchangeData, true), FILE_APPEND);
} else {
    // Логирование ошибки получения данных
    file_put_contents('exchange_rate_log.txt', "Failed to fetch exchange rate data\n", FILE_APPEND);
}

// Расчет общей цены с НДС
$totalPrice = $data['totalPrice'];
$vat = $totalPrice * 0.21; // НДС 21%
$totalPriceWithVat = $totalPrice + $vat;
$totalPriceConverted = $totalPriceWithVat / $exchangeRate;

// Возвращаем данные клиенту
echo json_encode([
    'name' => htmlspecialchars($data['name']),
    'email' => htmlspecialchars($data['email']),
    'phone' => htmlspecialchars($data['phone']),
    'product' => htmlspecialchars($data['product']),
    'price' => (float)$data['price'],
    'quantity' => (int)$data['quantity'],
    'totalPrice' => round($totalPrice, 2),
    'totalPriceWithVat' => round($totalPriceWithVat, 2),
    'totalPriceConverted' => round($totalPriceConverted, 2),
    'currency' => $currency,
    'vat' => round($vat, 2)
]);
?>
