// Inisialisasi keranjang dari sessionStorage
let cart = JSON.parse(sessionStorage.getItem('cart')) || [];

// Fungsi untuk menambahkan produk ke keranjang
function addToCart(product) {
    const existingProductIndex = cart.findIndex(item => item.id === product.id);

    if (existingProductIndex > -1) {
        // Jika produk sudah ada, tambahkan jumlahnya
        cart[existingProductIndex].quantity += 1;
    } else {
        // Jika produk baru, tambahkan ke keranjang
        cart.push(product);
    }

    // Simpan ke sessionStorage dan perbarui tampilan
    sessionStorage.setItem('cart', JSON.stringify(cart));
    updateCart();
}

// Fungsi untuk menangani klik tombol "Tambah ke keranjang"
function handleAddToCart(button) {
    const productId = parseInt(button.getAttribute('data-id'));
    const productName = button.getAttribute('data-name');
    const productPrice = parseFloat(button.getAttribute('data-price'));
    const productImage = button.getAttribute('data-image');

    // Debugging: Periksa path gambar sebelum ditambahkan
    console.log('Product Image Path:', productImage); // Memastikan path gambar

    // Panggil fungsi addToCart dengan data produk
    addToCart({
        id: productId,
        name: productName,
        price: productPrice,
        quantity: 1, // Set jumlah default ke 1
        image: productImage
    });
}

// Fungsi untuk menghapus produk dari keranjang
function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    sessionStorage.setItem('cart', JSON.stringify(cart)); // Simpan setelah menghapus
    updateCart();
}

// Fungsi untuk memperbarui tampilan keranjang
function updateCart() {
    const cartItemsContainer = document.getElementById('cart-items');
    const cartCount = document.getElementById('cart-count');
    const cartSubtotal = document.getElementById('cart-subtotal');

    // Kosongkan daftar keranjang
    cartItemsContainer.innerHTML = '';

    let total = 0;

    cart.forEach(item => {
        const itemSubtotal = item.price * item.quantity;
        total += itemSubtotal;

        const listItem = document.createElement('tr'); // Ganti <li> dengan <tr> untuk baris tabel

        listItem.innerHTML = `
            <td class="product-thumbnail">
                <a href="#"><img src="${item.image}" alt="${item.name}" style="width: 100px;"></a>
            </td>
            <td class="product-name">
                <h5><a href="#">${item.name}</a></h5>
            </td>
            <td class="product-cart-price">
                <span class="amount">Rp${item.price.toLocaleString()}</span>
            </td>
            <td class="cart-quality">
                <div class="product-quality">
                    <input class="cart-plus-minus-box input-text qty text" 
                           value="${item.quantity}" 
                           type="number" min="1"
                           onchange="updateCartQuantity(${item.id}, this.value)">
                </div>
            </td>
            <td class="product-total">
                <span>Rp${itemSubtotal.toLocaleString()}</span>
            </td>
            <td class="product-remove">
                <a href="#" onclick="removeFromCart(${item.id})"><i class="ti-trash"></i></a>
            </td>
        `;
        cartItemsContainer.appendChild(listItem);
    });

    // Perbarui jumlah produk di keranjang dan subtotal
    cartCount.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartSubtotal.textContent = `Rp${total.toLocaleString()}`;
}

// Fungsi untuk memperbarui kuantitas produk dalam keranjang
function updateCartQuantity(productId, quantity) {
    cart = cart.map(item => {
        if (item.id === productId) {
            item.quantity = parseInt(quantity);
        }
        return item;
    });
    sessionStorage.setItem('cart', JSON.stringify(cart));
    updateCart();  // Perbarui tampilan keranjang setelah kuantitas diperbarui
}

// Fungsi untuk menampilkan/menyembunyikan mini cart
function toggleCart() {
    const miniCart = document.getElementById('mini-cart');
    miniCart.style.display = miniCart.style.display === 'block' ? 'none' : 'block';
}

// Muat ulang keranjang saat halaman dimuat
window.addEventListener('load', updateCart);
