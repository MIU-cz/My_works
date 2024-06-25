<?php
header('Content-Type: application/json');

// Получение данных из запроса
$data = json_decode(file_get_contents('php://input'), true);

// Проверка необходимых полей
$requiredFields = ['name', 'email', 'phone', 'product', 'price', 'quantity', 'totalPrice'];
foreach ($requiredFields as $field) {
    if (empty($data[$field])) {
        echo json_encode(['error' => "Invalid data: $field is required"]);
        exit;
    }
}

// Конвертация валюты
$currencyUSD = 'USD'; // Валюта для конвертации в USD
$currencyEUR = 'EUR'; // Валюта для конвертации в EUR
$exchangeRateUSD = 1; // По умолчанию, если не удается получить курс
$exchangeRateEUR = 1; // По умолчанию, если не удается получить курс

// URL текстового файла с курсами валют
$date = date('d.m.Y'); // Текущая дата
$url = "https://www.cnb.cz/cs/financni-trhy/devizovy-trh/kurzy-devizoveho-trhu/kurzy-devizoveho-trhu/denni_kurz.txt?date=$date";

// Локальный файл для сохранения
$localFile = __DIR__ . "/denni_kurz_$date.txt";

// Функция для получения курса валюты из файла
function getExchangeRate($currency, $url, $localFile) {
    if (!file_exists($localFile)) {
        if (!copy($url, $localFile)) {
            return ['error' => 'Failed to download exchange rate file'];
        }
    }

    $dataFromFile = file_get_contents($localFile);
    if ($dataFromFile === false) {
        return ['error' => 'Failed to read exchange rate file'];
    }

    $lines = explode("\n", $dataFromFile);
    
    // Логирование для отладки
    file_put_contents('debug_log.txt', "File content:\n$dataFromFile\n", FILE_APPEND);
    
    foreach ($lines as $line) {
        if (strpos($line, $currency . '|') !== false) {
            $parts = explode('|', $line);
            file_put_contents('debug_log.txt', "Found line: $line\n", FILE_APPEND);
            if (count($parts) >= 5 && trim($parts[3]) === $currency) {
                return floatval(str_replace(',', '.', $parts[4]));
            }
        }
    }

    return ['error' => 'Exchange rate not found for ' . $currency];
}

// Получение курса валюты USD
$exchangeRateResultUSD = getExchangeRate($currencyUSD, $url, $localFile);
if (isset($exchangeRateResultUSD['error'])) {
    echo json_encode($exchangeRateResultUSD);
    exit;
}
$exchangeRateUSD = $exchangeRateResultUSD;

// Получение курса валюты EUR
$exchangeRateResultEUR = getExchangeRate($currencyEUR, $url, $localFile);
if (isset($exchangeRateResultEUR['error'])) {
    echo json_encode($exchangeRateResultEUR);
    exit;
}
$exchangeRateEUR = $exchangeRateResultEUR;

// Логирование полученных данных
file_put_contents('exchange_rate_log.txt', "Exchange rate for $currencyUSD on $date: $exchangeRateUSD\n", FILE_APPEND);
file_put_contents('exchange_rate_log.txt', "Exchange rate for $currencyEUR on $date: $exchangeRateEUR\n", FILE_APPEND);

// Расчет общей цены с НДС
$totalPrice = $data['totalPrice'];
$vat = $totalPrice * 0.21; // НДС 21%
$totalPriceWithVat = $totalPrice + $vat;
$totalPriceConvertedUSD = $totalPriceWithVat / $exchangeRateUSD;
$totalPriceConvertedEUR = $totalPriceWithVat / $exchangeRateEUR;

// Возвращаем данные клиенту
echo json_encode([
    'name' => htmlspecialchars($data['name']),
    'email' => htmlspecialchars($data['email']),
    'phone' => htmlspecialchars($data['phone']),
    'product' => htmlspecialchars($data['product']),
    'price' => (float)$data['price'],
    'quantity' => (int)$data['quantity'],
    'totalPrice' => round($totalPrice, 2) . ' CZK',
    'totalPriceWithVat' => round($totalPriceWithVat, 2) . ' CZK',
    'totalPriceConvertedUSD' => round($totalPriceConvertedUSD, 2) . ' ' . $currencyUSD,
    'totalPriceConvertedEUR' => round($totalPriceConvertedEUR, 2) . ' ' . $currencyEUR,
    'currencyUSD' => $currencyUSD,
    'currencyEUR' => $currencyEUR,
    'vat' => round($vat, 2) . ' CZK',
    'exchangeRateUSD' => $exchangeRateUSD,
    'exchangeRateEUR' => $exchangeRateEUR
]);
?>
