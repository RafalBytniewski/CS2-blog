document.addEventListener('DOMContentLoaded', function() {
    const areaFromSelect = document.querySelector('#area_from');
    const areaToSelect = document.querySelector('#area_to');
    const calloutFromDiv = document.querySelector('#callout_from_div');
    const calloutToDiv = document.querySelector('#callout_to_div');

    areaFromSelect.addEventListener('change', function() {
        const areaId = this.value;
        if (areaId) {
            fetchCallouts('callout_from', areaId);
            calloutFromDiv.removeAttribute('hidden');
        } else {
            calloutFromDiv.setAttribute('hidden', true);
        }
    });

    areaToSelect.addEventListener('change', function() {
        const areaId = this.value;
        if (areaId) {
            fetchCallouts('callout_to', areaId);
            calloutToDiv.removeAttribute('hidden');
        } else {
            calloutToDiv.setAttribute('hidden', true);
        }
    });
});

function fetchCallouts(targetId, areaId) {
    fetch(`/fetch-callouts/${areaId}`)
        .then(response => response.json())
        .then(data => {
            const select = document.querySelector(`#${targetId}`);          
            select.length = 1;
            data.forEach(callout => {
                select.add(new Option(callout.name, callout.id));
            });
        })
        .catch(error => console.error('Error:', error));
}

// ##########################
// visibility and validation for source type handle section
// ##########################

const imagesDiv = document.querySelector('#images_div');
const youTubeDiv = document.querySelector('#youtube_div');

const imagesRadio = document.querySelector('#images_radio');
const youTubeRadio = document.querySelector('#youtube_radio');

const images = document.querySelector('#images');
const youTubePath = document.querySelector('#youtube_path');

// Na starcie sprawdzamy, która opcja jest zaznaczona i pokazujemy odpowiednią sekcję
if (imagesRadio.checked) {
    imagesDiv.style.display = '';
    if (images) {
        images.setAttribute('required', true);
    }
} else if (youTubeRadio.checked) {
    youTubeDiv.style.display = '';
    youTubePath.setAttribute('required', true);
}

// Dodajemy event listener dla inputów, ale w edycji te opcje są zablokowane (disabled), więc ten fragment może nie być potrzebny
const radioButtons = document.querySelectorAll('input[name="source_type"]');

radioButtons.forEach(radio => {
    radio.addEventListener('change', function() {
        if (imagesRadio.checked) {
            imagesDiv.style.display = '';
            images.setAttribute('required', true);
        } else {
            imagesDiv.style.display = 'none';
            images.removeAttribute('required');
        }
        if (youTubeRadio.checked) {
            youTubeDiv.style.display = '';
            youTubePath.setAttribute('required', true);
        } else {
            youTubeDiv.style.display = 'none';
            youTubePath.removeAttribute('required');
        }
    });
});

// ##########################
// sortable and border for image land spot
// ##########################

                
                function addBorderToLastImage() {
                    let lastImage = document.querySelector("#image-preview .image-item:last-child");
                    let borderFrame = document.getElementById("image-border-frame");
                    let label = document.getElementById("image-border-label");
    
                    if (!lastImage) return; // Jeśli nie ma obrazów, nic nie rób
    
                    let rect = lastImage.getBoundingClientRect();
                    
                    // Jeśli ramka już istnieje, przesuwamy ją
                    if (!borderFrame) {
                        borderFrame = document.createElement("div");
                        borderFrame.id = "image-border-frame";
                        borderFrame.style.position = "absolute";
                        borderFrame.style.border = "3px solid blue"; // Kolor ramki
                        borderFrame.style.borderRadius = "5px"; 
                        borderFrame.style.pointerEvents = "none"; // Nie przeszkadza w drag & drop
                        borderFrame.style.zIndex = "10"; // Nad zdjęciami
                        document.body.appendChild(borderFrame);
                    }
    
                    // Jeśli label nie istnieje, dodajemy go
                    if (!label) {
                        label = document.createElement("div");
                        label.id = "image-border-label";
                        label.textContent = "Land Spot";
                        label.style.position = "absolute";
                        label.style.color = "white";
                        label.style.fontSize = "12px";
                        label.style.fontWeight = "bold";
                        label.style.borderRadius = "4px";
                        label.style.zIndex = "11"; // Nad ramką
                        document.body.appendChild(label);
                    }
    
                    // Aktualizujemy pozycję i rozmiar ramki
                    borderFrame.style.width = `${rect.width - 10}px`; // Zmniejszony padding X
                    borderFrame.style.height = `${rect.height + 10}px`; // Zmniejszony padding Y
                    borderFrame.style.top = `${rect.top + window.scrollY - 5}px`; // Wyrównanie
                    borderFrame.style.left = `${rect.left + window.scrollX + 5}px`;
    
                    // Aktualizujemy pozycję etykiety "Land Spot"
                    label.style.top = `${rect.top + window.scrollY - 20}px`; // Nad ramką
                    label.style.left = `${rect.left + window.scrollX + rect.width / 2 - label.offsetWidth / 2}px`; // Wycentrowanie
                }
    
                // Uruchamiamy na starcie i po każdej zmianie
                document.addEventListener("DOMContentLoaded", function() {
                    addBorderToLastImage(); // Sprawdza pozycję na starcie
    
                    document.getElementById("images").addEventListener("change", function() {
                        setTimeout(() => {
                            addBorderToLastImage(); // Aktualizuje ramkę po dodaniu nowego obrazu
                        }, 300);
                    });
                });
    
                document.addEventListener("DOMContentLoaded", function() {
                    let imageInput = document.getElementById("images");
                    let previewContainer = document.getElementById("image-preview");
                
                    imageInput.addEventListener("change", function(event) {
                        previewContainer.innerHTML = ""; // Czyścimy stare podglądy
                        Array.from(event.target.files).forEach((file, index) => {
                            let reader = new FileReader();
                            reader.onload = function(e) {
                                let div = document.createElement("div");
                                div.classList.add("col-md-3", "mb-3", "image-item");
                                div.dataset.index = index;
                                div.innerHTML = `
                                    <div class="position-relative">
                                        <img src="${e.target.result}" class="img-thumbnail">
                                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-image">X</button>
                                    </div>
                                `;
                                previewContainer.appendChild(div);
                            };
                            reader.readAsDataURL(file);
                        });
                    });
                
                    // Obsługa usuwania zdjęć z podglądu
                    previewContainer.addEventListener("click", function(event) {
                        if (event.target.classList.contains("delete-image")) {
                            event.target.closest(".image-item").remove();
                        }
                    });
                
                    // Sortowanie
                    new Sortable(previewContainer, { animation: 150 });
                });
                