<!DOCTYPE html>

@php
    $rtl = get_session_language()->rtl;
@endphp

@if ($rtl == 1)
    <html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="@yield('meta_description', get_setting('meta_description'))" />
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords'))">
    <title>@yield('meta_title', get_setting('website_name') . ' | ' . get_setting('site_motto'))</title>

    <!-- Favicon -->
    @php
        $site_icon = uploaded_asset(get_setting('site_icon'));
    @endphp
    <link rel="icon" href="{{ $site_icon }}">
    <link rel="apple-touch-icon" href="{{ $site_icon }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">
    @if ($rtl == 1)
        <link rel="stylesheet" href="{{ static_asset('assets/css/bootstrap-rtl.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css?v=') }}{{ rand(1000, 9999) }}">
    
    <style>
        :root {
            --primary: #1b84ff;
            --soft-primary: #e9f3ff;
            --hov-primary: #146bce;
            --success: #12814c;
            --soft-success: #dfffe8;
            --info: #7339ea;
            --soft-info: #f1e8ff;
            --warning: #f6ba41;
            --soft-warning: #fff6e6;
        }
        body{
            font-family: 'Public Sans', sans-serif;
            font-weight: 400;
        }
        .demo-admin-links{
            max-width: 780px;
        }
    </style>
</head>
<body>
    <!-- aiz-main-wrapper -->
    <div class="aiz-main-wrapper d-flex flex-column justify-content-center bg-white">
        <section class="bg-white">
            <div class="container">
                <div class="demo-admin-links w-100 py-5 my-lg-5 px-4 mx-auto">
                    <div class="row overflow-hidden rounded-3" style="border: 1px solid #f2f2f2;">
                        <div class="col-md-6 px-0 d-none d-md-block"  style="border-right: 1px solid #f2f2f2;">
                            <img class="img-fit h-100" src="{{ my_asset('assets/img/demo/link/link.png') }}" alt="Megamart">
                        </div>
                        <div class="col-md-6 px-2rem py-5 d-flex flex-column justify-content-center">
                            <div class="mb-4 text-center">
                                <img class="h-40px" src="{{ my_asset('assets/img/demo/link/logo.svg') }}" alt="Megamart">
                            </div>
                            <a href="https://localhost/megamart/web/users/login" class="btn btn-block btn-lg btn-soft-primary fs-14 fw-700 mb-3 rounded-2">Login as Customer</a>
                            <a href="https://localhost/megamart/web/login" class="btn btn-block btn-lg btn-soft-info fs-14 fw-700 mb-3 rounded-2">Login as Admin</a>
                            <a href="https://localhost/megamart/web/seller/login" class="btn btn-block btn-lg btn-soft-success fs-14 fw-700 mb-3 rounded-2">Login as Seller</a>
                            <a href="https://localhost/megamart/web/deliveryboy/login" class="btn btn-block btn-lg btn-soft-warning fs-14 fw-700 mb-3 rounded-2">Login as Delivery Boy</a>
                            <small class="d-block fs-10 text-center" style="color: #78829d;">* The above links of Login will forward you to main demo.</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>