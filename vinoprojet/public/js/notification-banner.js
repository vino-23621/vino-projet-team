const closeBtn = document.querySelector('[data-js="notification-close"]');
const notificationBanner = document.querySelector('[data-js="notification-banner"]');

 setTimeout(() => {
   notificationBanner.classList.add('is-hidden');
 }, 4000);

closeBtn.addEventListener("click", () => {
    notificationBanner.classList.add('is-hidden');
});

// setTimeout(() => {
//   notificationBanner.style.display = "none";
// }, 4000);