document.addEventListener('DOMContentLoaded', function() {
    let areaFromSelects = document.querySelectorAll('.areaFromSelect');
    let areaToSelects = document.querySelectorAll('.areaToSelect');
    let calloutsFromSection = document.querySelector('#calloutsFromSection');
    let calloutsToSection = document.querySelector('#calloutsToSection');
    let selectedAreaFromIds = [];
    let selectedAreaToIds = [];

    areaFromSelects.forEach(function(areaSelect) {
        areaSelect.addEventListener('change', function() {
            let areaFromId = this.value;
            if (this.checked && !selectedAreaFromIds.includes(areaFromId)) {
                selectedAreaFromIds.push(areaFromId);
            } else if (!this.checked && selectedAreaFromIds.includes(areaFromId)) {
                selectedAreaFromIds = selectedAreaFromIds.filter(id => id !== areaFromId);
            }
            
            if (selectedAreaFromIds.length > 0) {
                fetchCallouts(selectedAreaFromIds, calloutsFromSection, 'from');
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
                fetchCallouts(selectedAreaToIds, calloutsToSection, 'to');
            } else {
                calloutsToSection.classList.add('d-none');
            }
        });
    });

    function fetchCallouts(areaIds, calloutsSection, type) {
        let promises = areaIds.map(areaId => fetch('/fetch_callouts/' + areaId).then(response => response.json()));
        Promise.all(promises)
            .then(calloutsData => {
                let allCallouts = calloutsData.flat().map(callout => {
                    callout.type = type;
                    return callout;
                });
                renderCallouts(allCallouts, calloutsSection, type);
            })
            .catch(error => console.error('Błąd:', error));
    }

    function renderCallouts(callouts, calloutsSection, type) {
        let calloutsContainer = calloutsSection.querySelector('.card-body');
        calloutsContainer.innerHTML = '';

        callouts.forEach(callout => {
            let label = document.createElement('label');
            label.classList.add('form-check');
            label.innerHTML = `
                <input class="form-check-input" name="callout_${type}_id" type="checkbox" value="${callout.id}">
                <span id="${callout.id}" class="form-check-label">${callout.name}</span>
            `;
            calloutsContainer.appendChild(label);
        });

        calloutsSection.classList.remove('d-none');
    }
});
