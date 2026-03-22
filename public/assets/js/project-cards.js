document.addEventListener("DOMContentLoaded", function() {
  document.querySelectorAll(".project-card").forEach(function(card) {
    const imageContainer = card.querySelector(".project-card-image");
    const shineOverlay = card.querySelector(".shine-overlay");
    let isHovered = false;

    card.addEventListener("mouseenter", function() { isHovered = true; });
    card.addEventListener("mouseleave", function() {
      isHovered = false;
      imageContainer.style.transform = "perspective(800px) rotateX(0deg) rotateY(0deg) scale(1)";
      imageContainer.style.transition = "transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)";
      if (shineOverlay) shineOverlay.style.background = "none";
    });
    card.addEventListener("mousemove", function(e) {
      if (!isHovered) return;
      const rect = card.getBoundingClientRect();
      const x = (e.clientX - rect.left) / rect.width - 0.5;
      const y = (e.clientY - rect.top) / rect.height - 0.5;
      const tiltX = y * -6, tiltY = x * 6;
      imageContainer.style.transform = "perspective(800px) rotateX(" + tiltX + "deg) rotateY(" + tiltY + "deg) scale(1.02)";
      imageContainer.style.transition = "transform 0.15s ease-out";
      if (shineOverlay) {
        shineOverlay.style.background = "radial-gradient(circle at " + ((tiltY/6+0.5)*100) + "% " + ((tiltX/-6+0.5)*100) + "%, rgba(255,255,255,0.15) 0%, transparent 60%)";
      }
    });
  });
});
