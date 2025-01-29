document.querySelectorAll('.vote-btn').forEach(button => {
    button.addEventListener('click', function () {
        const grenadeId = this.getAttribute('data-vote-id');
        const voteType = this.getAttribute('data-type');
        const voteResultElement = document.querySelector(`#vote_result_${grenadeId}`);

        fetch('/grenade/vote', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                grenade_id: grenadeId,
                vote_type: voteType,
                is_logged_in: isLoggedIn
            })
        })
        .then(response => {
            console.log("Response status:", response.status);
            return response.json().catch(() => ({})).then(data => ({ status: response.status, data }));
        })
        .then(({ status, data }) => {
            console.log("Parsed response:", status, data);
        
            if (status === 401) {
                Swal.fire({
                    title: "You must be logged in to vote.",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Login",
                    denyButtonText: "Register"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/login";
                    } else if (result.isDenied) {
                        window.location.href = "/register";
                    }
                });
                return;
            }
        
            if (!data.success) {
                throw new Error(data.message || "Unexpected error");
            }
        
            console.log('Vote recorded successfully:', data);
            if (voteResultElement) {
                voteResultElement.textContent = data.result;
                Swal.fire({
                    title: "You voted well!",
                    icon: "success",
                    draggable: true
                  });
            }
        })
        .catch(error => {
            console.error('Error:', error.message);
            Swal.fire({
                title: "Error",
                text: error.message,
                icon: "error",
                confirmButtonText: "OK"
            });
        });
        
    });
});
