// Modale Supprimer
const editModal = document.getElementById("editModal");
const openBtns = document.querySelectorAll(".openModalBtnEdit");
const closeBtn = document.querySelector(".close-btn-edit");
const closeModalBtn = document.getElementById("closeModalBtnEdit");
const editForm = document.getElementById('editForm');

openBtns.forEach(btn => {
    btn.addEventListener("click", (e) => {
        e.preventDefault();

        const cellarId = btn.getAttribute('data-id');
        editForm.action = `/cellars/${cellarId}`;

        editModal.style.display = "block";
    });
});

closeBtn.addEventListener("click", () => {
    editModal.style.display = "none";
});

closeModalBtn.addEventListener("click", () => {
    editModal.style.display = "none";
});

window.addEventListener("click", (e) => {
    if (e.target === modal) {
        editModal.style.display = "none";
    }
});
