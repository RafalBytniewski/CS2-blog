function showCustomModal(grenade, map) {
    const modal = document.getElementById("custom-modal");
    const cancelButton = document.getElementById("modal-cancel");
    const groupTableBody = document.getElementById("group-table-body");

    // Pokazujemy modal
    modal.classList.add("modal-show");
    console.log(map);

    // Czyszczenie poprzednich danych
    groupTableBody.innerHTML = "";

    // Pobieranie danych grup dla danej mapy
   fetch(`/cs2/public/index.php/groups-by-map/${map}`)

        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                groupTableBody.innerHTML = `<tr><td class="h1 text-center p-2" colspan="4">Brak grup dla tej mapy.</td></tr>`;
            } else {
                data.forEach(group => {
                    const row = document.createElement("tr");

                    row.innerHTML = `
                        <td>${group.name}</td>
                        <td>${group.map?.name || '-'}</td>
                        <td>${group.grenades_count ?? '-'}</td>
                        <td>
                            <button class="btn btn-primary">Add</button>
                            <button class="btn btn-secondary">Show</button>
                        </td>
                    `;

                    groupTableBody.appendChild(row);
                });
            }
        })
        .catch(error => {
            console.error("Błąd przy pobieraniu grup:", error);
        });

    // Obsługa przycisku Anuluj
    cancelButton.onclick = function () {
        modal.classList.remove("modal-show");
    };
}

export { showCustomModal };
