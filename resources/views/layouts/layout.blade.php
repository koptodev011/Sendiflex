<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    <base href="">
    <title>Spendifix</title>
    <meta name="description"
        content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{url('assets/media/logos/companyLogo.webp')}}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    <link href="{{url('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{url('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{url('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

</head>

<body id="kt_body"
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
    style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Aside-->
            <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true"
                data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}"
                data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
                data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
                <!--begin::Brand-->
                <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                    <!--begin::Logo-->
                    <a href="">
                        <img alt="Logo" src="{{url('assets/media/logos/companyLogo.webp')}}" class="h-50px logo" />
                    </a>
                    <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
                        data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                        data-kt-toggle-name="aside-minimize">
                        <span class="svg-icon svg-icon-1 rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.5"
                                    d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                                    fill="black" />
                                <path
                                    d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Aside toggler-->
                </div>





























                <!-- //This is the navbar -->


                <div class="aside-menu flex-column-fluid">
                    <!--begin::Aside Menu-->
                    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                        data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
                        data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
                        <!--begin::Menu-->
                        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                            id="#kt_aside_menu" data-kt-menu="true">

                            <div class="menu-item">
                                <a class="menu-link active" href="{{ route('dashbord') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                    fill="black" />
                                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                    fill="black" />
                                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title" style="font-weight:bold">Dashboard</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <div class="menu-content pt-8 pb-2">
                                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Management</span>
                                </div>
                            </div>




                            <div class="menu-item menu-accordion">

                                <a class="menu-link " href="{{ route('month') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                                    fill="black" />
                                                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title">Manage your month </span>
                                </a>


                            </div>




                            <div class="menu-item menu-accordion">
                                 <a class="menu-link " href="{{ route('activeinvestment') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                                    fill="black" />
                                                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title">Active investment</span>
                                </a>
                            </div>




                            <!-- <div class="menu-item menu-accordion">
                                <a class="menu-link " href="{{ route('carManagement') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                                    fill="black" />
                                                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title">Feature plans</span>
                                </a>
                            </div> -->




                            <div class="menu-item menu-accordion">

                                <a class="menu-link " href="{{ route('edusection') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                                    fill="black" />
                                                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title">Educational plans</span>
                                </a>


                            </div>


                            <div class="menu-item menu-accordion">

                                <a class="menu-link " href="{{ route('carManagement') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                                    fill="black" />
                                                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title">Get To days timetable</span>
                                </a>


                            </div>

                            <div class="menu-item menu-accordion">

<a class="menu-link " href="{{ route('carManagement') }}">
    <span class="menu-icon">
        <span class="svg-icon svg-icon-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none">
                <path
                    d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                    fill="black" />
                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4"
                    fill="black" />
            </svg>
        </span>
    </span>
    <span class="menu-title">History</span>
</a>


</div>

<div class="menu-item menu-accordion">

<a class="menu-link " href="{{ route('calculator') }}">
    <span class="menu-icon">
        <span class="svg-icon svg-icon-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none">
                <path
                    d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                    fill="black" />
                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4"
                    fill="black" />
            </svg>
        </span>
    </span>
    <span class="menu-title">Calculator task</span>
</a>


