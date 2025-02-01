import Swal from 'sweetalert2';

export function showLoginAlert() {
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
    return
}

export function showSuccessAlert(message = "Voted successfully!") {
    Swal.fire({
        title: "Success",
        text: message,
        icon: "success",
        confirmButtonText: "OK"
    });
}

export function showErrorAlert(message = "An error occurred!") {
    Swal.fire({
        title: "Error",
        text: message,
        icon: "error",
        confirmButtonText: "OK"
    });
}
