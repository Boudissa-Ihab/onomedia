<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Bienvenue "{{ auth()->user()->name }}"</h1>
        </div>
        <div class="row">
            <div class="col-md-4 col-xl-3">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Photo de profil</h5>
                    </div>
                    <div class="card-body text-center">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/admins/' .auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                        @else
                            <img src="{{ asset('images/empty-placeholder.png') }}" class="img-fluid rounded-circle mb-2" alt="Pas de photo de profil" width="128" height="128">
                        @endif
                        <h5 class="card-title mb-1">{{ auth()->user()->name }}</h5>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="file-upload blue-btn btn width100">
                                <span>Choisir une photo</span>
                                <div
                                x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <!-- File Input -->
                                    <input wire:model="avatar" type="file" class="upload-logo"
                                        accept=".webp,.jpeg,.jpg,.png,.svg,.bmp"/>
                                    <!-- Progress Bar -->
                                    <div x-show="isUploading">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                </div>
                                @error('avatar')
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </form>
                    </div>
                    {{-- <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">Skills</h5>
                        <a href="#" class="badge bg-primary me-1 my-1">HTML</a>
                        <a href="#" class="badge bg-primary me-1 my-1">JavaScript</a>
                        <a href="#" class="badge bg-primary me-1 my-1">Sass</a>
                        <a href="#" class="badge bg-primary me-1 my-1">Angular</a>
                        <a href="#" class="badge bg-primary me-1 my-1">Vue</a>
                        <a href="#" class="badge bg-primary me-1 my-1">React</a>
                        <a href="#" class="badge bg-primary me-1 my-1">Redux</a>
                        <a href="#" class="badge bg-primary me-1 my-1">UI</a>
                        <a href="#" class="badge bg-primary me-1 my-1">UX</a>
                    </div> --}}
                    {{-- <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">About</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives in <a href="#">San Francisco, SA</a></li>

                            <li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> Works at <a href="#">GitHub</a></li>
                            <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> From <a href="#">Boston</a></li>
                        </ul>
                    </div> --}}
                    {{-- <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">Elsewhere</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><a href="#">staciehall.co</a></li>
                            <li class="mb-1"><a href="#">Twitter</a></li>
                            <li class="mb-1"><a href="#">Facebook</a></li>
                            <li class="mb-1"><a href="#">Instagram</a></li>
                            <li class="mb-1"><a href="#">LinkedIn</a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>

            <div class="col-md-8 col-xl-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informations personnelles</h5>
                    </div>
                    <div class="card-body h-100">
                        <form method="POST" wire:submit.prevent="editInfo">
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <label class="mb-2" for="name">Nom</label>
                                    <input wire:model.lazy="name" type="text" class="form-control"
                                        name="name" placeholder="Entrer le nom complet">
                                    @error('name')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-4">
                                    <label class="mb-2" for="email">Adresse mail</label>
                                    <input wire:model.lazy="email" type="email" class="form-control"
                                        name="email" placeholder="Entrer une adresse mail valide">
                                    @error('email')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg-6 mt-4">
                                    <label class="mb-2" for="phone">Numéro de téléphone</label>
                                    <input wire:model.lazy="phone" type="tel" class="form-control"
                                        name="phone" placeholder="Entrer un numéro de téléphone valide">
                                    @error('phone')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <button class="btn btn-primary mt-3 btn-lg" type="submit"
                                        style="float:right; margin-bottom: 10px;">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                    <div class="card-header">
                        <h5 class="card-title mb-0">Réinitialisation du mot de passe</h5>
                    </div>
                    <div class="card-body h-100">
                        <form method="POST" wire:submit.prevent="resetPassword">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <label class="mb-2" for="old_password">Mot de passe actuel</label>
                                    <input wire:model.lazy="old_password" type="password" class="form-control"
                                        name="old_password" placeholder="Entrer le mot de passe courant">
                                    @error('old_password')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-4">
                                    <label class="mb-2" for="password">Nouveau mot de passe</label>
                                    <input wire:model.lazy="password" type="password" class="form-control"
                                        name="password" placeholder="Entrer un nouveau mot de passe">
                                    @error('password')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg-6 mt-4">
                                    <label class="mb-2" for="password_confirmation">Confirmer le mot de passe</label>
                                    <input wire:model.lazy="password_confirmation" type="password" class="form-control"
                                        name="password_confirmation" placeholder="Confirmer le mot de passe">
                                    <button class="btn btn-primary mt-3 btn-lg" type="submit"
                                        style="float:right; margin-bottom: 10px;">Modifier</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
