// card hover effect
const cards = document.querySelectorAll(".card");

cards.forEach((card) => {
  card.addEventListener("mouseenter", () => {
    card.style.transform = "translateY(-10px)";
  });

  card.addEventListener("mouseleave", () => {
    card.style.transform = "translateY(0)";
  });
});

// Navbar hide on scroll
const navbar = document.querySelector(".navbar");
let lastScroll = 0;

window.addEventListener("scroll", () => {
  const currentScroll = window.pageYOffset;

  if (currentScroll > lastScroll && currentScroll > 100) {
    navbar.style.transform = "translateY(-100%)";
  } else {
    navbar.style.transform = "translateY(0)";
  }

  if (currentScroll > 100) {
    navbar.classList.add("navbar--scrolled");
  } else {
    navbar.classList.remove("navbar--scrolled");
  }

  lastScroll = currentScroll;
});

// Scroll to Top Button.
const scrollTopBtn = document.getElementById("scrollTopBtn");

window.addEventListener("scroll", () => {
  if (document.documentElement.scrollTop > 300) {
    scrollTopBtn.style.display = "block";
  } else {
    scrollTopBtn.style.display = "none";
  }
});

scrollTopBtn.addEventListener("click", () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
});

// Welcome Snackbar
window.addEventListener("load", () => {
  const snackbar = document.getElementById("snackbar");
  snackbar.className = "show";
  setTimeout(() => {
    snackbar.className = snackbar.className.replace("show", "");
  }, 3000);
});

// Confirm box for Schedule Visit
document
  .querySelector('a[href="#visit"]')
  .addEventListener("click", function (e) {
    e.preventDefault();
    if (confirm("Apakah Anda ingin membuat jadwal kunjungan properti?")) {
      // Jika user klik OK
      window.location.href = "#visit";
    }
  });

var selectedCategoryId;
// Fungsi Modal
function bukaModal(categoryId) {
  console.log("categoryId:", categoryId);
  selectedCategoryId = categoryId;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var categoryData = JSON.parse(xhr.responseText);

      // Perbarui input tersembunyi
      document.getElementById("category_id").value = categoryId;
      document.getElementById("category_name").value = categoryData.categories;
      document.getElementById("price").value = categoryData.price;
      document.getElementById("myModal").style.display = "flex";
    }
  };
  xhr.open("GET", "get_kategori.php?" + categoryId, true);
  xhr.send();
}

function tutupModal() {
  document.getElementById("myModal").style.display = "none";
}

function tutupModal2() {
  document.getElementById("myModal2").style.display = "none";
}

function bukaModal2() {
  tutupModal(); // Tutup modal pertama
  document.getElementById("myModal2").style.display = "flex";

  var nama = document.getElementById("recipient-name").value;
  var nomorhp = document.getElementById("handphone").value;
  var alamat = document.getElementById("alamat-text").value;
  // kategori
  var kategori = document.getElementById("category_name").value;
  var harga = document.getElementById("price").value;

  document.getElementById("detail-nama").value = nama;
  document.getElementById("detail-nomorhp").value = nomorhp;
  document.getElementById("detail-alamat").value = alamat;
  document.getElementById("detail-kategori").value = kategori;
  document.getElementById("detail-harga").value = harga;
}

function kembaliKeModalPertama() {
  tutupModal2();
  bukaModal();
}

function lakukanPembayaran() {
  alert("Pembayaran berhasil!");
  tutupModal2();
  document.getElementById("recipient-name").value = "";
  document.getElementById("handphone").value = "";
  document.getElementById("alamat-text").value = "";
}
