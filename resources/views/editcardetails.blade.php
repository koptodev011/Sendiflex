@extends('layouts.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <div style="margin-left:5px;" class="toolbar">
        <h1>Edit Car Details</h1>
    </div>
    <div class="container mt-8">
        <div class="row justify-content-center">
            <div class="col-lg-15">
                <div class="card">

                    <div class="card-body">
                        <div class="modal-body scroll-y mx-8 mx-xl-25 my-7">
                            <form id="editCarForm" method="post"
                                action="{{ route('updatecardetails', ['id' => $editcardetails->id]) }}"
                                enctype="multipart/form-data" class="form needs-validation" novalidate>
                                @csrf
                                <div class="fv-row mb-7">
                                    <label class="required fw-bold fs-6 mb-2">Car Name</label>
                                    <input type="text" name="car-name"
                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                        value="{{ $editcardetails->car_name }}" required />
                                    <div class="invalid-feedback">
                                        Please enter the car name.
                                    </div>
                                </div>



                                <div class="fv-row mb-7">
                                    <label class="required fw-bold fs-6 mb-2">Car Number</label>
                                    <input type="number" id="car_number" name="car-number"
                                        class="form-control form-control-solid mb-3 mb-lg-0" pattern="\d{4}"
                                        value="{{ $editcardetails->car_number }}" required />
                                    <div id="car_number_feedback" class="invalid-feedback">
                                        Please provide a valid car number with at least 4 digits.
                                    </div>
                                </div>


                                <div class="fv-row mb-7">
                                    <label class="required fw-bold fs-6 mb-2">Fuel Type</label>
                                    <select name="car-fuel" class="form-select form-select-solid mb-3 mb-lg-0" required>
                                        <option value=""></option>
                                        <option value="Petrol"
                                            {{ $editcardetails->fuel_type == 'Petrol' ? 'selected' : '' }}>Petrol
                                        </option>
                                        <option value="Diesel"
                                            {{ $editcardetails->fuel_type == 'Diesel' ? 'selected' : '' }}>Diesel
                                        </option>
                                        <option value="Electric"
                                            {{ $editcardetails->fuel_type == 'Electric' ? 'selected' : '' }}>Electric
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a fuel type.
                                    </div>
                                </div>

                                <div class="fv-row mb-7">
                                    <label class="required fw-bold fs-6 mb-2">Branch</label>
                                    <select name="branch" class="form-select form-select-solid mb-3 mb-lg-0" required>

                                        <option value="{{ $editcardetails->branch }}">{{ $editcardetails->branch_name }}
                                        </option>
                                        @if (!empty($branch))
                                        @foreach ($branch as $item)
                                        <option value="{{ $item->id }}">{{ $item->branch_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select Branch.
                                    </div>
                                </div>
                                <div class="text-center pt-15">
                                <button type="button" id="discardButton" class="btn btn-light me-3"
                                data-kt-users-modal-action="cancel">Discard</button>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch the form
        var form = document.getElementById('editCarForm');

        // Form validation and submission
        form.addEventListener('submit', function(event) {
            // Perform client-side validation
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
            } else {
                // Prevent the default form submission
                event.preventDefault();

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to submit this form?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, submit it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Prepare form data
                        const formData = new FormData(form);

                        fetch(form.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute(
                                        'content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire(data.message, '', 'success').then(() => {
                                        // Redirect to a new route or reload the page
                                        window.location.href =
                                            '/public/car-management'; // Adjust URL as needed
                                    });
                                } else {
                                    Swal.fire(data.message, '', 'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire("An error occurred. Please try again later.", '',
                                    'error');
                            });
                    } else {
                        Swal.fire("Form submission cancelled.");
                    }
                });
            }
        }, false);
        discardButton.addEventListener('click', function() {
        // Redirect to the car-management route
        window.location.href = '/public/car-management'; // Adjust URL as needed
    });
    });

 
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const carNumberInput = document.getElementById('car_number');
        const carNumberFeedback = document.getElementById('car_number_feedback');

        carNumberInput.addEventListener('input', function() {
            const carNumberValue = carNumberInput.value;
            const isValidCarNumber = /^\d{4,}$/.test(carNumberValue);

            if (isValidCarNumber) {
                carNumberInput.classList.remove('is-invalid');
                carNumberFeedback.style.display = 'none';
            } else {
                carNumberInput.classList.add('is-invalid');
                carNumberFeedback.style.display = 'block';
            }
        });
    });
    </script>