// Active Navbar link
let links = document.querySelectorAll(".navbar ul li a");
let linksArr = Array.from(links);

linksArr.forEach((link) => {
  if (link.href === window.location.href) {
    link.classList.add("active");
  }
});

// Dynamic Year Footer
let year = document.getElementById("year");
let currentDate = new Date();
let currentYear = currentDate.getFullYear();

year.innerHTML = currentYear;
