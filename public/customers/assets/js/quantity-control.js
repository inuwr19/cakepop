document.addEventListener('DOMContentLoaded', function () {
    const quantityValue = document.getElementById('quantity-value');
    const incrementButton = document.querySelector('.increment');
    const decrementButton = document.querySelector('.decrement');
    
   // Mengatur tombol decrement (minus)
document.querySelector('.decrement').addEventListener('click', function () {
    const quantityElement = document.getElementById('quantity-value');
    let quantity = parseInt(quantityElement.textContent);
    if (quantity > 1) {
        quantityElement.textContent = quantity - 1;
    }
});

// Mengatur tombol increment (plus)
document.querySelector('.increment').addEventListener('click', function () {
    const quantityElement = document.getElementById('quantity-value');
    let quantity = parseInt(quantityElement.textContent);
    quantityElement.textContent = quantity + 1;
});
});