<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Ajouter un administrateur</h1>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informations personnelles</h5>
                    </div>
                    <form method="POST" wire:submit.prevent="submit">
                        <div class="card-body">
                            <label class="mb-2" for="name">Nom</label>
                            <input wire:model.lazy="name" type="text" class="form-control"
                                name="name" placeholder="Entrer le nom complet">
                            @error('name')
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="card-body">
                                    <label class="mb-2" for="email">Adresse mail</label>
                                    <input wire:model.lazy="email" type="email" class="form-control"
                                        name="email" placeholder="Entrer une adresse mail valide">
                                    @error('email')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="card-body">
                                    <label class="mb-2" for="phone">Numéro de téléphone</label>
                                    <input wire:model.lazy="phone" type="tel" class="form-control"
                                        name="phone" placeholder="Entrer un numéro de téléphone valide">
                                    @error('phone')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="card-body">
                                    <label class="mb-2" for="password">Mot de passe</label>
                                    <input wire:model.lazy="password" type="password" class="form-control"
                                        name="password" placeholder="Entrer un mot de passe">
                                    @error('password')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="card-body">
                                    <label class="mb-2" for="password_confirmation">Confirmer le mot de passe</label>
                                    <input wire:model.lazy="password_confirmation" type="password" class="form-control"
                                        name="password_confirmation" placeholder="Confirmer le mot de passe">
                                    <button class="btn btn-primary mt-3 btn-lg" type="submit"
                                        style="float:right; margin-bottom: 10px;">Ajouter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
