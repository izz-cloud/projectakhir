document.addEventListener("DOMContentLoaded", () => {
  // Page fade-in on load (only if body starts with opacity 0)
  if (document.body.style.opacity === "0" || getComputedStyle(document.body).opacity === "0") {
    requestAnimationFrame(() => {
      document.body.classList.add("fade-in");
    });
  } else {
    // If already visible, just ensure fade-in class is present
    document.body.classList.add("fade-in");
  }

  // Smooth fade-out on all link navigation
  document.querySelectorAll("a").forEach(link => {
    const href = link.getAttribute("href");
    if (!href || href.startsWith("#") || href.startsWith("javascript:")) return;

    // Check if it's a same-origin PHP page
    const isSameOrigin = href.includes(".php") || (!href.includes("http") && !href.includes("mailto:"));
    
    link.addEventListener("click", e => {
      // Skip if it's a logout confirmation or external link
      if (link.onclick && link.onclick.toString().includes("confirm")) {
        // Let the confirm dialog handle it, but add fade-out after confirmation
        const originalOnclick = link.onclick;
        link.onclick = function(e) {
          const result = originalOnclick.call(this, e);
          if (result !== false) {
            setTimeout(() => {
              document.body.classList.add("fade-out");
            }, 100);
          }
          return result;
        };
        return;
      }

      if (!isSameOrigin) return;

      e.preventDefault();
      const tujuan = link.href;
      
      // Smooth fade-out
      document.body.classList.add("fade-out");
      
      setTimeout(() => {
        window.location.href = tujuan;
      }, 350);
    });
  });

  // Smooth fade-out on form submissions
  document.querySelectorAll("form").forEach(form => {
    // Skip special handling for registration form to avoid hiding it on validation errors
    if (form.id === "registerForm") {
      return;
    }

    const submitBtn = form.querySelector("button[type='submit'], button:not([type])");
    
    form.addEventListener("submit", (e) => {
      // Add loading state to button
      if (submitBtn) {
        submitBtn.disabled = true;
        const original = submitBtn.dataset.originalText || submitBtn.textContent;
        submitBtn.dataset.originalText = original;
        submitBtn.innerHTML = `<span class="btn-spinner"></span><span class="btn-text-sub">Memproses...</span>`;
      }

      // Fade-out before form submission (if it redirects)
      setTimeout(() => {
        document.body.classList.add("fade-out");
      }, 100);
    });
  });

  // Password show/hide toggle with accessibility
  document.querySelectorAll(".password-toggle").forEach(btn => {
    btn.addEventListener("click", () => {
      const targetId = btn.getAttribute("data-target");
      const input = document.getElementById(targetId);
      if (!input) return;

      const isHidden = input.type === "password";
      input.type = isHidden ? "text" : "password";
      btn.textContent = isHidden ? "🙈" : "👁";
      
      // Update ARIA attributes for accessibility
      btn.setAttribute("aria-pressed", isHidden ? "true" : "false");
      btn.setAttribute("aria-label", isHidden 
        ? "Sembunyikan kata sandi" 
        : "Tampilkan kata sandi");
    });
  });
});



