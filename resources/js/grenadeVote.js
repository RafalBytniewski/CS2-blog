document.querySelectorAll('.vote-btn').forEach(button => {
    button.addEventListener('click', function () {
        const grenadeId = this.getAttribute('data-id');
        const voteType = this.getAttribute('data-type');
        const voteResultElement = document.querySelector(`#vote_result_${grenadeId}`); // Zaktualizuj dla konkretnego granatu

        fetch('/grenade/vote', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json', // Wymuś odpowiedź JSON
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                grenade_id: grenadeId,
                vote_type: voteType
            })
        })

        // SPRAWDZANIE BŁEDÓW 
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                console.log('Error:', data.message); // Wyświetla komunikat w konsoli
                alert(data.message); // Wyświetla komunikat użytkownikowi
            } else {
                console.log('Vote recorded successfully:', data);
                // Zaktualizuj wynik głosowania
                if (voteResultElement) {
                    voteResultElement.textContent = data.result; // Zaktualizuj element z wynikiem
                }
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
        
    });
});
