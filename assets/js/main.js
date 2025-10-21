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
