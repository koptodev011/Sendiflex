@extends('layouts.layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<div style="margin-left:5px;" class="toolbar">
    <h1>Car Management</h1>
</div>

<body id="kt_body"
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
    style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header mt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1 me-5">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                        transform="rotate(45 17.0365 15.1223)" fill="black" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-permissions-table-filter="search"
                                class="form-control form-control-solid w-250px ps-15" placeholder="Search Car" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_add_deletedstudents">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                            transform="rotate(-90 11.364 20.364)" fill="black" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                    </svg>
                                </span>
                                Deleted Cars
                            </button>

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_add_user">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                            transform="rotate(-90 11.364 20.364)" fill="black" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                    </svg>
                                </span>
                                Add New Car
                            </button>
                        </div>
                       
                        <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <div class="modal-content">
                                    <div class="modal-header" id="kt_modal_add_user_header">
                                        <h2 class="fw-bolder">Add Car Details</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                        <!--begin::Form-->
                                        <form method="POST" id="my_form" class="form needs-validation"
                                            action="/public/car-details" enctype="multipart/form-data" novalidate>

                                            @csrf

                                            <div class="fv-row mb-7">
                                                <label class="required fw-bold fs-6 mb-2">Car Name</label>
                                                <input type="text" name="car-name"
                                                    class="form-control form-control-solid mb-3 mb-lg-0" required />
                                                <div class="invalid-feedback">
                                                    Please provide a valid car name.
                                                </div>
                                            </div>
                                            <div class="fv-row mb-7">
                                                <label class="required fw-bold fs-6 mb-2">Car Number</label>
                                                <input type="number" id="car_number" name="car-number"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                    pattern="\d{4,}" required />
                                                <div id="car_number_feedback" class="invalid-feedback">
                                                    Please provide a valid car number with at least 4 digits.
                                                </div>
                                            </div>



                                            <div class="fv-row mb-7">
                                                <label class="required fw-bold fs-6 mb-2">Fuel Type</label>
                                                <select name="car-fuel"
                                                    class="form-select form-select-solid mb-3 mb-lg-0" required>
                                                    <option value="" disabled selected>Select Fuel Type</option>
                                                    <option value="Petrol">Petrol</option>
                                                    <option value="Diesel">Diesel</option>
                                                    <option value="Electric">Electric</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a fuel type.
                                                </div>
                                            </div>

                                            <div class="fv-row mb-7">
                                                <label class="required fw-bold fs-6 mb-2">Branch</label>
                                                <select name="branch" class="form-select form-select-solid mb-3 mb-lg-0"
                                                    required>
                                                    <option value="" disabled selected>Select Branch</option>
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
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Discard</button>
                                                <button type="submit" class="btn btn-primary">
                                                    <span class="indicator-label">Submit</span>
                                                    <span class="indicator-progress">Please wait...
                                                        <span
                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
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
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">

                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-150px">Cars</th>
                                <th class="min-w-150px">Fuel Type</th>
                                <th class="min-w-150px">Car Number</th>
                                <th class="">Branch</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600">
                            @foreach ($cars as $user)
                            <tr>
                                <!-- Car Name -->
                                <td class="align-middle">{{ $user->car_name }}</td>
                                <!-- Fuel Type -->
                                <td class="align-middle">
                                    <a class="badge badge-light-primary fs-7 m-1">{{ $user->fuel_type }}</a>
                                </td>
                                <!-- Car Number -->
                                <td class="badge badge-light-primary fs-7 m-1">{{ $user->car_number }}</td>
                                <td>{{ $user->branch_name }}</td>
                                <!-- Actions -->
                                <td class="text-end align-middle">
                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        Actions
                                        <span class="svg-icon svg-icon-5 m-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                    </a>
                                    <!-- Menu -->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                        data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            <a class="menu-link py-3"
                                                href="{{ route('edit-cardetails', ['id' => $user->id]) }}">Edit</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a class="menu-link px-3"
                                                href="{{ route('deletecar', ['id' => $user->id]) }}">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <!--end::Card body-->
            </div>
        </div>

    </div>







    <div class="modal fade" id="kt_modal_add_deletedstudents" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fw-bolder">Deleted Cars</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped" style="width: 100%; table-layout: fixed;">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">Sr. No.</th>
                                    <th style="width: 120px;">Car Name</th>
                                    <th style="width: 100px;">Fuel Type</th>
                                    <th style="width: 100px;">Car Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deletedcars as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->car_name }}</td>
                                    <td>{{ $user->fuel_type }}</td>
                                    <td>{{ $user->car_number }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('my_form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

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
                    const formData = new FormData(document.getElementById('my_form'));

                    // Use Fetch API to submit the form data
                    fetch('/public/car-details', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(data.message, '', 'success').then(() => {
                                    // Optionally redirect or reset the form
                                    window.location.href =
                                        '/public/car-management'; // Redirect to a new route
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
        });
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch the form
        var form = document.getElementById('my_form');
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
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


</body>
<!--end::Body-->

</html>
@endsection