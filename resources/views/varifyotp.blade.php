@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shiv Suman</title>
    <link rel="shortcut icon" href="assets/media/logos/companyLogo.webp" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
body {
    background-color: #f8f9fa;
    font-family: 'Nunito', sans-serif;
}

.login-container {
    max-width: 550px;
    margin: 0 auto;
    margin-top: 100px;
    padding: 30px;
    background: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 50px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.login-container h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.form-control {
    height: 50px;
    font-size: 16px;
    border-radius: 15px;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    height: 50px;
    font-size: 18px;
    border-radius: 10px;
}

.btn-primary:hover {
    background-color: #0069d9;
    border-color: #0062cc;
}

.form-check-label {
    font-size: 14px;
}

.text-danger {
    font-size: 14px;
}

/* Custom SweetAlert Styles */
.swal2-title-custom {
    color: #333;
    font-family: 'Nunito', sans-serif;
    font-size: 24px;
}

.swal2-content-custom {
    color: #555;
    font-family: 'Nunito', sans-serif;
    font-size: 16px;
}

.swal2-actions-custom {
    margin-top: 20px;
}

.swal2-confirm-custom,
.swal2-cancel-custom {
    border-radius: 8px;
    padding: 12px 25px;
    font-size: 16px;
    font-family: 'Nunito', sans-serif;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.swal2-confirm-custom {
    background-color: #007bff;
    border: none;
}

.swal2-cancel-custom {
    background-color: #d33;
    border: none;
}

.swal2-confirm-custom:hover {
    background-color: #0056b3;
}

.swal2-cancel-custom:hover {
    background-color: #c82333;
}

.swal2-popup {
    border-radius: 15px;
}

.swal2-container {
    display: flex;
    align-items: center;
    justify-content: center;
}

.swal2-header {
    border-bottom: none;
}

.swal2-content {
    padding: 15px 25px;
    text-align: center;
}
</style>

<body>

    @section('content')
    <div class="container">
        <div class="login-container">
            <h2>{{ __('Shiv Suman') }}</h2>

            <form id="otpForm" method="POST" action="{{ route('verifyOtp') }}" novalidate>
                @csrf

                <div class="form-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="otp">{{ __('OTP') }}</label>
                    <input id="otp" type="number" class="form-control @error('otp') is-invalid @enderror"
                        name="otp" value="{{ old('otp') }}" min="0" required autocomplete="otp" autofocus>
                    @error('otp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Verify OTP') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('otpForm').addEventListener('submit', function(event) {
            const form = document.getElementById('otpForm');
            const isValid = form.checkValidity(); // Check if form is valid

            if (isValid) {
                event.preventDefault(); // Prevent the default form submission

                const formData = new FormData(form);

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to submit this OTP?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#007bff',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, submit it!',
                    cancelButtonText: 'Cancel',
                    background: '#f8f9fa',
                    customClass: {
                        title: 'swal2-title-custom',
                        content: 'swal2-content-custom',
                        actions: 'swal2-actions-custom',
                        confirmButton: 'swal2-confirm-custom',
                        cancelButton: 'swal2-cancel-custom'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: data.message,
                                    background: '#f8f9fa',
                                    confirmButtonColor: '#007bff',
                                    customClass: {
                                        title: 'swal2-title-custom',
                                        content: 'swal2-content-custom',
                                        confirmButton: 'swal2-confirm-custom'
                                    },
                                    buttonsStyling: false
                                }).then(() => {
                                    window.location.href = data.redirectUrl || '/'; // Redirect to a new route if specified
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: data.message,
                                    background: '#f8f9fa',
                                    confirmButtonColor: '#007bff',
                                    customClass: {
                                        title: 'swal2-title-custom',
                                        content: 'swal2-content-custom',
                                        confirmButton: 'swal2-confirm-custom'
                                    },
                                    buttonsStyling: false
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'An error occurred',
                                text: 'Please try again later.',
                                background: '#f8f9fa',
                                confirmButtonColor: '#007bff',
                                customClass: {
                                    title: 'swal2-title-custom',
                                    content: 'swal2-content-custom',
                                    confirmButton: 'swal2-confirm-custom'
                                },
                                buttonsStyling: false
                            });
                        });
                    } else {
                        Swal.fire({
                            icon: 'info',
                            title: 'Cancelled',
                            text: 'Submission cancelled.',
                            background: '#f8f9fa',
                            confirmButtonColor: '#007bff',
                            customClass: {
                                title: 'swal2-title-custom',
                                content: 'swal2-content-custom',
                                confirmButton: 'swal2-confirm-custom'
                            },
                            buttonsStyling: false
                        });
                    }
                });
            } else {
                // Trigger HTML5 validation feedback
                form.reportValidity();
            }
        });
    </script>

    @endsection

</body>

</html>
