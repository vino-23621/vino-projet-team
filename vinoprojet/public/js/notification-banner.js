const closeBtn = document.querySelector('[data-js="notification-close"]');
const notificationBanner = document.querySelector('[data-js="notification-banner"]');

closeBtn.addEventListener("click", () => {
    notificationBanner.style.display = "none";
});

setTimeout(() => {
  notificationBanner.style.display = "none";
}, 4000);