<?php
header('Content-Type: application/json');

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

// URL текстового файла с курсами валют
$date = date('d.m.Y'); // Текущая дата
$url = 'https://www.cnb.cz/cs/financni-trhy/devizovy-trh/kurzy-devizoveho-trhu/kurzy-devizoveho-trhu/denni_kurz.txt?date=' . $date;

// Локальный файл для сохранения
$localFile = 'denni_kurz_' . $date . '.txt';

// Скачивание файла
if (copy($url, $localFile)) {
    // Файл успешно скачан, теперь его можно обработать
    $dataFromFile = file_get_contents($localFile);

    if ($dataFromFile !== false) {
        // Разбиваем текст на строки
        $lines = explode("\n", $dataFromFile);

        // Поиск курса валюты
        $found = false;
        for ($i = 1; $i < count($lines); $i++) { // Начинаем с первой строки после даты
            $line = $lines[$i];
            // Ищем строку, начинающуюся с кода валюты
            if (strpos($line, $currency . '|') === 0) {
                $parts = explode('|', $line);
                if (count($parts) >= 5 && trim($parts[3]) === $currency) {
                    $exchangeRate = floatval(str_replace(',', '.', $parts[4])); // Извлекаем курс
                    $found = true;
                    break;
                }
            }
        }

        if (!$found) {
            // В случае, если курс не найден
            echo json_encode(['error' => 'Exchange rate not found for ' . $currency]);
            exit;
        }

        // Логирование полученных данных
        file_put_contents('exchange_rate_log.txt', "Exchange rate for $currency on $date: $exchangeRate\n", FILE_APPEND);
    } else {
        // Логирование ошибки получения данных
        file_put_contents('exchange_rate_log.txt', "Failed to fetch exchange rate data from $url\n", FILE_APPEND);
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
        'vat' => round($vat, 2),
        'exchangeRate' => $exchangeRate // Добавляем курс валюты в ответ
    ]);
} else {
    // Ошибка при скачивании файла
    echo json_encode(['error' => 'Failed to download exchange rate file']);
}
?>
