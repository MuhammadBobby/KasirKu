function confirmDelete(id, pageUrl) {
  // Menampilkan konfirmasi
  if (confirm("Apakah Anda yakin ingin menghapus Data ini?")) {
    // Jika ya, redirect ke halaman delete dengan ID yang dipilih
    window.location.href = "functions/" + pageUrl + ".php?id=" + id;
  } else {
    // Jika tidak, tidak melakukan apa-apa
    return false;
  }
}
