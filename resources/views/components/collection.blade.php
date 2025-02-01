@vite(['resources/js/collection.js'])
<style>
/* Ukrycie modala domyślnie */
.modal-overlay {
    color: black;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
    z-index: 1000; /* Modal na wierzchu */
}

/* Styl treści modala */
.modal-content {
    background: white;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    height: 800px;
    width: 90%;
    max-width: 800px; /* Maksymalna szerokość modala */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    position: relative;
}

/* Pokazywanie modala */
.modal-show {
    opacity: 1;
    visibility: visible;
}

</style>
<!-- Modal -->
<div id="custom-modal" class="modal-overlay">
    <div class="modal-content">
        <h2 id="modal-title">Dodaj do istniejącej kolekcji</h2>
        <div id="modal-body" class="d-flex flex-column justify-content-center">
            <button>Mirage smokes.</button>
            <button>Dust smokes.</button>
            <button>Anubis A execute.</button>
            <button>Nuke Navi wall.</button>
        </div>
        <h2>Stwórz nową kolekcje</h2>
        <button>add</button>
        <div class="modal-buttons">
            <button id="modal-confirm">OK</button>
            <button id="modal-cancel">Anuluj</button>
        </div>
    </div>
</div>