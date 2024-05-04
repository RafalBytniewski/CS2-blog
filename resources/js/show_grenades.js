document.addEventListener('DOMContentLoaded', function() {
    let areaFromSelects = document.querySelectorAll('.areaFromSelect');
    let areaToSelects = document.querySelectorAll('.areaToSelect');
    let calloutsFromSection = document.querySelector('#calloutsFromSection');
    let calloutsToSection = document.querySelector('#calloutsToSection');
    let selectedAreaFromIds = [];
    let selectedAreaToIds = [];
    let selectedCalloutFromIds = []; // Dodane tablice na wybrane id calloutFrom i calloutTo
    let selectedCalloutToIds = [];

    areaFromSelects.forEach(function(areaSelect) {
        areaSelect.addEventListener('change', function() {
            let areaFromId = this.value;
            if (this.checked && !selectedAreaFromIds.includes(areaFromId)) {
                selectedAreaFromIds.push(areaFromId);
            } else if (!this.checked && selectedAreaFromIds.includes(areaFromId)) {
                selectedAreaFromIds = selectedAreaFromIds.filter(id => id !== areaFromId);
            }
            
            if (selectedAreaFromIds.length > 0) {
                fetchCallouts(selectedAreaFromIds, calloutsFromSection, 'calloutFrom');
            } else {
                calloutsFromSection.classList.add('d-none');
            }
        });
    });

    areaToSelects.forEach(function(areaSelect) {
        areaSelect.addEventListener('change', function() {
            let areaToId = this.value;
            if (this.checked && !selectedAreaToIds.includes(areaToId)) {
                selectedAreaToIds.push(areaToId);
            } else if (!this.checked && selectedAreaToIds.includes(areaToId)) {
                selectedAreaToIds = selectedAreaToIds.filter(id => id !== areaToId);
            }
            
            if (selectedAreaToIds.length > 0) {
                fetchCallouts(selectedAreaToIds, calloutsToSection, 'calloutTo');
            } else {
                calloutsToSection.classList.add('d-none');
            }
        });
    });

    function fetchCallouts(areaIds, calloutsSection, calloutType) {
        let promises = areaIds.map(areaId => fetch('/fetch_callouts/' + areaId).then(response => response.json()));
        Promise.all(promises)
            .then(calloutsData => {
                let allCallouts = calloutsData.flat();
                renderCallouts(allCallouts, calloutsSection, calloutType);
            })
            .catch(error => console.error('Błąd:', error));
    }

    function renderCallouts(callouts, calloutsSection, calloutType) {
        let calloutsContainer = calloutsSection.querySelector('.card-body');
        calloutsContainer.innerHTML = '';

        callouts.forEach(callout => {
            let label = document.createElement('label');
            label.classList.add('form-check');
            label.innerHTML = `
                <input class="form-check-input ${calloutType}Select" name="${calloutType}" type="checkbox" value="${callout.id}">
                <span id="${callout.id}" class="form-check-label">${callout.name}</span>
            `;
            calloutsContainer.appendChild(label);
        });

        calloutsSection.classList.remove('d-none');

        // Obsługa zdarzeń dla calloutFrom i calloutTo
        let calloutSelects = document.querySelectorAll(`.${calloutType}Select`);
        let selectedCalloutIds = (calloutType === 'calloutFrom') ? selectedCalloutFromIds : selectedCalloutToIds;

        calloutSelects.forEach(function(calloutSelect) {
            calloutSelect.addEventListener('change', function() {
                let calloutId = this.value;
                if (this.checked && !selectedCalloutIds.includes(calloutId)) {
                    selectedCalloutIds.push(calloutId);
                } else if (!this.checked && selectedCalloutIds.includes(calloutId)) {
                    selectedCalloutIds = selectedCalloutIds.filter(id => id !== calloutId);
                }
            });
        });
    }
});
