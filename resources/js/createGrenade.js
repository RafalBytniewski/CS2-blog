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
    const btnsContainer = document.getElementById("btnsContainer");
    const btns = document.querySelectorAll(".btns");
    const throwingBtn = document.getElementById('throwingBtn');
    const landingBtn = document.getElementById('landingBtn');
    
    let activeType = null;
    
    btns.forEach(btn => {
        btn.addEventListener("click", function(){
            activeType = btn.getAttribute("data-position");

            if (activeType === 'throwing') {
                throwingBtn.classList.remove('btn-outline-success');
                throwingBtn.classList.add('btn-success');
            } else if (activeType === 'landing') {
                landingBtn.classList.remove('btn-outline-primary');
                landingBtn.classList.add('btn-primary');
            }
        });
    });

    document.addEventListener('click', function (e) {
        if (activeType !== null && e.target.classList.contains('img-thumbnail')) {
                const images = previewContainer.querySelectorAll('.image-item');
                const grenadeImage = e.target.closest('.image-item');
                const imageCaption = grenadeImage.querySelector('.imageCaption')
                if(activeType === 'throwing'){
                    //zrobic obsluge border dla form edit, zrobic warunek dla if(img has multiple && set spot to other img reset data-type), usunac wywlywanie funkcji zostawic tylko na dole
                    //dodać position odrazu do zaldaowanych w edit zdjec i dodac zapis zmian(position i type)
                    for (const img of images) {
                        const imgType = img.getAttribute('data-type');

                        if (imgType === activeType) {
                            img.removeAttribute('data-type');
                            img.querySelector('.imageCaption').innerHTML = '';
                            img.querySelector('.img-thumbnail').style.backgroundColor = '';
                        } else if (imgType === 'landing' && img === grenadeImage) {
                            img.removeAttribute('data-type');
                            img.setAttribute('data-type', 'multiple');
                            e.target.style.backgroundColor = 'yellow';
                            imageCaption.innerHTML = "THROWING AND LANDING SPOT";
                            imageCaption.style.color = 'yellow';
                            throwingBtn.classList.remove('btn-success');
                            throwingBtn.classList.add('btn-outline-success');
                            return;
                        }
                    }
                    grenadeImage.setAttribute("data-type", activeType);
                    imageCaption.innerHTML = "THROWING SPOT";
                    imageCaption.style.color = 'green';
                    e.target.style.backgroundColor = 'green';
                    activeType = null;
                    throwingBtn.innerHTML = "CHANGE THROWING SPOT"
                    throwingBtn.classList.remove('btn-success');
                    throwingBtn.classList.add('btn-outline-success');
                }else if(activeType === 'landing'){
                    for (const img of images) {
                        const imgType = img.getAttribute('data-type');

                        if(img.getAttribute('data-type') === activeType){
                            img.removeAttribute('data-type');
                            img.querySelector('.imageCaption').innerHTML = '';
                            img.querySelector('.img-thumbnail').style.backgroundColor = '';
                        } else if (imgType === 'throwing' && img === grenadeImage) {
                            img.removeAttribute('data-type');
                            img.setAttribute('data-type', 'multiple');
                            e.target.style.backgroundColor = 'yellow';
                            imageCaption.innerHTML = "THROWING AND LANDING SPOT";
                            imageCaption.style.color = 'yellow';
                            landingBtn.classList.remove('btn-primary');
                            landingBtn.classList.add('btn-outline-primary');
                            return;
                        }
                    }
                    grenadeImage.setAttribute("data-type", activeType);
                    imageCaption.innerHTML = "LANDING SPOT";
                    imageCaption.style.color = 'blue';
                    e.target.style.backgroundColor = 'blue'
                    activeType = null;
                    landingBtn.innerHTML = "CHANGE LANDING SPOT"
                    landingBtn.classList.remove('btn-primary');
                    landingBtn.classList.add('btn-outline-primary');
                }
        }
    });
    const existingImages = previewContainer.querySelectorAll('.image-item');

    existingImages.forEach(img => {
        const type = img.getAttribute('data-type');
        const thumbnail = img.querySelector('.img-thumbnail');
        const caption = img.querySelector('.imageCaption');

        if (!thumbnail || !type) return;

        if (type === 'throwing') {
            thumbnail.style.backgroundColor = 'green';
            caption.textContent = 'THROWING SPOT';
            caption.style.color = 'green';
        } else if (type === 'landing') {
            thumbnail.style.backgroundColor = 'blue';
            caption.textContent = 'LANDING SPOT';
            caption.style.color = 'blue';
        } else if (type === 'multiple') {
            thumbnail.style.backgroundColor = 'yellow';
            caption.textContent = 'THROWING AND LANDING SPOT';
            caption.style.color = 'yellow';
        }
    });
    // update position and type of image
    function updateImagePositionsAndTypes(container) {
        container = container || document.getElementById("image-preview");
        const items = container.querySelectorAll(".image-item");
        const total = items.length;
    
        items.forEach((item, index) => {
            item.dataset.position = index + 1;
           
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
        const files = Array.from(event.target.files);
    
        if (files.length > 0) {
            btnsContainer.style.display = "flex"; // 👈 pokazuje przyciski
        }
        Array.from(event.target.files).forEach((file, index) => {
            let reader = new FileReader();
            reader.onload = function (e) {
                let div = document.createElement("div");
                div.classList.add("col-md-6", "mb-3", "image-item");
                div.dataset.index = index;
                div.innerHTML = `
                <div class="text-center mt-1 imageCaption" style="font-weight: bold"></div>
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

    // delete image handlig !!!!!!!!!!!!!!!!!!!!!!!!!!!ADD DELETING IMAGES FROM INPUT DB!!!!!!!!!!!!!!!!!!!!
    previewContainer.addEventListener("click", function (event) {
        if (event.target.classList.contains("delete-image")) {
            event.target.closest(".image-item").remove();
            setTimeout(() => {
                updateImagePositionsAndTypes();
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


// HANDLE IMAGE INPUT TYPE
function updateImageMetaInputs(container = document.getElementById("image-preview")) {
    const metaContainer = document.getElementById("image-meta-container");
    const items = container.querySelectorAll(".image-item");

    metaContainer.innerHTML = "";

    items.forEach((item) => {

        const type = item.dataset.type || 'normal';
        const position = item.dataset.position || '1';

        const inputType = document.createElement("input");
        inputType.type = "hidden";
        inputType.name = "types[]";
        inputType.value = type;
        metaContainer.appendChild(inputType);

        const inputPosition = document.createElement("input");
        inputPosition.type = "hidden";
        inputPosition.name = "positions[]";
        inputPosition.value = position;
        metaContainer.appendChild(inputPosition);
    });
}

// ######################################################################################

document.getElementById("submit-button").addEventListener("click", function () {
    updateImageMetaInputs();
});

// SHOW BTNS AFTER ADDING IMAGES BY FORM 

if (previewContainer.querySelectorAll('.image-item').length > 0) {
    btnsContainer.style.display = "flex";
}