</div>




                        </div>
                    </div>
                </div>>
                <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">

                </div>
                <!--end::Footer-->
            </div>













            <!-- //This is used to properly aligin the middle part -->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header align-items-stretch">
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
                            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                                id="kt_aside_mobile_toggle">
                                <span class="svg-icon svg-icon-2x mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                            fill="black" />
                                        <path opacity="0.3"
                                            d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                            fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                        </div>
                        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                            <a href="" class="d-lg-none">
                                <img alt="Logo" src="{{url('assets/media/logos/companyLogo.webp')}}" class="h-30px" />
                            </a>
                        </div>
                        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                            <!--begin::Navbar-->
                            <div class="d-flex align-items-stretch" id="kt_header_nav">

                            </div>
                            <div class="d-flex align-items-stretch flex-shrink-0">
                                <!--begin::Toolbar wrapper-->
                                <div class="d-flex align-items-stretch flex-shrink-0">

                                    <!--begin::User-->
                                    <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                        <!--begin::Menu wrapper-->
                                        <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                                            data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                            data-kt-menu-placement="bottom-end">
                                            <img src="{{ asset( Auth::user()->profile_picture) }}" alt="user" />


                                        </div>
                                        <!--begin::Menu-->














                                        <!-- Header  -->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                                            data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content d-flex align-items-center px-3">
                                                    <div class="symbol symbol-50px me-5">
                                                    <img src="{{ asset( Auth::user()->profile_picture) }}" alt="user" />
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <div class="fw-bolder d-flex align-items-center fs-5">{{ Auth::user()->name }}
                                                            <span
                                                                class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span>
                                                        </div>
                                                        <a href="#"
                                                            class="fw-bold text-muted text-hover-primary fs-7">{{Auth::user()->email}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="separator my-2"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-5">
                                                <a style="font-weight:bold" href="{{ route('profile') }}"
                                                    class="menu-link px-5">My Profile</a>

                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu separator-->
                                            <div class="separator my-2"></div>
                                            <!--end::Menu separator-->


                                            <!--begin::Menu item-->
                                            <div class="menu-item px-5">
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="menu-link px-5" style="background: none; border: none; color: inherit; cursor: pointer; font-weight: bold; text-align: left; padding: 0;">
            Sign Out
        </button>
    </form>
</div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator my-2"></div>
                                            <!--end::Menu separator-->

                                        </div>
                                        <!--end::Menu-->
                                        <!--end::Menu wrapper-->
                                    </div>
                                    <div class="d-flex align-items-center d-lg-none ms-2 me-n3"
                                        title="Show header menu">
                                        <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                                            id="kt_header_menu_mobile_toggle">
                                            <!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z"
                                                        fill="black" />
                                                    <path opacity="0.3"
                                                        d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z"
                                                        fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                    </div>
                                    <!--end::Heaeder menu toggle-->
                                </div>
                                <!--end::Toolbar wrapper-->
                            </div>
                            <!--end::Topbar-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">


                    <main class="py-0">
                        @yield('content')
                    </main>

                </div>
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <div
                        class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-bold me-1">2024©</span>
                            <a href="https://keenthemes.com" target="_blank"
                                class="text-gray-800 text-hover-primary">Spendifix</a>
                        </div>

                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->





















    <!-- // <script src="assets/js/custom/apps/user-management/roles/view/view.js"></script> -->
    <script src="{{url('assets/js/custom/apps/user-management/roles/view/view.js')}}"> </script>
     <script src="{{url('assets/js/custom/apps/user-management/roles/view/view.js')}}">
    </script>

    <script src="{{url('assets/plugins/global/plugins.bundle.js')}}"> </script>
    <!-- /<script src="assets/plugins/global/plugins.bundle.js"> -->
    <!-- </script> -->


    <script src="{{url('assets/js/scripts.bundle.js')}}"> </script>
    <!-- // <script src="assets/js/scripts.bundle.js">
    </script> -->

     <!-- <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script> -->
    <script src="{{url('assets/plugins/custom/datatables/datatables.bundle.js')}}"> </script>
    <!-- // <script src="assets/js/custom/apps/user-management/users/list/table.js">
    </script> -->
    <script src="{{url('assets/js/custom/apps/user-management/users/list/table.js')}}"> </script>
    <!-- // <script src="assets/js/custom/apps/user-management/users/list/export-users.js">
    </script> -->
    <script src="{{url('assets/js/custom/apps/user-management/users/list/export-users.js')}}"> </script>
    <!-- // <script src="assets/js/custom/apps/user-management/users/list/add.js">
    </script> -->
    <script src="{{url('assets/js/custom/apps/user-management/users/list/add.js')}}"> </script>
    <script src = "{{url('assets/js/custom/widgets.js')}}"></script>
    <!-- // <script src="assets/js/custom/widgets.js"></script> -->

    <script src="{{url('assets/js/custom/apps/chat/chat.js')}}"> </script>
    <!-- // <script src="assets/js/custom/apps/chat/chat.js">
    </script> -->

    <script src="{{url('assets/js/custom/modals/create-app.js')}}"> </script>
    <!-- // <script src="assets/js/custom/modals/create-app.js">
    </script> -->

    <script src="{{url('assets/js/custom/modals/upgrade-plan.js')}}"> </script>
    <!-- // <script src="assets/js/custom/modals/upgrade-plan.js">
    </script> -->

    <script src="{{url('assets/js/custom/apps/user-management/permissions/list.js')}}"> </script>
    <!-- // <script src="assets/js/custom/apps/user-management/permissions/list.js">
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>





</body>

</html>
