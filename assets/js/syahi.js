let cart = [];

function selectCustomers() {
  const select = document.getElementById("customer_id");
  const phone = select.options[select.selectedIndex].getAttribute("data-phone");
  document.getElementById("phone").value = phone || "";
}

function openModal(service) {
  console.log(service);
  // document.getElementById('modal_photo').value = service.photo
  document.getElementById("modal_id").value = service.id;
  document.getElementById("modal_name").value = service.service_name;
  document.getElementById("modal_price").value = service.service_price;
  document.getElementById("modal_qty").value = service.service_qty;

  new bootstrap.Modal(document.getElementById("exampleModal")).show();
}

function addToCart() {
  const id = document.getElementById("modal_id").value;
  const name = document.getElementById("modal_name").value;
  const price = parseFloat(document.getElementById("modal_price").value);
  const qty = parseFloat(document.getElementById("modal_qty").value);

  const existing = cart.find((item) => item.id == id);

  if (existing) {
    existing.qty += qty;
  } else {
    cart.push({ id, name, price, qty });
  }
  renderCart();
}

function renderCart() {
  const cartContainer = document.querySelector("#cartItems");
  cartContainer.innerHTML = "";

  if (cart.length === 0) {
    cartContainer.innerHTML = `
                    <div class="cart-items" id="cartItems">
                    <div class="text-center text-muted mt-5">
                        <i class="bi bi-basket-fill mb-3"></i>
                        <p>Your Basket is Empty</p>
                    </div>
                </div>`;
    updateTotal();

    return;
  }
  cart.forEach((item, index) => {
    const div = document.createElement("div");
    div.className = "cart-item d-flex justify-content-between align-items-center mb-2";
    div.innerHTML = `
                <div>
                    <strong>${item.name}</strong>
                    <small>${item.price}</small>
                </div>
                <div class="d-flex align-items-center">
                <span>${item.qty}</span>
                <button class="btn btn-sm btn-danger ms-3" onclick="removeItem(${item.id})">
                <i class="bi bi-trash"></i>
                </button>
                </div>
                `;
                cartContainer.appendChild(div);
              });
              updateTotal();
              calculateChange();
            }
            
            // <button class="btn btn-outline-secondary me-2" onclick="changeQty(${item.id}, -1)">-</button>
            // <button class="btn btn-outline-secondary ms-3" onclick="changeQty(${item.id}, 1)">+</button>
            

// Menghapus item dari cart
function removeItem(id) {
  cart = cart.filter((p) => p.id != id);
  renderCart();
}
// Mengatur Qty di Cart
function changeQty(id, x) {
  const item = cart.find((p) => p.id == id);
  if (!item) {
    return;
  }
  item.qty += x;
  if (item.qty <= 0) {
    alert("Minimum 1 Product");
    item.qty += 1;
    //cart = filter((p) => p.id != id);
  }
  renderCart();
}

function updateTotal() {
  const subtotal = cart.reduce((sum, item) => sum + parseFloat(item.price) * parseFloat(item.qty), 0);
  // const subtotal = price * qty;
  const taxValue = document.querySelector(".tax").value;
  let tax = taxValue / 100;
  tax = subtotal * parseFloat(tax);
  const total = tax + subtotal;
  console.log(tax);

  document.getElementById("subtotal").textContent = `Rp.${subtotal.toLocaleString()}`;
  document.getElementById("tax").textContent = `Rp. ${tax.toLocaleString()}`;
  document.getElementById("total").textContent = `Rp.${total.toLocaleString()}`;

  document.getElementById("subtotal_value").value = subtotal;
  document.getElementById("tax_value").value = tax;
  document.getElementById("total_value").value = total;
}
document.getElementById("clearCart").addEventListener("click", function () {
  cart = [];
  renderCart();
});

async function processPayment() {
  if (cart.length === 0) {
    alert("Your Basket is Still Empty");
    return;
  }

  const order_code = document.querySelector(".orderNumber").textContent.trim();
  const subtotal = document.querySelector("#subtotal_value").value.trim();
  const tax = document.querySelector("#tax_value").value.trim();
  const grandTotal = document.querySelector("#total_value").value.trim();
  const customer_id = parseInt(document.getElementById("customer_id").value);
  const end_date = document.getElementById("end_date").value;

  const pay = document.getElementById('pay').value.trim();
  const change = document.getElementById('change').value.trim();

  try {
    const res = await fetch("add-order.php?payment", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ cart, order_code, subtotal, tax, grandTotal, customer_id, end_date, pay, change}),
    });
    const data = await res.json();
    if (data.status == "Success") {
      alert("Transaction Success");
      window.location.href = "print.php?id=" + data.order_id;
    } else {
      alert("Transaction Failed", data.message);
    }
  } catch (error) {
    alert("Transaction Failed");
    console.log("error", error);
  }
}

function calculateChange() {
  const total = document.getElementById('total_value').value;
  const pay = document.getElementById('pay').value;

  let change = pay - total;
  if (change < 0) change = 0;
  document.getElementById('change').value = change;
}
