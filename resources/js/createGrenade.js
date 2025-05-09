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

document.addEventListener('DOMContentLoaded', function () {
    const hasExistingImages = document.querySelectorAll('#image-preview .image-item').length > 0;

    if (imagesRadio.checked) {
        imagesDiv.style.display = '';
        if (!hasExistingImages) {
            images.setAttribute('required', true);
        } else {
            images.removeAttribute('required');
        }
    } else if (youTubeRadio.checked) {
        youTubeDiv.style.display = '';
        youTubePath.setAttribute('required', true);
    }
});

radioButtons.forEach(radio => {
    radio.addEventListener('change', function () {
        const hasExistingImages = document.querySelectorAll('#image-preview .image-item').length > 0;

        if (imagesRadio.checked) {
            imagesDiv.style.display = '';
            if (!hasExistingImages) {
                images.setAttribute('required', true);
            } else {
                images.removeAttribute('required');
            }
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
    const imageInput = document.getElementById("images");
    const previewContainer = document.getElementById("image-preview"); 
   
    // SET THROWING AND LANDING SPOT BORDER
    const throwingBtn = document.getElementById('throwingBtn');
    const landingBtn = document.getElementById('landingBtn');
    const btns = document.querySelectorAll('.btns')

    btns.forEach(btn => {
        btn.addEventListener('click', function () {
            if(btn === throwingBtn){
                btn.classList.toggle('active');
                btn.innerHTML = "THROWING SPOT <i class='fa-regular fa-pen-to-square'></i>"
                document.addEventListener('click', function(e) {
                    if (e.target.classList.contains('img-thumbnail')) {
                        e.target.style.backgroundColor = 'green';
                        e.target.setAttribute('data-type', 'throwing-spot');
                        btn.innerHTML = "THROWING SPOT <i class='fa-regular fa-square-check'></i>"
                        if(e.target.getAttribute('data-type') === 'landing-spot'){
                            e.target.setAttribute('data-type', 'multiple');
                            e.target.style.backgroundColor = 'yellow';
                        }
                    }
                });
            }else if(btn === landingBtn){
                btn.classList.toggle('active');
                btn.innerHTML = "THROWING SPOT <i class='fa-regular fa-pen-to-square'></i>"
                document.addEventListener('click', function(e) {
                    if (e.target.classList.contains('img-thumbnail')) {
                        e.target.style.backgroundColor = 'blue';
                        e.target.setAttribute('data-type', 'landing-spot');
                        btn.innerHTML = "LANDING SPOT <i class='fa-regular fa-square-check'></i>"
                        if(e.target.getAttribute('data-type') === 'throwing-spot'){
                            e.target.setAttribute('data-type', 'multiple');
                            e.target.style.backgroundColor = 'yellow';
                        }
                    }
                });
            }
        });
    });

    // update position and type of image
    function updateImagePositionsAndTypes(container) {
        container = container || document.getElementById("image-preview");
        const items = container.querySelectorAll(".image-item");
        const total = items.length;
    
        items.forEach((item, index) => {
            item.dataset.position = index + 1;
            item.dataset.type = 'normal';
    
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
    
            label.textContent = `${index + 1}/${total}`;
        });
    }
    
    // image add and edit handle
    imageInput.addEventListener("change", function (event) {
        previewContainer.innerHTML = "";

        Array.from(event.target.files).forEach((file, index) => {
            let reader = new FileReader();
            reader.onload = function (e) {
                let div = document.createElement("div");
                div.classList.add("col-md-6", "mb-3", "image-item");
                div.dataset.index = index;
                div.innerHTML = `
                    <div class="position-relative">
                        <img src="${e.target.result}" class="img-thumbnail">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-image">X</button>
                    </div>
                `;
                previewContainer.appendChild(div);
                updateImagePositionsAndTypes();
                updateImageMetaInputs();
            };
            reader.readAsDataURL(file);
        });
    });

    // delete image handlig !!!!!!!!!!!!!!!!!!!!!!!!!!!ADD DELETING IMAGES FROM INPUT!!!!!!!!!!!!!!!!!!!!
    previewContainer.addEventListener("click", function (event) {
        if (event.target.classList.contains("delete-image")) {
            event.target.closest(".image-item").remove();
            setTimeout(() => {
                updateImagePositionsAndTypes();
                addBorderToLastImage();
                updateImageMetaInputs();
            }, 100);
        }
    });

    new Sortable(previewContainer, {
        animation: 150,
        onEnd: () => {
            setTimeout(() => {
                updateImagePositionsAndTypes();
                updateImageMetaInputs();
            },100)
        },
    });
});


/* // HANDLE IMAGE INPUT TYPE
function updateImageMetaInputs(container = document.getElementById("image-preview")) {
    const metaContainer = document.getElementById("image-meta-container");
    const items = container.querySelectorAll(".image-item");

    metaContainer.innerHTML = "";

    items.forEach((item, index) => {
        const inputType = document.createElement("input");
        inputType.type = "hidden";
        inputType.name = "types[]";
        inputType.value = item.dataset.type === 'landing_spot' ? 'landing_spot' : 'normal';
        metaContainer.appendChild(inputType);
    });
} */





