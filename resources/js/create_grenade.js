const calloutFromDiv = document.querySelector('#callout_from_div');
const calloutToDiv = document.querySelector('#callout_to_div');

//show 'callout from' field after chose 'area'
document.addEventListener('DOMContentLoaded', function() {
    let selectElement = document.querySelector('#area_from');
    let selectedOptionId;

    selectElement.addEventListener('change', function() {
        let selectedOption = this.options[this.selectedIndex];
        selectedOptionId = selectedOption.value;
        console.log(selectedOptionId);
        if (this.value) {
            calloutFromDiv.removeAttribute('hidden');
        }else {
            calloutFromDiv.setAttribute('hidden', true);
        }
    });
});

//show 'callout to' field after chose 'area'

document.addEventListener('DOMContentLoaded', function() {
    let selectElement = document.querySelector('#area_to');
    let selectedOptionId;

    selectElement.addEventListener('change', function() {
        let selectedOption = this.options[this.selectedIndex];
        selectedOptionId = selectedOption.value;
        console.log(selectedOptionId);
        if (this.value) {
            calloutToDiv.removeAttribute('hidden');
        }else {
            calloutToDiv.setAttribute('hidden', true);
        }
    });
});

