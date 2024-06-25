document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('orderForm');
    const priceInput = document.getElementById('price');
    const quantityInput = document.getElementById('quantity');
    const totalPriceDisplay = document.getElementById('totalPrice');
    const summaryDiv = document.getElementById('summary');
    const summaryContent = document.getElementById('summaryContent');
    const currencyDisplay = document.getElementById('currencyDisplay');

    function updateTotalPrice() {
        const price = parseFloat(priceInput.value) || 0;
        const quantity = parseInt(quantityInput.value) || 0;
        const totalPrice = price * quantity;
        totalPriceDisplay.textContent = totalPrice.toFixed(2) + ' CZK';
    }

    priceInput.addEventListener('input', updateTotalPrice);
    quantityInput.addEventListener('input', updateTotalPrice);

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const name = form.querySelector('input[name="name"]').value.trim();
        const email = form.querySelector('input[name="email"]').value.trim();
        const phone = form.querySelector('input[name="phone"]').value.trim();
        const product = form.querySelector('input[name="product"]').value.trim();
        const price = parseFloat(priceInput.value);
        const quantity = parseInt(quantityInput.value);

        if (!name || !email || !phone || !product || isNaN(price) || isNaN(quantity)) {
            alert('Please fill in all required fields correctly.');
            return;
        }

        const data = {
            name: name,
            email: email,
            phone: phone,
            product: product,
            price: price,
            quantity: quantity
        };

        const totalPrice = parseFloat(totalPriceDisplay.textContent);
        data.totalPrice = totalPrice;

        fetch('engine/process.php', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(result => {
            if (result.error) {
                alert(result.error);
                return;
            }

            summaryDiv.style.display = 'block';
            currencyDisplay.textContent = `Exchange rate: 1 ${result.currency} = ${result.exchangeRate.toFixed(4)} CZK`;
            summaryContent.innerHTML = `
                <p>Name: ${result.name}</p>
                <p>Email: ${result.email}</p>
                <p>Phone: ${result.phone}</p>
                <p>Product: ${result.product}</p>
                <p>Price: ${result.price} CZK</p>
                <p>Quantity: ${result.quantity}</p>
                <p>Total Price: ${result.totalPrice}</p>
                <p>VAT (21%): ${result.vat}</p>
                <p>Total Price with VAT: ${result.totalPriceWithVat}</p>
                <p>Total Price (Converted): ${result.totalPriceConverted}</p>
            `;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while processing your request. Please try again later.');
        });
    });

    updateTotalPrice();
});
