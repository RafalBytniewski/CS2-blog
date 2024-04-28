// app.js
import 'bootstrap';
import './bootstrap';

// Import jQuery
import $ from "jquery"; 
window.$ = window.jQuery = $;

import '../sass/app.scss';

// Import zoom.js
import Zooming from 'zooming';
document.addEventListener('DOMContentLoaded', function() {
    new Zooming({
        scaleBase: 3 // Ustawienie scaleBase na 0.5
    }).listen('[data-action="zoom"]');
});

import Swal from 'sweetalert2';
window.Swal = Swal;