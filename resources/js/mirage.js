// Inicjalizacja mapy Leaflet
var map = L.map('map', {
    crs: L.CRS.Simple,
    minZoom: 0,
    maxZoom: 2,
    attributionControl: false,
    maxBounds: [[0, 0], [750, 750]], // Ustawienie maksymalnych granic mapy
    maxBoundsViscosity: 1.0 // Elastyczne granice mapy
}).setView([375, 375], 0);

// Nakładka obrazu mapy CS:GO
var imageUrl = '/storage/mirage_plan.png', // Zamień na ścieżkę do obrazu mapy CS:GO
    imageBounds = [[0, 0], [750, 750]];

L.imageOverlay(imageUrl, imageBounds).addTo(map);
// dane
var areas = [
    {
        name: 'B',
        bounds: [
            { "lat": 393.75, "lng": 234.75 },
            { "lat": 395.75, "lng": 168 },
            { "lat": 402.25, "lng": 167.25 },
            { "lat": 402.25, "lng": 148.75 },
            { "lat": 394.75, "lng": 148.25 },
            { "lat": 395.25, "lng": 102.25 },
            { "lat": 465, "lng": 103.5 },
            { "lat": 465.5, "lng": 94.75 },
            { "lat": 495.5, "lng": 95.25 },
            { "lat": 501, "lng": 102.5 },
            { "lat": 520.75, "lng": 102.25 },
            { "lat": 521.5, "lng": 60.25 },
            { "lat": 588.75, "lng": 55.75 },
            { "lat": 595.5, "lng": 62.75 },
            { "lat": 595, "lng": 97.5 },
            { "lat": 637.25, "lng": 105 },
            { "lat": 642.25, "lng": 148.25 },
            { "lat": 645.25, "lng": 148.5 },
            { "lat": 645.25, "lng": 174.25 },
            { "lat": 633, "lng": 174.25 },
            { "lat": 632.75, "lng": 180.5 },
            { "lat": 643, "lng": 181.5 },
            { "lat": 643.5, "lng": 199.75 },
            { "lat": 647.25, "lng": 203.75 },
            { "lat": 646.5, "lng": 213.5 },
            { "lat": 646, "lng": 241.25 },
            { "lat": 630.5, "lng": 241.75 },
            { "lat": 637, "lng": 243.75 },
            { "lat": 638.25, "lng": 323 },
            { "lat": 560.75, "lng": 323.5 },
            { "lat": 561, "lng": 297.5 },
            { "lat": 568.25, "lng": 290.25 },
            { "lat": 602.25, "lng": 290.25 },
            { "lat": 609, "lng": 292 },
            { "lat": 610, "lng": 244 },
            { "lat": 616, "lng": 244 },
            { "lat": 616.5, "lng": 241 },
            { "lat": 594.75, "lng": 240.5 },
            { "lat": 594.25, "lng": 284 },
            { "lat": 556.5, "lng": 287.25 },
            { "lat": 556.5, "lng": 322.75 },
            { "lat": 556, "lng": 364.25 }, { "lat": 517.75, "lng": 364.5 }, { "lat": 519, "lng": 327 },
            { "lat": 518.75, "lng": 327.25 },
            { "lat": 520.75, "lng": 239.5 },

            { "lat": 465.5, "lng": 239.75 },
            { "lat": 465.25, "lng": 181.5 },
            { "lat": 461.75, "lng": 182 },
            { "lat": 461.75, "lng": 185.75 },
            { "lat": 450.5, "lng": 186 },
            { "lat": 430, "lng": 197 },
            { "lat": 430.75, "lng": 234.25 }
        ],
        callouts: [
            {
                name: 'backsite',
                lat: 505,
                lon: 156,
                transform: '',
                sizeFactor: 1,
            },
            {
                name: 'bench',
                lat: 557,
                lon: 79,
                transform: 'rotate(90deg)',
                sizeFactor: 1.2,
            },
            {
                name: 'kitchen',
                lat: 420,
                lon: 165,
                transform: '',
                sizeFactor: 1.7,
            },
            {
                name: 'window',
                lat: 460,
                lon: 175,
                transform: '',
                sizeFactor: 0.7,
            },
            {
                name: 'door',
                lat: 463,
                lon: 113,
                transform: 'rotate(90deg)',
                sizeFactor: 1,
            },
            {
                name: 'default',
                lat: 571,
                lon: 162,
                transform: '',
                sizeFactor: 0.8,
            },
            {
                name: 'site',
                lat: 550,
                lon: 153,
                transform: '',
                sizeFactor: 1.5,
            },
            {
                name: 'balcony',
                lat: 625,
                lon: 160,
                transform: 'rotate(90deg)',
                sizeFactor: 0.8,
            },
            {
                name: 'short',
                lat: 543,
                lon: 306,
                transform: '',
                sizeFactor: 1.5,
            },
            {
                name: 'car',
                lat: 619,
                lon: 114,
                transform: '',
                sizeFactor: 0.8,
            },
            {
                name: 'apartments',
                lat: 633,
                lon: 241,
                transform: '',
                sizeFactor: 1.3,
            },
            {
                name: 'edward',
                lat: 578,
                lon: 259,
                transform: '',
                sizeFactor: 1,
            }
        ],
        color: '#7A7A7A',
        tooltipLat: 543,
        tooltipLng: 155.5,
    },
    {
        name: 'CT',
        bounds: [
            { "lat": 394.25, "lng": 206.5 },
            { "lat": 242.75, "lng": 206 },
            { "lat": 232.5, "lng": 196.75 },
            { "lat": 232, "lng": 157.25 },
            { "lat": 186.5, "lng": 156.5 },
            { "lat": 184.75, "lng": 200.75 },
            { "lat": 125.5, "lng": 231.5 },
            { "lat": 124.25, "lng": 240.25 },
            { "lat": 90.75, "lng": 341 },
            { "lat": 157.75, "lng": 322 },
            { "lat": 158, "lng": 262 },
            { "lat": 174, "lng": 262 },
            { "lat": 178.25, "lng": 252.25 },
            { "lat": 247.25, "lng": 250.5 },
            { "lat": 247, "lng": 260.75 },
            { "lat": 267, "lng": 260.5 },
            { "lat": 266.75, "lng": 242.75 },
            { "lat": 318.75, "lng": 246.75 },
            { "lat": 319.75, "lng": 267.75 },
            { "lat": 377, "lng": 265.5 },
            { "lat": 377.25, "lng": 251.5 },
            { "lat": 389, "lng": 250.5 },
            { "lat": 389.5, "lng": 232.75 },
            { "lat": 393.5, "lng": 233.5 }
        ],
        callouts: [
            {
                name: 'spawn',
                lat: 213,
                lon: 202,
                transform: '',
                sizeFactor: 1.3,
            }
        ],
        color: '#7A7A7A',
        tooltipLat: 500,
        tooltipLng: 500,
    },
    {
        name: 'T',
        bounds: [
            { "lat": 557.75, "lng": 544.25 },
            { "lat": 554.5, "lng": 515.25 },
            { "lat": 597, "lng": 510.5 },
            { "lat": 597.5, "lng": 501 },
            { "lat": 613.25, "lng": 500.75 },
            { "lat": 617.75, "lng": 516.25 },
            { "lat": 617.5, "lng": 564.75 },
            { "lat": 624, "lng": 564.25 },
            { "lat": 624.5, "lng": 534.75 },
            { "lat": 626.5, "lng": 500.75 },
            { "lat": 623.5, "lng": 498.5 },
            { "lat": 624, "lng": 462.75 },
            { "lat": 625.5, "lng": 458.25 },
            { "lat": 601.5, "lng": 457 },
            { "lat": 560, "lng": 458 },
            { "lat": 560.5, "lng": 324.25 },
            { "lat": 606.75, "lng": 324 },
            { "lat": 607.5, "lng": 400.25 },
            { "lat": 613.75, "lng": 402.25 },
            { "lat": 649.25, "lng": 402 },
            { "lat": 650.25, "lng": 457 },
            { "lat": 646.5, "lng": 460.25 },
            { "lat": 648, "lng": 463.75 },
            { "lat": 649.5, "lng": 584.25 },
            { "lat": 623.75, "lng": 585.25 },
            { "lat": 624, "lng": 577.25 },
            { "lat": 617.75, "lng": 577.25 },
            { "lat": 618, "lng": 639 },
            { "lat": 612.5, "lng": 660.25 },
            { "lat": 590.25, "lng": 661.5 },
            { "lat": 590.75, "lng": 665.75 },
            { "lat": 591.5, "lng": 695.75 },
            { "lat": 521.25, "lng": 695.75 },
            { "lat": 521, "lng": 705.75 },
            { "lat": 493.75, "lng": 705.75 },
            { "lat": 494, "lng": 710.5 },
            { "lat": 472.75, "lng": 711.25 },
            { "lat": 472.75, "lng": 705.75 },
            { "lat": 440, "lng": 706 },
            { "lat": 433, "lng": 700.75 },
            { "lat": 399, "lng": 699.25 },
            { "lat": 396.25, "lng": 702.5 },
            { "lat": 378.75, "lng": 702.75 },
            { "lat": 378.75, "lng": 699.5 },
            { "lat": 343.75, "lng": 700.25 },
            { "lat": 306.75, "lng": 702.5 },
            { "lat": 306.25, "lng": 699 },
            { "lat": 271.25, "lng": 699.25 },
            { "lat": 271.25, "lng": 639.5 },
            { "lat": 232, "lng": 639.75 },
            { "lat": 232.25, "lng": 650 },
            { "lat": 131.5, "lng": 650 },
            { "lat": 128.25, "lng": 549.25 },
            { "lat": 134, "lng": 548.75 },
            { "lat": 134.5, "lng": 540.25 },
            { "lat": 130, "lng": 539.5 },
            { "lat": 130.5, "lng": 498.25 },
            { "lat": 150.5, "lng": 497.75 },
            { "lat": 150.5, "lng": 519.25 },
            { "lat": 200.75, "lng": 520 },
            { "lat": 201, "lng": 546.75 },
            { "lat": 203.75, "lng": 547.5 },
            { "lat": 204.75, "lng": 568 },
            { "lat": 201.25, "lng": 568 },
            { "lat": 200.75, "lng": 575 },
            { "lat": 204, "lng": 575.75 },
            { "lat": 204.75, "lng": 596.75 },
            { "lat": 201, "lng": 597 },
            { "lat": 201.25, "lng": 619.25 },
            { "lat": 201.25, "lng": 619 },
            { "lat": 291.75, "lng": 620.25 },
            { "lat": 292, "lng": 678.25 },
            { "lat": 307, "lng": 677.75 },
            { "lat": 307.25, "lng": 610 },
            { "lat": 233, "lng": 610 },
            { "lat": 234, "lng": 555.5 },
            { "lat": 266.75, "lng": 554.75 },
            { "lat": 266, "lng": 563 },
            { "lat": 333.5, "lng": 567.5 },
            { "lat": 333.75, "lng": 587.25 },
            { "lat": 348.25, "lng": 586.75 },
            { "lat": 349, "lng": 644.75 },
            { "lat": 353.25, "lng": 647.75 },
            { "lat": 463.5, "lng": 649.25 },
            { "lat": 464.75, "lng": 644.25 },
            { "lat": 474.75, "lng": 644.25 },
            { "lat": 477.75, "lng": 646.5 },
            { "lat": 529.5, "lng": 647.25 },
            { "lat": 529, "lng": 650.25 },
            { "lat": 545.5, "lng": 649.5 },
            { "lat": 546.25, "lng": 640.25 },
            { "lat": 560, "lng": 639.75 },
            { "lat": 572.25, "lng": 627.25 },
            { "lat": 573, "lng": 559.5 },
            { "lat": 558.25, "lng": 544.75 }
        ],
        callouts: [
            {
                name: 'spawn',
                lat: 491,
                lon: 674,
                transform: '',
                sizeFactor: 1.2,
            },
            {
                name: 'stairs',
                lat: 608,
                lon: 600,
                transform: '',
                sizeFactor: 1,
            },
            {
                name: 'palace',
                lat: 170,
                lon: 573,
                transform: '',
                sizeFactor: 1.5,
            },
            {
                name: 'in front</br>of ramp',
                lat: 341,
                lon: 629,
                transform: '',
                sizeFactor: 1,
            },
            {
                name: 'roof',
                lat: 274,
                lon: 603,
                transform: 'rotate(90deg)',
                sizeFactor: 1,
            },
            {
                name: 'appartments',
                lat: 617,
                lon: 431,
                transform: 'rotate(-30deg)',
                sizeFactor: 1.2,
            }
        ],
        color: '#7A7A7A',
        tooltipLat: 500,
        tooltipLng: 500,
    },
    {
        name: 'Mid',
        bounds: [
            { "lat": 362.5, "lng": 267.5 },
            { "lat": 362, "lng": 278.75 },
            { "lat": 375.5, "lng": 279.25 },
            { "lat": 376, "lng": 288.5 },
            { "lat": 385, "lng": 288 },
            { "lat": 385.5, "lng": 278.5 },
            { "lat": 438.25, "lng": 279 },
            { "lat": 438.75, "lng": 287.25 },
            { "lat": 501.25, "lng": 287.25 },
            { "lat": 502.5, "lng": 331.5 },
            { "lat": 518.5, "lng": 332.25 },
            { "lat": 517.25, "lng": 364.5 },
            { "lat": 500.25, "lng": 364.75 },
            { "lat": 483, "lng": 362.75 },
            { "lat": 456, "lng": 378.75 },
            { "lat": 457, "lng": 470.75 },
            { "lat": 471.75, "lng": 503 },
            { "lat": 531.75, "lng": 501.5 },
            { "lat": 532.25, "lng": 515.5 },
            { "lat": 542.75, "lng": 514.25 },
            { "lat": 542.5, "lng": 502.75 },
            { "lat": 553.75, "lng": 502.5 },
            { "lat": 553.75, "lng": 515.75 },
            { "lat": 557.25, "lng": 544.25 },
            { "lat": 499.75, "lng": 544.75 },
            { "lat": 493.5, "lng": 550.75 },
            { "lat": 494.25, "lng": 561 },
            { "lat": 357, "lng": 561.25 },
            { "lat": 358, "lng": 416.5 },
            { "lat": 380, "lng": 415.5 },
            { "lat": 379.75, "lng": 384 },
            { "lat": 375.25, "lng": 384.5 },
            { "lat": 375.25, "lng": 388.5 },
            { "lat": 354.5, "lng": 389.5 },
            { "lat": 354, "lng": 398.25 },
            { "lat": 336.75, "lng": 399 },
            { "lat": 341, "lng": 348.5 },
            { "lat": 374.5, "lng": 348.5 },
            { "lat": 375, "lng": 363.25 },
            { "lat": 380.25, "lng": 363 },
            { "lat": 380.25, "lng": 307.75 },
            { "lat": 394.75, "lng": 306.75 },
            { "lat": 394.25, "lng": 304 },
            { "lat": 320, "lng": 305 },
            { "lat": 316, "lng": 295.25 },
            { "lat": 315, "lng": 279.25 },
            { "lat": 319.5, "lng": 269.75 }
        ],
        callouts: [
            {
                name: 'top mid',
                lat: 410,
                lon: 501,
                transform: 'rotate(90deg)',
                sizeFactor: 1.3,
            },
            {
                name: 'under window',
                lat: 415,
                lon: 311,
                transform: 'rotate(90deg)',
                sizeFactor: 0.9,
            },
            {
                name: 'boxes',
                lat: 407,
                lon: 528,
                transform: 'rotate(90deg)',
                sizeFactor: 1,
            },
            {
                name: 'short',
                lat: 452,
                lon: 370,
                transform: 'rotate(45deg)',
                sizeFactor: 1.2,
            },
            {
                name: 'ladder</br>room',
                lat: 493,
                lon: 305,
                transform: '',
                sizeFactor: 0.8,
            },
            {
                name: 'window',
                lat: 413,
                lon: 291,
                transform: 'rotate(90deg)',
                sizeFactor: 0.9,
            },
            {
                name: 'conn',
                lat: 361,
                lon: 369,
                transform: '',
                sizeFactor: 1,
            },
            {
                name: 'chair',
                lat: 369,
                lon: 436,
                transform: '',
                sizeFactor: 1,
            },
            {
                name: 'elbow',
                lat: 496,
                lon: 525,
                transform: 'rotate(90deg)',
                sizeFactor: 1.1,
            },
            {
                name: 'start',
                lat: 442,
                lon: 464,
                transform: '',
                sizeFactor: 1,
            }
        ],
        color: '#7A7A7A',
        tooltipLat: 500,
        tooltipLng: 500,

    },
    {
        name: 'A',
        bounds: [
            { "lat": 99.75, "lng": 339.5 },
            { "lat": 153.75, "lng": 324 },
            { "lat": 153.75, "lng": 337.25 },
            { "lat": 160.5, "lng": 352.25 },
            { "lat": 175.25, "lng": 352.25 },
            { "lat": 176.25, "lng": 347.5 },
            { "lat": 241, "lng": 347.5 },
            { "lat": 241.5, "lng": 351.5 },
            { "lat": 256.25, "lng": 351.75 },
            { "lat": 263.5, "lng": 338 },
            { "lat": 264, "lng": 300.5 },
            { "lat": 274.25, "lng": 299.5 },
            { "lat": 274, "lng": 289.5 },
            { "lat": 265, "lng": 289.5 },
            { "lat": 264, "lng": 274 },
            { "lat": 314.25, "lng": 275.25 },
            { "lat": 315.25, "lng": 299.75 },
            { "lat": 305, "lng": 300 },
            { "lat": 305.25, "lng": 325 },
            { "lat": 295.5, "lng": 325.75 },
            { "lat": 295.5, "lng": 337.25 },
            { "lat": 304, "lng": 336.75 },
            { "lat": 305.25, "lng": 364.75 },
            { "lat": 309, "lng": 364.5 },
            { "lat": 309, "lng": 348.25 },
            { "lat": 329.25, "lng": 348.5 },
            { "lat": 329.5, "lng": 355.25 },
            { "lat": 338.25, "lng": 354.75 },
            { "lat": 336, "lng": 398.75 },
            { "lat": 310.5, "lng": 399.5 },
            { "lat": 309.75, "lng": 385 },
            { "lat": 306.25, "lng": 385 },
            { "lat": 305.25, "lng": 403 },
            { "lat": 271.5, "lng": 403.5 },
            { "lat": 272.75, "lng": 438 },
            { "lat": 270.75, "lng": 452.5 },
            { "lat": 286.75, "lng": 452.75 },
            { "lat": 286, "lng": 553.5 },
            { "lat": 234, "lng": 554.25 },
            { "lat": 233.25, "lng": 519.75 },
            { "lat": 253, "lng": 519.5 },
            { "lat": 253.5, "lng": 509.5 },
            { "lat": 233.25, "lng": 509 },
            { "lat": 233.25, "lng": 488.5 },
            { "lat": 210, "lng": 488.5 },
            { "lat": 208.5, "lng": 504.5 },
            { "lat": 178.5, "lng": 505.25 },
            { "lat": 177.75, "lng": 496.5 },
            { "lat": 131, "lng": 497.5 },
            { "lat": 131.25, "lng": 478.75 },
            { "lat": 163, "lng": 478 },
            { "lat": 163.75, "lng": 464.25 },
            { "lat": 127.75, "lng": 464.25 },
            { "lat": 129, "lng": 418.75 },
            { "lat": 135.75, "lng": 414.5 },
            { "lat": 128.5, "lng": 405.25 },
            { "lat": 101.75, "lng": 350.25 }
        ],
        callouts: [
            {
                name: 'jungle',
                lat: 288,
                lon: 305,
                transform: '',
                sizeFactor: 1.2,
            },
            {
                name: 'conn',
                lat: 323,
                lon: 371,
                transform: '',
                sizeFactor: 1,
            },
            {
                name: 'stairs',
                lat: 285,
                lon: 396,
                transform: 'rotate(90deg)',
                sizeFactor: 1.1,
            },
            {
                name: 'site',
                lat: 160,
                lon: 398,
                transform: '',
                sizeFactor: 1.5,
            },
            {
                name: 'default',
                lat: 163,
                lon: 433,
                transform: '',
                sizeFactor: 0.8,
            },
            {
                name: 'firebox',
                lat: 175,
                lon: 363,
                transform: 'rotate(90deg)',
                sizeFactor: 1,
            },
            {
                name: 'ticket',
                lat: 114,
                lon: 341,
                transform: 'rotate(70deg)',
                sizeFactor: 1,
            },
            {
                name: 'wood',
                lat: 193,
                lon: 487,
                transform: '',
                sizeFactor: 1,
            },
            {
                name: 'palace',
                lat: 154,
                lon: 487,
                transform: 'rotate(90deg)',
                sizeFactor: 1,
            },
            {
                name: 'tetris',
                lat: 278,
                lon: 460,
                transform: 'rotate(90deg)',
                sizeFactor: 1,
            },
            {
                name: 'ramp',
                lat: 269,
                lon: 524,
                transform: '',
                sizeFactor: 1.2,
            },
            {
                name: 'bench',
                lat: 227,
                lon: 351,
                transform: 'rotate(90deg)',
                sizeFactor: 1,
            },
        ],
        color: '#7A7A7A',
        tooltipLat: 500,
        tooltipLng: 500,
    }
];

