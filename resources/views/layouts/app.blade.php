<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Site vitrine d'Onomedia">
    <meta name="author"
        content="Boudissa Ihab
        Github : https://github.com/Boudissa-Ihab
        Linkedin : https://www.linkedin.com/in/ihab-boudissa-727346176/">
    <meta name="keywords" content="onomedia, content, advertisement, design, logos">
    <title>Onomedia</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    @livewireStyles
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
                    <span class="align-middle">Onomedia</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Gestion du site
                    </li>

                    <li class="sidebar-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                            <i class="align-middle" data-feather="layout"></i>
                            <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('admin/admins/*') || Request::is('admin/admins') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.admins') }}">
                            <i class="align-middle" data-feather="users"></i>
                            <span class="align-middle">Administrateurs</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::is('admin/settings') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.settings') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Paramètres</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Contact
                    </li>

                    <li class="sidebar-item {{ Request::is('admin/messages/*') || Request::is('admin/messages') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.messages') }}">
                            <i class="align-middle" data-feather="mail"></i> <span
                                class="align-middle">Boîte de messagerie</span>
                        </a>
                    </li>

                    {{-- <li class="sidebar-item">
                        <a class="sidebar-link" href="maps-google.html">
                            <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown"
                                data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                                aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">
                                    4 New Notifications
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Update completed</div>
                                                <div class="text-muted small mt-1">Restart server 12 to complete the
                                                    update.</div>
                                                <div class="text-muted small mt-1">30m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Lorem ipsum</div>
                                                <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate
                                                    hendrerit et.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-primary" data-feather="home"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Login from 192.186.1.8</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-success" data-feather="user-plus"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">New connection</div>
                                                <div class="text-muted small mt-1">Christina accepted your request.
                                                </div>
                                                <div class="text-muted small mt-1">14h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all notifications</a>
                                </div>
                            </div>
                        </li> --}}

                        @livewire("admin.contact-us.nav-bar-component")

                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>
                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/admins/' .auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" class="avatar img-fluid rounded me-1" />
                                @else
                                    <img src="{{ asset('images/empty-placeholder.png') }}" class="avatar img-fluid rounded me-1" alt="Pas de photo de profil">
                                @endif
                                <span class="text-dark">{{ auth()->user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                    <i class="align-middle me-1" data-feather="user"></i> Mon Profil</a>
                                {{-- <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                        data-feather="pie-chart"></i> Analytics</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.html"><i class="align-middle me-1"
                                        data-feather="settings"></i> Settings & Privacy</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                        data-feather="help-circle"></i> Help Center</a>
                                <div class="dropdown-divider"></div> --}}
                                <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                    <i class="align-middle me-1" data-feather="log-out"></i> Déconnexion</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            {{ $slot }}

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="javascript:void(0)">
                                    <strong>Onomedia {{ date("Y") }} </strong></a> &copy;
                            </p>
                        </div>
                        {{-- <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @include('sweetalert::alert')
    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('triggerDelete', (
                records, event = "deleteRecords") => {
                Swal.fire({
                    title: @json('Suppression de donnée'),
                    text: @json('Êtes-vous sûr de vouloir supprimer cette donnée ?'),
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: @json('Confirmer'),
                    cancelButtonText: @json('Annuler')
                }).then((result) => {
                    if (result.value) {
                        Livewire.emit(event, records);
                    } else {
                        Swal.fire({
                            title: @json('Opération annulée'),
                            icon: 'warning'
                        });
                    }
                });
            });
            Livewire.on('showAlert', (
                params
            ) => {
                Swal.fire({
                    title: params.title,
                    text: params.text,
                    icon: params.icon
                });
                if (params.modal)
                    $(`#${params.modal}`).modal('hide')
            });
        })
    </script>
    @stack('scripts')

</body>
</html>
