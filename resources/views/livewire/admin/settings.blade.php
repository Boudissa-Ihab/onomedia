<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Paramètres du site</h1>
        </div>
        <div class="row">
            <div class="col-md-8 col-xl-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informations personnelles</h5>
                    </div>
                    <div class="card-body h-100">
                        <form method="POST" wire:submit.prevent="save">
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <label class="mb-2" for="app_name">Nom du site</label>
                                    <input wire:model.lazy="app_name" type="text" class="form-control"
                                        name="app_name" placeholder="Entrer le nom complet">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-4">
                                    <label class="mb-2" for="email">Adresse mail</label>
                                    <input wire:model.lazy="email" type="email" class="form-control"
                                        name="email" placeholder="Entrer une adresse mail valide">
                                </div>
                                <div class="col-12 col-lg-6 mt-4">
                                    <label class="mb-2" for="phone">Numéro de téléphone</label>
                                    <input wire:model.lazy="phone" type="text" class="form-control"
                                        name="phone" placeholder="Entrer un numéro de téléphone">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-12 mt-4">
                                    <label class="mb-2" for="address">Adresse</label>
                                    <textarea wire:model.lazy="address" class="form-control" rows="2" name="address"
                                        placeholder="Entrer votre adresse professionnelle"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-12 mt-4">
                                    <label class="mb-2" for="description">Description du site</label>
                                    <textarea wire:model.lazy="description" class="form-control" rows="4" name="description"
                                        placeholder="Entrer une brève description sur le site"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-4">
                                    <label class="mb-2" for="facebook_link">Facebook</label>
                                    <input wire:model.lazy="facebook_link" type="text" class="form-control"
                                        name="facebook_link" placeholder="Entrer le lien de votre page Facebook">
                                </div>
                                <div class="col-12 col-lg-6 mt-4">
                                    <label class="mb-2" for="instagram_link">Instagram</label>
                                    <input wire:model.lazy="instagram_link" type="text" class="form-control"
                                        name="instagram_link" placeholder="Entrer le lien de votre page Instagram">
                                </div>
                            </div>
                            <hr class="mt-5">
                            <h5 class="card-title">Horaires de travail</h5>
                            @foreach($this->availability as $key => $value)
                                <div class="row">
                                    <div class="col-12 col-lg-6 mt-4">
                                        <label class="mb-2">{{ $key }}: Ouverture</label>
                                        <input wire:model.lazy="availability.{{ $key }}.opening_time" type="time" class="form-control"
                                            name="opening_time[{{ $key }}]" placeholder="Heure d'ouverture">
                                    </div>
                                    <div class="col-12 col-lg-6 mt-4">
                                        <label class="mb-2">{{ $key }}: Fermeture</label>
                                        <input wire:model.lazy="availability.{{ $key }}.closing_time" type="time" class="form-control"
                                            name="closing_time[{{ $key }}]" placeholder="Heure de fermeture">
                                    </div>
                                </div>
                            @endforeach
                            <button class="btn btn-primary mt-3 btn-lg" type="submit"
                                style="float:right; margin-bottom: 10px;">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Logo du site</h5>
                    </div>
                    <div class="card-body text-center">
                        @if($temporaryLogo && !$logo)
                            <img src="{{ asset('storage/logo/' .$temporaryLogo) }}" alt="{{ setting('app_name', "Ono Design") }}" class="img-fluid rounded-circle mb-2" />
                        @endif
                        @if($logo)
                            <img src="{{ $logo->temporaryUrl() }}" class="img-fluid rounded-circle mb-2" alt="{{ setting('app_name', "Ono Design") }}">
                        @endif
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
                                    <input wire:model="logo" type="file" class="upload-logo"
                                        accept=".webp,.jpeg,.jpg,.png,.svg,.bmp"/>
                                    <!-- Progress Bar -->
                                    <div x-show="isUploading">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                </div>
                                @error('logo')
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
        </div>
    </div>
</main>
