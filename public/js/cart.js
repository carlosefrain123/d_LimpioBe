document.addEventListener("DOMContentLoaded", function () {
    loadCart();
    loadWishlist();
});

// Función para actualizar la cantidad en carrito y wishlist
function updateQuantity(productId, action) {
    let qtyInput=document.getElementById(`qty-${productId}`);
    let quantity=parseInt(qtyInput.value);
    if (action==="plus") {
        quantity++;
    } else if(action==="minus"&&quantity>1){
        quantity--;
    }
    qtyInput.value=quantity;
}

// Función para agregar al carrito
function addToCart(productId, imageUrl, url, price) {
    let quantity = parseInt(document.getElementById(`qty-${productId}`).value);
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    let existingProduct = cart.find((item) => item.id === productId);
    if (existingProduct) {
        existingProduct.quantity += quantity;
    } else {
        cart.push({
            id: productId,
            image: imageUrl,
            url: url,
            price: price,
            name: name,
            quantity: quantity,
        });
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    alert("Producto agregado al carrito y eliminado de la lista de deseos");
}

// Función para agregar a la wishlist
function addToWishlist(productId, imageUrl, url, price) {
    let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];

    let existingProduct = wishlist.find((item) => item.id === productId);
    if (!existingProduct) {
        wishlist.push({
            id: productId,
            image: imageUrl,
            url: url,
            price: price,
            name: name,
        });
        localStorage.setItem("wishlist", JSON.stringify(wishlist));
        updateWishlistCount(); // Actualizar contador en el header
        alert("Producto agregado a la lista de deseos");
    } else {
        alert("Este producto ya está en la lista de deseos");
    }
}
// Función para cargar el carrito
function loadCart() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    console.log("Carrito cargado:", cart);
}

// Función para cargar la wishlist y mostrarla en wishlists/index.blade.php
function loadWishlist() {
    let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
    console.log("Lista de deseos cargado:", wishlist);
}

// Función para editar una reseña (manteniendo la funcionalidad previa)
function editReview(reviewId, rating, comment) {
    document.getElementById("review_id").value = reviewId;
    document.getElementById("review_rating").value = rating;
    document.getElementById("review_comment").value = comment;
}
