document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var query = document.getElementById('searchInput').value.toLowerCase();
    var products = document.querySelectorAll('.product-wrap');
    
    products.forEach(function(product) {
        var productName = product.querySelector('h3 a').innerText.toLowerCase();
        if (productName.includes(query)) {
            product.style.display = 'block'; // Tampilkan produk yang cocok
        } else {
            product.style.display = 'none'; // Sembunyikan produk yang tidak cocok
        }
    });
});
