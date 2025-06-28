// Start Section show group modal

function showCustomModal(grenade, map) {
    const modal = document.getElementById("custom-modal");
    const groupTableBody = document.getElementById("group-table-body");

    // Show modal
    modal.classList.add("modal-show");

    // Czyszczenie poprzednich danych
    groupTableBody.innerHTML = "";

    // ******
    // EDIT FETCH
    // ******

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

    // Cancel modal section
    const cancelButton = document.getElementById("modal-cancel");

    cancelButton.onclick = function () {
        modal.classList.remove("modal-show");
    };
}

export { showCustomModal };
// End section show group modal

// Start Section add group

const group_add = document.getElementById('group_add');
const group_add_btn = document.getElementById('group_add_btn');

group_add_btn.addEventListener('click', () => {
  group_add.hidden = true; // ukrywa element
});


document.getElementById('add-group-form').addEventListener('submit', function (e) {
    e.preventDefault(); 
    console.log('submit event triggered');

    const form = e.target;
    const formData = new FormData(form);

    fetch('/cs2/public/index.php/grenade-group', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        
    })
    .catch(error => {
        
    });
});

// End Section add group

