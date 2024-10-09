@extends('layouts.layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<div style="margin-left:5px;" class="toolbar">
    <h1>Avtive Investment</h1>
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
                                class="form-control form-control-solid w-250px ps-15" placeholder="Search Month" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <!--begin::Filter-->






                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->







                        <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <div class="modal-content">
                                    <div class="modal-header" id="kt_modal_add_user_header">
                                        <h2 class="fw-bolder">Add Month</h2>
                                        <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                            data-kt-users-modal-action="close">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                        <!--begin::Form-->
                                        <form method="POST" id="kt_modal_add_user_form" class="form needs-validation"
                                            action="/addmonth" enctype="multipart/form-data" novalidate>
                                            @csrf
                                            <div class="fv-row mb-7">
                                                <label class="required fw-bold fs-6 mb-2">Month</label>
                                                <select name="month" class="form-control form-control-solid mb-3 mb-lg-0" required>
                                                    <option value="" disabled selected>Select a month</option>
                                                    <option value="January">January</option>
                                                    <option value="February">February</option>
                                                    <option value="March">March</option>
                                                    <option value="April">April</option>
                                                    <option value="May">May</option>
                                                    <option value="June">June</option>
                                                    <option value="July">July</option>
                                                    <option value="August">August</option>
                                                    <option value="September">September</option>
                                                    <option value="October">October</option>
                                                    <option value="November">November</option>
                                                    <option value="December">December</option>
                                                </select>
                                                <div class="invalid-feedback">Please select a valid month.</div>
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
                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
    <thead>
        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-150px">Sr no</th>
            <th class="min-w-200px">Month</th>
            <th class="min-w-120px">Year</th>
            <th class="min-w-120px">Total Payment</th>
            <th class="min-w-120px">Remaining Amount</th>
           
        </tr>
    </thead>
    <tbody class="fw-bold text-gray-600">

        @foreach ($month as $month)

        <tr>
            <td>
                <div>{{ $loop->iteration }}</div>
            </td>
            <td>
                <div>{{ $month->month_name }}</div> <!-- Assuming 'month_name' is a valid attribute -->
            </td>
            <td>
                <div>{{ $month->created_at->format('Y') }}</div>
            </td>
            <td>
                <div>
                    {{ $month->totalPayment[0]->total_payment }} <!-- Assuming 'total_payment' is the column name -->
                </div>
            </td>
            <td>
                <div>
                    {{ $month->totalPayment[0]->remaining_amount }} <!-- Assuming 'remaining_amount' is the column name -->
                </div>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>


                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
        </div>

    </div>

    <div class="modal fade" id="kt_modal_add_deletedstudents" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-10000ypx">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fw-bolder">Deleted Plans</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
            // Get all "View more" links
            const viewMoreLinks = document.querySelectorAll('.view-more');

            // Add click event listeners to each "View more" link
            viewMoreLinks.forEach(link => {
                link.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const fullDescription = document.getElementById('description-' + id);

                    if (fullDescription.classList.contains('d-none')) {
                        fullDescription.classList.remove('d-none');
                        this.textContent = 'View less'; // Optionally change the link text
                    } else {
                        fullDescription.classList.add('d-none');
                        this.textContent = 'View more'; // Optionally revert the link text
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('kt_modal_add_user_form');
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add('was-validated');
                    return;
                }

                event.preventDefault();

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
                        const formData = new FormData(form);

                        fetch('/addmonth', {
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
                                        window.location.href =
                                            '/months';
                                    });
                                } else if (data.error) {
                                    Swal.fire({
                                        title: 'Validation Errors',
                                        text: Object.values(data.error).join(' '),
                                        icon: 'error'
                                    });
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

</body>
<!--end::Body-->

</html>
@endsection
