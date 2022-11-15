<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Site vitrine d'Ono Design">
    <meta name="author" content="Boudissa Ihab
        Github : https://github.com/Boudissa-Ihab
        Linkedin : https://www.linkedin.com/in/ihab-boudissa-727346176/">
    <meta name="keywords" content="ono design, content, advertisement, design, logos">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="{{ asset("storage/logo/Logo.webp") }}" rel="icon">
    <link href="{{ asset("storage/logo/Logo.webp") }}" rel="apple-touch-icon">
    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />
    <title>@setting('app_name', "Ono Design")</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    @livewireStyles
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">

                    {{ $slot }}

                </div>
            </div>
        </div>
    </main>

    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
