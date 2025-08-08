document.addEventListener('DOMContentLoaded', function () {
    const closeButtons = document.querySelectorAll('.close-btn');

    closeButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            const banner = this.closest('.cta-success-banner, .cta-error-banner');
            if (banner) {
                banner.style.display = 'none';
            }
        });
    });
});

