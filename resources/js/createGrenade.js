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
// visibility of source type handle section
// ##########################

const imagesDiv = document.querySelector('#images_div');
const twitchDiv = document.querySelector('#twitch_div');
const youTubeDiv = document.querySelector('#youtube_div');

const imagesRadio = document.querySelector('#images_radio');
const twitchRadio = document.querySelector('#twitch_radio');
const youTubeRadio = document.querySelector('#youtube_radio');

const images = document.querySelector('#images');
const youTubePath = document.querySelector('#youtube_path');
const twitchPath = document.querySelector('#twitch_path');

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
        if (twitchRadio.checked) {
            twitchDiv.style.display = '';
            twitchPath.setAttribute('required', true);
        } else {
            twitchDiv.style.display = 'none';
            twitchPath.removeAttribute('required');
        }
    });
});
