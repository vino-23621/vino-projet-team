// Modale edit
const editModal = document.getElementById("editModal");
const openBtns = document.querySelectorAll(".openModalBtnEdit");
const closeBtn = document.querySelector(".close-btn-edit");
const closeModalBtn = document.getElementById("closeModalBtnEdit");
const editForm = document.getElementById('editForm');
const nameInput = document.getElementById('cellar_name');

openBtns.forEach(btn => {
    btn.addEventListener("click", (e) => {
        e.preventDefault();

        const cellarId = btn.getAttribute('data-id');
        const cellarName = btn.getAttribute('data-name');
        editForm.action = `/cellars/${cellarId}`;
        nameInput.value = cellarName;

        editModal.style.display = "flex";
    });
});

closeBtn.addEventListener("click", () => {
    editModal.style.display = "none";
});

closeModalBtn.addEventListener("click", () => {
    editModal.style.display = "none";
});

window.addEventListener("click", (e) => {
    if (e.target === editModal) {
        editModal.style.display = "none";
    }
});
