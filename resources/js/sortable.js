
document.addEventListener('DOMContentLoaded', function() {
    const imagesList = document.getElementById('images-list');
    const sortable = new Sortable(imagesList, {
        animation: 150,
        onEnd: (event) => {
            const imageId = event.item.dataset.imageId;
            const newIndex = event.newIndex;
        }
    });
});