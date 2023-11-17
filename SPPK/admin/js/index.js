// Select all elements with the class 'has-dropdown'
const dropdowns = document.querySelectorAll(".has-dropdown");

dropdowns.forEach((dropdown) => {
  const dropdownMenu = dropdown.querySelector(".dropdown-menu");

  dropdown.addEventListener("mouseMove", () => {
    dropdownMenu.style.display = "block";
  });

  dropdown.addEventListener("mouseleave", () => {
    dropdownMenu.style.display = "none";
  });
});
