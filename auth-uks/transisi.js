document.addEventListener("DOMContentLoaded", () => {
  document.body.classList.add("fade-in");

  document.querySelectorAll("a").forEach(link => {
    link.addEventListener("click", e => {
      e.preventDefault();
      const tujuan = link.href;
      document.body.classList.add("fade-out");

      setTimeout(() => {
        window.location.href = tujuan;
      }, 500);
    });
  });
});
