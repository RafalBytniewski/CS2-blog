// resources/js/sortable.js
document.addEventListener('DOMContentLoaded', function() {
    const imagesList = document.getElementById('images-list');
    const sortable = new Sortable(imagesList, {
        animation: 150, // Animacja przeciągania
        onEnd: (event) => {
            // Aktualizacja kolejności obrazów w bazie danych po zmianie kolejności w interfejsie
            const imageId = event.item.dataset.imageId;
            const newIndex = event.newIndex;
            // Wyślij żądanie AJAX, aby zaktualizować kolejność obrazu w bazie danych
        }
    });
});