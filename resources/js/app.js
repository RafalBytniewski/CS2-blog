// app.js
import 'bootstrap';
import './bootstrap';

// Import jQuery
import $ from "jquery"; 
window.$ = window.jQuery = $;

import '../sass/app.scss';

// immport fontawesome
import '@fortawesome/fontawesome-free/css/all.min.css';

// Import zoom.js
import Zooming from 'zooming';
document.addEventListener('DOMContentLoaded', function() {
    new Zooming({
        scaleBase: 3 // Ustawienie scaleBase na 0.5
    }).listen('[data-action="zoom"]');
});
//  import Sweetalert2
import Swal from 'sweetalert2';
window.Swal = Swal;

// import leaflet.js

import 'leaflet/dist/leaflet.css';
import L from 'leaflet';

// Kod inicjalizujący Leaflet
document.addEventListener('DOMContentLoaded', function () {
    var map = L.map('map').setView([51.505, -0.09], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([51.5, -0.09]).addTo(map)
        .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
        .openPopup();
});


