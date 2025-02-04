
function showCustomModal(onConfirm = null) {
    const modal = document.getElementById("custom-modal");
    const confirmButton = document.getElementById("modal-confirm");
    const cancelButton = document.getElementById("modal-cancel");


    // Pokazujemy modal
    modal.classList.add("modal-show");

    // Obsługa przycisku OK
    confirmButton.onclick = function () {
        modal.classList.remove("modal-show");
        if (onConfirm) {
            onConfirm('');
        }
    };

    // Obsługa przycisku Anuluj
    cancelButton.onclick = function () {
        modal.classList.remove("modal-show");
    };
}

// Eksport dla innych plików
export { showCustomModal };