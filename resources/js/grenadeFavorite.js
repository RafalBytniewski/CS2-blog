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
                is_logged_in: isLoggedIn
            })
        })
        .then((response) => {
            return response
                .json()
                .catch(() => ({}))
                .then((data) => ({ status: response.status, data }));
        })

        .then(({ status, data }) => {
            if (status === 401) {
                showLoginAlert();
                return;
            }

            if (!data.success) {
                console.log('Error:', data.message); // Wyświetla komunikat w konsoli
                alert(data.message); // Wyświetla komunikat użytkownikowi
            } else {
                if (data.favorite === 1) {
                    icon.classList.remove('fa-regular');
                    icon.classList.add('fa-solid');
                    showSuccessAlert("Added grenade to favorite");
                } else {
                    icon.classList.remove('fa-solid');
                    icon.classList.add('fa-regular');
                    showSuccessAlert("Deleted grenade from favorite");
                }
                icon.classList.add('fa-bounce'); 
                setTimeout(() => {
                    icon.classList.remove('fa-bounce');
                }, 1000);
            }
        })
        .catch((error) => {
            showErrorAlert(error.message);
        });
    });
});