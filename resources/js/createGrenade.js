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
// sortable, preview for images and border for image landing spot
// ##########################

document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById("images"); // input typu file
    const previewContainer = document.getElementById("image-preview"); // kontener na podgląd zdjęć

    // Ustawianie pozycji i typu zdjęć
    function updateImagePositionsAndTypes() {
        const items = previewContainer.querySelectorAll(".image-item");
        const total = items.length;

        items.forEach((item, index) => {
            item.dataset.position = index + 1; // ustawiamy pozycję zdjęcia
            item.dataset.type = 'normal'; // domyślny typ to 'normal'

            // Tworzymy label z pozycją jeśli nie istnieje
            let label = item.querySelector(".position-label");
            if (!label) {
                label = document.createElement("div");
                label.className = "position-label";
                label.style.position = "absolute";
                label.style.bottom = "5px";
                label.style.left = "50%";
                label.style.transform = "translateX(-50%)";
                label.style.backgroundColor = "rgba(0, 0, 0, 0.6)";
                label.style.color = "white";
                label.style.fontSize = "12px";
                label.style.padding = "2px 6px";
                label.style.borderRadius = "4px";
                label.style.zIndex = "12";
                item.querySelector(".position-relative").appendChild(label);
            }

            label.textContent = `${index + 1}/${total}`; // ustawiamy tekst labela
        });

        // Ostatnie zdjęcie to 'landing_spot'
        if (total > 0) {
            items[total - 1].dataset.type = 'landing_spot';
        }
    }

    // Dodaje ramkę i napis do ostatniego zdjęcia
    function addBorderToLastImage() {
        let lastImage = document.querySelector("#image-preview .image-item:last-child");
        let borderFrame = document.getElementById("image-border-frame");
        let label = document.getElementById("image-border-label");

        if (!lastImage) {
            if (borderFrame) borderFrame.remove();
            if (label) label.remove();
            return;
        }

        let rect = lastImage.getBoundingClientRect();

        if (!borderFrame) {
            borderFrame = document.createElement("div");
            borderFrame.id = "image-border-frame";
            borderFrame.style.position = "absolute";
            borderFrame.style.border = "3px solid blue";
            borderFrame.style.borderRadius = "5px";
            borderFrame.style.pointerEvents = "none";
            borderFrame.style.zIndex = "10";
            document.body.appendChild(borderFrame);
        }

        if (!label) {
            label = document.createElement("div");
            label.id = "image-border-label";
            label.textContent = "Land Spot";
            label.style.position = "absolute";
            label.style.color = "white";
            label.style.fontSize = "12px";
            label.style.fontWeight = "bold";
            label.style.borderRadius = "4px";
            label.style.zIndex = "11";
            document.body.appendChild(label);
        }

        borderFrame.style.width = `${rect.width - 10}px`;
        borderFrame.style.height = `${rect.height + 10}px`;
        borderFrame.style.top = `${rect.top + window.scrollY - 5}px`;
        borderFrame.style.left = `${rect.left + window.scrollX + 5}px`;

        label.style.top = `${rect.top + window.scrollY - 20}px`;
        label.style.left = `${rect.left + window.scrollX + rect.width / 2 - label.offsetWidth / 2}px`;
    }

    // Obsługa zmiany zdjęć (dodanie)
    imageInput.addEventListener("change", function (event) {
        previewContainer.innerHTML = ""; // wyczyść stare zdjęcia

        Array.from(event.target.files).forEach((file, index) => {
            let reader = new FileReader();
            reader.onload = function (e) {
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
                updateImagePositionsAndTypes();
                addBorderToLastImage();
            };
            reader.readAsDataURL(file); // konwertuje obraz na base64
        });

        // opóźnienie, żeby DOM zdążył się zaktualizować
        setTimeout(() => {
            updateImagePositionsAndTypes();
            addBorderToLastImage();
        }, 300);
    });

    // Obsługa usuwania zdjęcia
    previewContainer.addEventListener("click", function (event) {
        if (event.target.classList.contains("delete-image")) {
            event.target.closest(".image-item").remove();
            setTimeout(() => {
                updateImagePositionsAndTypes();
                addBorderToLastImage();
            }, 100);
        }
    });

    // Gdy zmieniamy rozmiar okna, aktualizujemy ramkę
    window.addEventListener("resize", () => {
        setTimeout(addBorderToLastImage, 100);
    });

    // Obsługa przeciągania zdjęć (Sortable.js)
    new Sortable(previewContainer, {
        animation: 150,
        onEnd: () => {
            updateImagePositionsAndTypes();
            setTimeout(addBorderToLastImage, 100);
        },
    });

    // Inicjalne wywołanie
    addBorderToLastImage();
});

// Funkcja tworzy hidden inputy z pozycjami i typami zdjęć (do przesłania w formularzu)
function updateImageMetaInputs() {
    const metaContainer = document.getElementById("image-meta-container");
    const items = document.querySelectorAll("#image-preview .image-item");

    metaContainer.innerHTML = ""; // usuwa stare inputy

    items.forEach((item, index) => {
        const inputPosition = document.createElement("input");
        inputPosition.type = "hidden";
        inputPosition.name = "positions[]";
        inputPosition.value = index + 1;

        const inputType = document.createElement("input");
        inputType.type = "hidden";
        inputType.name = "types[]";
        inputType.value = index === items.length - 1 ? "landing_spot" : "normal";

        metaContainer.appendChild(inputPosition);
        metaContainer.appendChild(inputType);
    });
}
form.addEventListener("submit", function (e) {
    console.log("SUBMIT intercepted, dodajemy meta inputy");
    updateImageMetaInputs();
});
window.updateImageMetaInputs = updateImageMetaInputs;
