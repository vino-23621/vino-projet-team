const menuToggle = document.querySelector('#nav-main input[type="checkbox"]');

menuToggle.addEventListener('change', () => {
  document.body.style.overflow = menuToggle.checked ? 'hidden' : '';
});
