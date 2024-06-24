function validateOrder() {
    // Проверка имени
    var name = document.getElementById('name').value;
    if (name.trim() === '') {
        alert('Пожалуйста, введите имя.');
        return false;
    }

    // Проверка email
    var email = document.getElementById('email').value;
    if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)) {
        alert('Пожалуйста, введите корректный адрес электронной почты.');
        return false;
    }

    // Получить данные о продукте
    var product = document.getElementById('product').value;
    var price = 0;
    switch (product) {
        case 'product1':
            price = 1000;
            break;
        case 'product2':
            price = 2500;
            break;
        case 'product3':
            price = 5000;
            break;
    }

    // Получить количество и валюту
    var quantity = parseInt(document.getElementById('quantity').value);
    var currency = document.getElementById('currency').value;

    // Загрузить курс валюты
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'https://api.exchangeratesapi.io/latest?base=CZK');
    xhr.onload = function() {
        if (xhr.status === 200) {
            var rates = JSON.parse(xhr.responseText);
            var exchangeRate = rates['rates'][currency];

            // Рассчитать общую сумму в выбранной валюте
            var totalCZK = price * quantity;
            var totalCurrency = totalCZK * exchangeRate;

            // Отобразить сводку заказа
            var orderSummary = document.getElementById('orderSummary');
            orderSummary.innerHTML = `
                <h2>Сводка заказа</h2>
                <p>Имя: ${name}</p>
                <p>Email: ${email}</p>
                <p>Продукт: ${product}</p>
                <p>Количество: ${quantity} шт.</p>
                <p>Цена за единицу: ${price} CZK</p>
                <p>Общая сумма (CZK): ${totalCZK} CZK</p>
                <p>Курс валюты: 1 CZK = ${exchangeRate.toFixed(4)} ${currency}</p>
                <p>Общая сумма в ${currency}: ${totalCurrency.toFixed(2)} ${currency}</p>
            `;
        } else {
            alert('Ошибка загрузки курса валюты.');
        }
    };
    xhr.send();

    return false; // Предотвратить стандартную отправку формы
}