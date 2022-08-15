<div class="d-table-cell align-middle">
    <div class="text-center mt-4">
        <h1 class="h2">Dashboard ONOMEDIA</h1>
        <p class="lead"></p>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="m-sm-4">
                <form wire:submit.prevent="login" method="POST" role="form">
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input wire:model.lazy="email" class="form-control form-control-lg"
                            type="email" name="email" placeholder="Entrer une adresse mail" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">Mot de passe</label>
                        <input wire:model.lazy="password" class="form-control form-control-lg"
                            type="password" name="password" placeholder="Entrer le mot de passe" />
                    </div>
                    <div>
                        <label class="form-check">
                            <input wire:model="remember" class="form-check-input"
                                type="checkbox" value="remember-me" name="remember-me">
                            <span class="form-check-label">
                                Se souvenir de moi
                            </span>
                        </label>
                    </div>
                    @if(session()->has('error'))
                        <p class="form-error-message mt-3" style="margin-left: 20px;">{{ session()->get('error') }}</p>
                    @endif
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-lg btn-primary">
                            <i class="fa fa-spin fa-spinner" wire:loading wire:target="login"></i>
                            Se connecter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
