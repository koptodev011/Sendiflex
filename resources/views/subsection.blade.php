@extends('layouts.layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
    #sections {

        background-color: #dee4f4;
        margin-top: 30px;
        width: 320px;
        height: 130px;
        margin-left: 50px;
        border-radius: 10px;
    }

    .subsection {
        display: flex;
    }
    </style>
</head>

<div style="margin-left:5px;" class="toolbar">
    <h1>Earnings</h1>
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

                    </div>
                    <div style="margin: auto;" class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
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
                                Add Sub Section
                            </button>



                            <button style="margin-left: 20px; background:red" type="button" id="Secondbutton"
                                class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user_form">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                            transform="rotate(-90 11.364 20.364)" fill="black" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                    </svg>
                                </span>
                                Create Roadmap
                            </button>


                        </div>








                        <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <div class="modal-content">
                                    <div class="modal-header" id="kt_modal_add_user_header">
                                        <h2 class="fw-bolder">Add Sub Section </h2>
                                        <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                            data-kt-users-modal-action="close">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">

                                        <form method="POST" id="my_form" class="form needs-validation"
                                            action="/addsubject" enctype="multipart/form-data" novalidate>

                                            @csrf
                                            <input type="hidden" name="id" value="{{ request()->query('id') }}">
                                            <div class="fv-row mb-7">
                                                <label class="required fw-bold fs-6 mb-2">Subject Name</label>
                                                <input type="text" name="sectionname"
                                                    class="form-control form-control-solid mb-3 mb-lg-0" required />
                                                <div class="invalid-feedback">
                                                    Please provide a valid section name.
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




                        <div class="modal fade" id="kt_modal_add_user_form" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <div class="modal-content">
                                    <div class="modal-header" id="kt_modal_add_user_header">
                                        <h2 class="fw-bolder">Add Sub Section </h2>
                                        <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                            data-kt-users-modal-action="close">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">

                                    <form method="POST" id="my_form" class="form needs-validation" action="/addroadmaps" enctype="multipart/form-data" novalidate>
    @csrf
    <div id="form-fields">
        <div class="row mb-7 form-section">
        <div class="col-md-4">
    <label class="required fw-bold fs-6 mb-2">Subject Name</label>
    <select name="sectionname[]" class="form-control form-control-solid" required>
        <option value="" disabled selected>Select a subject</option>
        @foreach($subsection as $subject)
            <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">Please select a valid section name.</div>
</div>

            <div class="col-md-4">
                <label class="required fw-bold fs-6 mb-2">Starting Date</label>
                <input type="date" name="start_date[]" class="form-control form-control-solid" required />
                <div class="invalid-feedback">Please select a starting date.</div>
            </div>
            <div class="col-md-4">
                <label class="required fw-bold fs-6 mb-2">Ending Date</label>
                <input type="date" name="end_date[]" class="form-control form-control-solid" required />
                <div class="invalid-feedback">Please select an ending date.</div>
            </div>
            <div class="col-md-4">
                <label class="required fw-bold fs-6 mb-2">Priority</label>
                <select name="number_selection[]" class="form-control form-control-solid" required>
                    <option value="" disabled selected>Select a priority</option>
                    <option value="1">Low</option>
                    <option value="2">Medium</option>
                    <option value="3">High</option>
                </select>
                <div class="invalid-feedback">Please select a priority.</div>
            </div>
            <input type="hidden" name="id" value="{{ request()->query('id') }}">
        </div>
    </div>
    <div class="text-center pt-15">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
        <button type="submit" class="btn btn-primary">
            <span class="indicator-label">Submit</span>
            <span class="indicator-progress">Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
        <button type="button" id="add-more-btn" class="btn btn-secondary">Add More</button>
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

                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
        </div>

    </div>



    <div class="row">
        @foreach($subsection as $section)
        <div class="col-lg-4">
            <div id="sections" class="card">
                <div class="card-body">
                    <a href="{{ route('material', ['id' => $section->id]) }}">
                        <h1
                            style="text-align:center; margin-top:18px; font-weight:600px; font-size:30px; font-family:inherit; cursor:pointer;">
                            {{ $section->subject_name }}
                        </h1>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>





    <meta name="csrf-token" content="{{ csrf_token() }}">



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

                    fetch('/totalpayment', {
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
    <script>
    document.getElementById('add-more-btn').addEventListener('click', function() {
        const formFields = document.querySelector('.form-section');
        const clone = formFields.cloneNode(true);
        const inputs = clone.querySelectorAll('input, select');

        inputs.forEach(input => {
            if (input.type !== 'hidden') {
                input.value = ''; // Clear the values of cloned inputs
            }
        });

        document.getElementById('form-fields').appendChild(clone);
    });
</script>



</body>
<!--end::Body-->

</html>
@endsection
