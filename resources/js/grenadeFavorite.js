document.querySelectorAll('.favorite-btn').forEach(button => {
    button.addEventListener('click', function () {
        const grenadeId = this.getAttribute('data-favorite-id'); // Pobranie ID granatu
        const icon = this.querySelector('i'); // Pobierz ikonę w przycisku

        fetch('/grenade/favorite', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                grenade_id: grenadeId,
            })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                console.log('Error:', data.message); // Wyświetla komunikat w konsoli
                alert(data.message); // Wyświetla komunikat użytkownikowi
            } else {
                console.log('Vote recorded successfully:', data);
                // Zmieniamy klasę ikony w zależności od wartości `favorite`
                if (data.favorite === 1) {
                    icon.classList.remove('fa-regular');
                    icon.classList.add('fa-solid');
                } else {
                    icon.classList.remove('fa-solid');
                    icon.classList.add('fa-regular');
                }

                // Dodaj klasę animacji
                icon.classList.add('fa-bounce'); 

                // Usuń animację po 1 sekundzie
                setTimeout(() => {
                    icon.classList.remove('fa-bounce');
                }, 1000); // Czas trwania animacji w milisekundach
            }
        })
        .catch(error => {
            console.error('Error:', error); // Obsługa błędów fetch
            alert('Something went wrong. Please try again.');
        });
    });
});