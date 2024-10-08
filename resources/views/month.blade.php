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
    <h1>Cost management</h1>
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
                                <div style="margin-left: 60px;" class="totalpayment">
                                <h1>Total Savings ={{$totalpayment}}</h1>
                            </div>
                        </div>
                        <!--end::Search-->
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <!--begin::Filter-->



                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_add_user">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                            transform="rotate(-90 11.364 20.364)" fill="black" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                    </svg>
                                </span>
                                Add Month
                            </button>


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
            <th class="text-end min-w-100px">Actions</th>
        </tr>
    </thead>
    <tbody class="fw-bold text-gray-600">
        @foreach ($earnings as $user)
        <tr>
            <td>
                <div>{{ $loop->iteration }}</div> <!-- Assuming you want a serial number -->
            </td>
            <td>
                <div>{{ $user->month_name }}</div>
            </td>
            <td>
                <div>{{ $user->created_at->format('Y') }}</div> <!-- Extracting the year -->
            </td>

            <td class="text-end">
                <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                    <span class="svg-icon svg-icon-5 m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none">
                            <path
                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                fill="black" />
                        </svg>
                    </span>
                </a>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                    data-kt-menu="true">
                    <div class="menu-item px-3">
                        <a class="menu-link py-3"
                            href="{{ route('manageyourmonth', ['id' => $user->id]) }}">View Details</a>
                    </div>
                </div>
            </td>
            <!--end::Action=-->
        </tr>
        @endforeach
    </tbody>
    <!--end::Table body-->
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
