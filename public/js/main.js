// FORM TAMBAH MAKANAN KHAS
const deskripsi_makanan = document.getElementById('deskripsi-makanan-khas');
const deskripsi_count = document.getElementById('deskripsi-count');

// ubah deskripsi count ketika deskripsi makanan berubah
deskripsi_makanan.oninput = (event) => {
  deskripsi_count.innerText = event.target.value.length + ' / 300';
};

// FORM UPDATE MAKANAN KHAS
const deskripsi_update_makanan = document.getElementById('update-deskripsi-makanan-khas');
const deskripsi_update_count = document.getElementById('update-deskripsi-count');

// ubah deskripsi count ketika deskripsi makanan berubah
deskripsi_update_makanan.oninput = (event) => {
  deskripsi_update_count.innerText = event.target.value.length + ' / 300';
};

// ubah data form update makanan khas sesuai makanan khas yang akan diedit
function updateEditMakananForm(makanan_khas_id, nama, daerah, deskripsi) {
  document.getElementById('formUpdateMakanan').action += `update/${makanan_khas_id}`;
  document.getElementById('update-nama-makanan-khas').value = nama;
  document.getElementById('update-daerah-makanan-khas').value = daerah;
  document.getElementById('update-deskripsi-makanan-khas').value = deskripsi;
  deskripsi_update_count.innerText = deskripsi.length + ' / 300';
}