const toggle = document.querySelectorAll(".toggle");

toggle.forEach((e) => {
  e.addEventListener("click", () => {
    e.parentNode.classList.toggle("active");
  });
});
