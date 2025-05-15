// ======================= HELPER ============================
function parseCurrency(value) {
  return parseInt(value.replace(/[^0-9]/g, "")) || 0;
}

function formatCurrency(value) {
  return "Rp " + Number(value).toLocaleString("id-ID");
}

// ======================= PRODUK DINAMIS =====================
const produkWrapper = document.getElementById("produk-wrapper");
const tambahBtn = document.getElementById("tambah-produk");
const template = document.getElementById("produk-template");

if (tambahBtn && template && produkWrapper) {
  tambahBtn.addEventListener("click", () => {
    const clone = template.content.cloneNode(true);
    produkWrapper.appendChild(clone);
    attachEvents();
    updateTotal();
  });
}

function attachEvents() {
  document.querySelectorAll(".produk-row").forEach((row) => {
    const searchInput = row.querySelector(".search-produk");
    const produkList = row.querySelector(".produk-list");
    const qtyInput = row.querySelector(".quantity");
    const priceDisplay = row.querySelector(".price-display");
    const subtotalInput = row.querySelector(".subtotal");
    const hiddenId = row.querySelector(".product-id");

    // Filter produk
    if (searchInput) {
      searchInput.oninput = () => {
        const filter = searchInput.value.toLowerCase();
        produkList.querySelectorAll("li").forEach((li) => {
          li.style.display = li.textContent.toLowerCase().includes(filter) ? "block" : "none";
        });
        produkList.classList.remove("hidden");
      };
    }

    // Pilih produk
    produkList.querySelectorAll("li").forEach((li) => {
      li.onclick = () => {
        const name = li.textContent;
        const id = li.dataset.id;
        const price = li.dataset.price;

        searchInput.value = name.trimStart();
        hiddenId.value = id;
        priceDisplay.value = formatCurrency(price);
        subtotalInput.value = formatCurrency(price * (parseInt(qtyInput.value) || 1));

        produkList.classList.add("hidden");
        updateTotal();
      };
    });

    // Qty perubahan
    qtyInput.oninput = () => {
      const price = parseCurrency(priceDisplay.value);
      const qty = parseInt(qtyInput.value) || 0;
      subtotalInput.value = formatCurrency(price * qty);
      updateTotal();
    };

    // Hapus baris
    row.querySelector(".hapus-produk").onclick = () => {
      row.remove();
      updateTotal();
    };
  });
}

function updateTotal() {
  let total = 0;
  document.querySelectorAll(".subtotal").forEach((input) => {
    total += parseCurrency(input.value);
  });

  // Update total display dan hidden input
  const totalInputDisplay = document.getElementById("total-price-display");
  const totalInput = document.getElementById("total-price");

  if (totalInputDisplay && totalInput) {
    totalInputDisplay.value = formatCurrency(total);
    totalInput.value = total;
  }

  // Update keterangan total juga
  const totalPriceKet = document.getElementById("total-price-ket");
  if (totalPriceKet) totalPriceKet.textContent = formatCurrency(total);

  // Hitung ulang uang kembalian jika sudah ada uang dibayar
  handleCashInput();
}

// ======================= PEMBAYARAN =========================
const quantityInput = document.getElementById("quantity");
const priceInput = document.getElementById("product-price");
const totalInputDisplay = document.getElementById("total-price-display");
const totalInput = document.getElementById("total-price");
const cashInputDisplay = document.getElementById("cash-paid-display");
const cashInput = document.getElementById("cash-paid");
const changeReturnedDisplay = document.getElementById("change-returned-display");
const changeReturned = document.getElementById("change-returned");

const cashPaidKet = document.getElementById("cash-paid-ket");
const changeReturnedKet = document.getElementById("change-returned-ket");
const totalPriceKet = document.getElementById("total-price-ket");

if (quantityInput && priceInput && totalInputDisplay && totalInput) {
  quantityInput.addEventListener("input", () => {
    const qty = parseInt(quantityInput.value) || 0;
    const price = parseInt(priceInput.value) || 0;
    const total = qty * price;

    totalInputDisplay.value = formatCurrency(total);
    totalInput.value = total;
    if (totalPriceKet) totalPriceKet.textContent = formatCurrency(total);

    // Update kembalian jika ada
    handleCashInput();
  });
}

if (cashInputDisplay) {
  cashInputDisplay.addEventListener("input", handleCashInput);
}

function handleCashInput() {
  const cash = parseCurrency(cashInputDisplay?.value || "");
  const total = parseCurrency(totalInput?.value || "");
  const change = cash - total;

  if (cashInputDisplay) cashInputDisplay.value = formatCurrency(cash);
  if (cashInput) cashInput.value = cash;

  const finalChange = change > 0 ? change : 0;
  if (changeReturnedDisplay) changeReturnedDisplay.value = formatCurrency(finalChange);
  if (changeReturned) changeReturned.value = finalChange;

  if (cashPaidKet) cashPaidKet.textContent = formatCurrency(cash);
  if (changeReturnedKet) changeReturnedKet.textContent = formatCurrency(finalChange);
}
