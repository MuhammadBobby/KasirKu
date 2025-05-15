function filterProduk(keyword) {
  const list = document.getElementById("produk-list");
  const items = list.getElementsByTagName("li");
  let visible = false;

  for (let item of items) {
    if (item.textContent.toLowerCase().includes(keyword.toLowerCase())) {
      item.style.display = "block";
      visible = true;
    } else {
      item.style.display = "none";
    }
  }

  list.style.display = visible ? "block" : "none";
}

function selectProduk(el) {
  const nama = el.textContent;
  const id = el.dataset.id;
  const harga = el.dataset.price;

  document.getElementById("search-produk").value = nama.trimStart();
  document.getElementById("produk-id").value = id;
  document.getElementById("product-price").value = harga;

  document.getElementById("produk-list").style.display = "none";
}