// Funkcja wyświetlająca calloutsy
function showCallouts(area) {
    // Usuwanie wszystkich istniejących callouts z mapy, jeśli są
    if (window.calloutMarkers) {
        window.calloutMarkers.forEach(marker => map.removeLayer(marker));
    }

    // Inicjalizowanie tablicy dla nowych callouts
    window.calloutMarkers = [];

    area.callouts.forEach(function (callout) {
        // Sprawdzenie, czy callout ma współrzędne
        if (callout.lat !== undefined && callout.lon !== undefined) {
            // Tworzenie ikony div dla callout
            var labelIcon = L.divIcon({
                className: 'custom-callout-label', // Klasa CSS do stylowania
                html: '<div style="transform:' + callout.transform + ' ;text-align:center; font-size: ' + 14 * callout.sizeFactor + 'px; font-family: Arial; font-weight: 700; color: white;">' + callout.name + '</div>',
                iconSize: [150, 20], // Rozmiar ikony
            });

            // Tworzenie markera z dynamicznym tekstem
            var calloutMarker = L.marker([callout.lat, callout.lon], { icon: labelIcon }).addTo(map);

            // Dodawanie markera do tablicy calloutMarkers
            window.calloutMarkers.push(calloutMarker);
        }
    });
}
// Dodanie obszarów do mapy
areas.forEach(function (area) {
    var polygon = L.polygon(area.bounds, {
        color: area.color, // Kolor obszaru ustawiany dynamicznie
        weight: 2, // Grubość linii
        fillOpacity: 0.3, // Przezroczystość wypełnienia
    });

    // Dodanie do mapy
    polygon.addTo(map);

    var titleCoords = [{ "lat": 708, "lng": 368 }];
    var labelMarker;

    // Event na najechanie kursora
    polygon.on('mouseover', function () {
        var labelIcon = L.divIcon({
            className: 'custom-label', // Klasa CSS do stylowania
            html: '<div style="text-align: center; font-weight: 900; font-size: 25px; font-family: Arial;color: white;">This is area<b> ' + area.name + '</b></br> Click here to show callouts</div>',
            iconSize: [700, 40] // Rozmiar ikony
        });

        labelMarker = L.marker([titleCoords[0].lat, titleCoords[0].lng], { icon: labelIcon })
            .addTo(map);

        // Zmiana stylu polygona
        polygon.setStyle({
            weight: 2, // Zmieniona grubość ramki
            color: '#4f4f4d' // Zmieniony kolor ramki
        });
    });

    // Event na opuszczenie kursora
    polygon.on('mouseout', function () {
        if (labelMarker) {
            map.removeLayer(labelMarker);
        }

        // Przywrócenie oryginalnego stylu polygona
        polygon.setStyle({
            weight: 2, // Oryginalna grubość ramki
            color: area.color // Oryginalny kolor ramki
        });
    });

    // Dodanie pop-up z nazwą strefy po kliknięciu
    polygon.on('click', function () {
        showCallouts(area);
    });
});