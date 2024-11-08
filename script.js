// Mendefinisikan fungsi format Rupiah
const rupiah = (number) => {
  return new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0,
  }).format(number);
};

// Inisialisasi keranjang belanja
let cart = [];
let products = []; // Array untuk menyimpan data produk

const productContainer = document.querySelector(".row");
const cartContainer = document.querySelector(".shopping-cart");

// Fungsi untuk memperbarui tampilan keranjang
function updateCart() {
  cartContainer.innerHTML = "";
  let totalPriceBeforeDiscount = 0;
  let totalDiscount = 0;
  let totalPriceAfterDiscount = 0;

  cart.forEach((item) => {
    const discountedPrice = item.price * item.discount;
    const jmlDiscount = item.price - discountedPrice;
    totalPriceBeforeDiscount += item.price * item.quantity;
    totalDiscount += jmlDiscount * item.quantity;
    totalPriceAfterDiscount += discountedPrice * item.quantity;

    const cartItemHTML = `
      <div class="cart-item">
        <img src="${item.img}" alt="${item.name}">
        <div class="detail-item">
          <h3>${item.name}</h3>
          <div class="item-price">${rupiah(discountedPrice)}</div>
          <div class="quantity-control">
            <button class="decrease-quantity" data-id="${item.id}">-</button>
            <span>${item.quantity}</span>
            <button class="increase-quantity" data-id="${item.id}">+</button>
          </div>
        </div>
        <i data-feather="trash-2" class="delete-item" data-id="${item.id}"></i>
      </div>
    `;
    cartContainer.innerHTML += cartItemHTML;
  });

  const cartSummaryHTML = `
    <div class="cart-summary">
      <p>Total harga (sebelum diskon): ${rupiah(totalPriceBeforeDiscount)}</p>
      <p>Total diskon: ${rupiah(totalDiscount)}</p>
      <p>Total harga (setelah diskon): ${rupiah(totalPriceAfterDiscount)}</p>
    </div>
  `;
  cartContainer.innerHTML += cartSummaryHTML;

  feather.replace();
}

// Fungsi untuk menambahkan produk ke keranjang melalui API PHP
function addToCart(product) {
  fetch("backend/cart.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ product_id: product.id, quantity: 1 }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      const existingItem = cart.find((item) => item.id === product.id);

      if (!existingItem) {
        cart.push({ ...product, quantity: 1 });
      } else {
        existingItem.quantity += 1;
      }
      updateCart();
    })
    .catch((error) => console.error("Error:", error));
}

// Fungsi untuk memuat produk dari server dan menampilkannya
function loadProducts() {
  fetch("backend/products.php")
    .then((response) => response.json())
    .then((data) => {
      console.log("Data produk:", data); // Cek data dari server
      products = data;
      data.forEach((product) => {
        const productHTML = `
          <div class="product-card">
            <div class="product-icons">
              <a href="#" class="add-to-cart" data-id="${product.id}">
                <i data-feather="shopping-cart"></i>
              </a>
            </div>
            <div class="product-image">
              <img src="${product.img}" alt="${product.name}" />
            </div>
            <div class="product-content">
              <h3>${product.name}</h3>
              <div class="product-stars">
                <i data-feather="star"></i>
                <i data-feather="star"></i>
                <i data-feather="star"></i>
                <i data-feather="star"></i>
                <i data-feather="star"></i>
              </div>
              <div class="product-price">${rupiah(
                product.price * product.discount
              )} <span>${rupiah(product.price)}</span></div>
            </div>
          </div>
        `;
        productContainer.innerHTML += productHTML;
        feather.replace();
      });
    })
    .catch((error) => console.error("Error fetching products:", error));
}

// Event listener untuk tombol "Add to Cart"
productContainer.addEventListener("click", (e) => {
  if (e.target.closest(".add-to-cart")) {
    e.preventDefault();
    const productId = parseInt(
      e.target.closest(".add-to-cart").getAttribute("data-id")
    );
    const product = products.find((item) => item.id === productId);
    addToCart(product);
  }
});

// Memuat data produk saat halaman pertama kali dibuka
document.addEventListener("DOMContentLoaded", () => {
  loadProducts();
});
