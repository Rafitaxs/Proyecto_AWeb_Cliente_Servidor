document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".card").forEach(card => {
        card.style.opacity = "0";
        setTimeout(() => {
            card.style.transition = "opacity 0.8s ease";
            card.style.opacity = "1";
        }, 200);
    });
});
