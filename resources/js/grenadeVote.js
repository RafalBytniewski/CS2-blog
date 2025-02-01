document.querySelectorAll(".vote-btn").forEach((button) => {
    button.addEventListener("click", function () {
        const grenadeId = this.getAttribute("data-vote-id");
        const voteType = this.getAttribute("data-type");
        const voteResultElement = document.querySelector(
            `#vote_result_${grenadeId}`
        );

        fetch("/grenade/vote", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-Token": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({
                grenade_id: grenadeId,
                vote_type: voteType,
                is_logged_in: isLoggedIn,
            }),
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
                    throw new Error(data.message || "Unexpected error");
                }

                if (voteResultElement) {
                    voteResultElement.textContent = data.result;
                    showSuccessAlert();
                }
            })
            .catch((error) => {
                showErrorAlert(error.message);
            });
    });
});
