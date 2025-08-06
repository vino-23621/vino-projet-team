

const noteModal = document.getElementById("noteModal");
const noteItemId = document.getElementById("noteItemId");
const noteTextarea = document.getElementById("noteTextarea");
const closeNoteBtn = document.getElementById("closeNoteModalBtn");

const openNoteBtns = document.querySelectorAll(".openModalBtnAdd");

openNoteBtns.forEach(btn => {
    btn.addEventListener("click", (e) => {
        e.preventDefault();

        const id = btn.getAttribute('data-id');
        const note = btn.getAttribute('data-note') || '';

        noteItemId.value = id;
        noteTextarea.value = note;

        noteModal.style.display = "block";
    });
});

// Close modal button event
closeNoteBtn.addEventListener("click", () => {
    noteModal.style.display = "none";
});

// Close modal if clicking outside modal box
window.addEventListener("click", (e) => {
    if (e.target === noteModal) {
        noteModal.style.display = "none";
    }
});
