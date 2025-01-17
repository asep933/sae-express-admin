<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>@yield('title') - {{ config('app.name') }}</title>

    {{-- Favicons --}}
    <link href="{{asset('favicon.ico')}}" rel="icon">
    <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    {{-- Vendor CSS Files --}}
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    {{-- Main CSS File --}}
    @vite(['resources/css/app.css', 'resources/css/main.css'])
    @stack('styles')
</head>

<body class="index-page">

    <header id="header" class="header sticky-top">

        <div class="topbar d-flex align-items-center">
            <div class="container d-flex justify-content-center justify-content-md-between">
                <div class="contact-info d-flex align-items-center">
                    <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:sae.express.wanguk@gmail.com">sae.express.wanguk@gmail.com</a></i>
                    <i class="bi bi-phone d-flex align-items-center ms-4"><span>+6285150008031</span></i>
                </div>
                <div class="social-links d-none d-md-flex align-items-center">
                    <a href="https://www.facebook.com/profile.php?id=100083652155469&mibextid=ZbWKwL" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/sae_express?igsh=MTZ5ZGhuNXdudTdqeQ==" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>{{-- End Top Bar --}}

        <div class="branding d-flex align-items-cente">

            <div class="container position-relative d-flex align-items-center justify-content-between">
                <a href="/" class="logo d-flex align-items-center">
                    {{-- Uncomment the line below if you also wish to use an image logo --}}
                    {{-- <img src="{{asset('logo.png')}}" alt="sae express logo" width="100" height="200"> --}}
                    <h1 class="sitename">Sae Express<span style="color: blue;">.</span></h1>
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="{{env('APP_URL')}}/#hero" class="active">Home</a></li>
                        <li><a href="{{env('APP_URL')}}/#about">About</a></li>
                        <li><a href="{{env('APP_URL')}}/#services">Services</a></li>
                        <li><a href="{{route('tracking')}}" class="menu-tracking">Tracking</a></li>
                        <li><a href="{{env('APP_URL')}}/#contact">Contact</a></li>
                        <li>
                            @if (auth()->check())
                            <a href="{{route('admin.dashboard.index')}}">
                                <div class="btn btn-primary text-white px-3 py-1">
                                    Admin
                                </div>
                            </a>

                            @else
                            <a href="{{route('admin.dashboard.index')}}">
                                <div class="btn btn-primary text-white px-3 py-1">
                                    Login
                                </div>
                            </a>
                            @endif
                        </li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>

            </div>

        </div>

    </header>

    @yield('main')

    <footer id="footer" class="footer">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <img src="{{asset('logo.png')}}" alt="sae express logo" width="120" height="auto">
                    <a href="{{route('homepage')}}" class="d-flex align-items-center">
                        <span class="sitename">Sae Express</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>
                            Dusun Wanguk Lor Timur, RT 020 RW 009 Desa.Kadungwungu, Kec.Anjatan, Kab.Indramayu Prov. Jawa Barat - Indonesia 45256
                        </p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+6285150008031</span></p>
                        <p><strong>Email:</strong> <span>sae.express.wanguk@gmail.com</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{env('APP_URL')}}/#hero">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{env('APP_URL')}}/#about">About us</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{env('APP_URL')}}/#services">Services</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{route('tracking')}}">Tracking</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{env('APP_URL')}}/#contact">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p>Terhubung dengan kami di media sosial untuk mendapatkan pembaruan terbaru dan informasi menarik.</p>
                    <div class="social-links d-flex">
                        <a target="_blank" href="https://www.facebook.com/profile.php?id=100083652155469&mibextid=ZbWKwL"><i class="bi bi-facebook"></i></a>
                        <a target="_blank" href="https://www.instagram.com/sae_express?igsh=MTZ5ZGhuNXdudTdqeQ=="><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container copyright text-center">
            <p>&copy; <span>Copyright</span> <strong class="px-1 sitename">Aristhra</strong> <span>All Rights Reserved</span></p>
        </div>

    </footer>

    {{-- Scroll Top --}}
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <a href="https://wa.me/+6285150008031"
        id="whatsapp-button"
        class="d-flex align-items-center justify-content-center"
        style="background-color: green; color: white; text-decoration: none; position: fixed; bottom: 20px; right: 20px; padding: 10px 15px; border-radius: 50px; z-index: 1000;"
        target="_blank">
        <i class="bi bi-whatsapp"></i> WhatsApp
    </a>



    {{-- Vendor JS Files --}}
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
    <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
    <script src="{{asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>

    {{-- Main JS File --}}
    @vite(['resources/js/app.js', 'resources/js/main.js'])
    @stack('scripts')

</body>

</html>