document.addEventListener("DOMContentLoaded", function() {
    let quantityValue = document.getElementById('quantity-value');
    let incrementButton = document.querySelector('.increment');
    let decrementButton = document.querySelector('.decrement');
    let addToCartButton = document.querySelector('.add-to-cart');

    // Mengatur event listener untuk tombol tambah dan kurang
    incrementButton.addEventListener('click', function() {
        quantityValue.textContent = parseInt(quantityValue.textContent) + 1;
    });

    decrementButton.addEventListener('click', function() {
        let currentQuantity = parseInt(quantityValue.textContent);
        if (currentQuantity > 1) {
            quantityValue.textContent = currentQuantity - 1;
        }
    });

    // Menambahkan produk ke keranjang
    addToCartButton.addEventListener('click', function() {
        // Ambil data produk (nama, harga, dan kuantitas)
        let productName = document.querySelector('.product-title').textContent;  // Nama produk
        let productPrice = document.querySelector('.product-price').textContent; // Harga produk
        let quantity = parseInt(quantityValue.textContent);  // Kuantitas

        // Membuat objek produk yang ditambahkan
        let product = {
            name: productName,
            price: productPrice,
            quantity: quantity
        };

        // Simpan produk dalam localStorage (untuk simulasi keranjang)
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart.push(product);
        localStorage.setItem('cart', JSON.stringify(cart));

        alert('Produk telah ditambahkan ke keranjang!');
    });
});
