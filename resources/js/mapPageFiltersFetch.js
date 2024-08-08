// Pobranie elementu mapy i atrybutu data-map-id
const mapElement = document.getElementById('map');
const map = mapElement.getAttribute('data-map-id');
console.log(map); // Sprawdzanie wartości map

// Pobranie elementu przycisku filtracji
const filterButton = document.querySelector('#filterButton');

// Dodanie nasłuchiwania na kliknięcie przycisku
filterButton.addEventListener("click", filter);

// Funkcja obsługująca kliknięcie przycisku
function filter() {
    // Pobranie zaznaczonych pól wyboru
    const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
    
    // Inicjalizacja obiektu do przechowywania wartości filtrów
    let filters = {};

    // Iteracja po zaznaczonych checkboxach
    checkboxes.forEach((checkbox) => {
        const name = checkbox.name;
        const value = checkbox.value;

        // Jeśli nazwa już istnieje w obiekcie, dodaj wartość
        if (filters[name]) {
            filters[name].push(value);
        } else {
            // W przeciwnym razie, stwórz nową tablicę z aktualną wartością
            filters[name] = [value];
        }
    });

    // Konwersja tablic na ciągi rozdzielone przecinkami
    for (const name in filters) {
        filters[name] = filters[name].join(',');
    }

    // Konwersja obiektu filtrów na ciąg zapytań
    const queryString = new URLSearchParams(filters).toString();

    // Wysłanie danych do kontrolera za pomocą AJAX
    fetch(`/map/${map}/filter?${queryString}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Parsed data:', data);

        // Aktualizacja interfejsu użytkownika z przefiltrowanymi danymi
        updateMapWithFilteredData(data);
    })
    .catch(error => console.error('Error:', error));
}
