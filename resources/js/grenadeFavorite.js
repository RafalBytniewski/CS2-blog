document.querySelectorAll('.favorite-btn').forEach(button => {
    button.addEventListener('click', function () {
        const grenadeId = this.getAttribute('data-favorite-id'); // Pobranie ID granatu

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
        .then (data =>{
            if (!data.success) {
                console.log('Error:', data.message); // Wyświetla komunikat w konsoli
                alert(data.message); // Wyświetla komunikat użytkownikowi
            } else {
                console.log('Vote recorded successfully:', data);
            }
        })
        
    });
});