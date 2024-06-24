document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('orderForm');
    const priceInput = document.getElementById('price');
    const quantityInput = document.getElementById('quantity');
    const totalPriceDisplay = document.getElementById('totalPrice');
    const summaryDiv = document.getElementById('summary');
    const summaryContent = document.getElementById('summaryContent');

    function updateTotalPrice() {
        const price = parseFloat(priceInput.value) || 0;
        const quantity = parseInt(quantityInput.value) || 0;
        const totalPrice = price * quantity;
        totalPriceDisplay.textContent = totalPrice.toFixed(2);
    }

    priceInput.addEventListener('input', updateTotalPrice);
    quantityInput.addEventListener('input', updateTotalPrice);

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });

        const totalPrice = parseFloat(totalPriceDisplay.textContent);
        data.totalPrice = totalPrice;

        fetch('engine/process.php', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(result => {
            if (result.error) {
                alert(result.error);
                return;
            }

            summaryDiv.style.display = 'block';
            summaryContent.innerHTML = `
                <p>Name: ${result.name}</p>
                <p>Email: ${result.email}</p>
                <p>Phone: ${result.phone}</p>
                <p>Product: ${result.product}</p>
                <p>Price: ${result.price} CZK</p>
                <p>Quantity: ${result.quantity}</p>
                <p>Total Price: ${result.totalPrice} CZK</p>
                <p>VAT (21%): ${result.vat} CZK</p>
                <p>Total Price with VAT: ${result.totalPriceWithVat} CZK</p>
                <p>Total Price (Converted): ${result.totalPriceConverted} ${result.currency}</p>
            `;
        })
        .catch(error => console.error('Error:', error));
    });

    updateTotalPrice();
});
