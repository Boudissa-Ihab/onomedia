<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@setting('app_name', "Ono Design")</title>
    <meta name="description" content="Site vitrine d'Ono Design">
    <meta name="author" content="Boudissa Ihab
        Github : https://github.com/Boudissa-Ihab
        Linkedin : https://www.linkedin.com/in/ihab-boudissa-727346176/">
    <meta name="keywords" content="ono design, content, advertisement, design, logos">

    <!-- Favicons -->
    <link href="@setting('logo')" rel="icon">
    <link href="@setting('logo')" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Template Main CSS File -->
    <link href="{{ asset('css/client.css') }}" rel="stylesheet">

    @livewireStyles
</head>

<body>

    <header id="header" class="fixed-top header-inner-pages">
        <div class="container d-flex align-items-center justify-content-lg-between">

            <h1 class="logo me-auto me-lg-0"><a href="{{ route('home') }}">@setting('app_name', "Ono Design")</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto " href="{{ route('home') }}#hero">Accueil</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('home') }}#about">À propos</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('home') }}#services">Services</a></li>
                    <li><a class="nav-link scrollto active" href="{{ route('home')}}#portfolio">Portfolio</a></li>
                    {{-- <li><a class="nav-link scrollto" href="#team">Team</a></li>
                    <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#">Drop Down 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i
                                        class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down 2</a></li>
                            <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li> --}}
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            <a href="{{ route('home') }}#contact" class="get-started-btn scrollto">Contact</a>
        </div>
    </header>

    {{ $slot }}

    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-info">
                            <a href="{{ route('home') }}#hero"><img src={{ asset("logo/@setting('logo')") }}></a>
                            <p>
                                @setting('address')<br><br>
                                <strong>N<sup>0</sup> de téléphone:</strong> @setting('phone')<br>
                                <strong>Email:</strong> @setting('email')<br>
                            </p>
                            <div class="social-links mt-3">
                                {{-- <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a> --}}
                                <a href="@setting('facebook_link')" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
                                <a href="@setting('instagram_link')" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
                                {{-- <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Liens utiles</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}#hero">Accueil</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}#about">À propos</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}#services">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}#portfolio">Projets</a></li>
                        </ul>
                    </div>

                    @livewire('client.projects-component')

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <p>@setting('description')</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>@setting('app_name', "Ono Design")</span></strong>. Tous droits réservés
            </div>
        </div>
    </footer>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @livewireScripts
    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
