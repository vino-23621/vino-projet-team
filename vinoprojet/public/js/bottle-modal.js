// Modale Supprimer
const modal = document.getElementById("customModal");
const openBtns = document.querySelectorAll(".openModalBtnBottle");
const closeBtn = document.querySelector(".close-btn");
const closeModalBtn = document.getElementById("closeModalBtn");
const deleteForm = document.getElementById('deleteForm');

openBtns.forEach(btn => {
    btn.addEventListener("click", (e) => {
        e.preventDefault();

        const cellarId = btn.getAttribute('data-cellar');
        const bottleId = btn.getAttribute('data-id')

        deleteForm.action = `/cellars/${cellarId}/show/${bottleId}`;

        modal.style.display = "flex";
    });
});

closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
});

closeModalBtn.addEventListener("click", () => {
    modal.style.display = "none";
});

window.addEventListener("click", (e) => {
    if (e.target === modal) {
        modal.style.display = "none";
    }
});
