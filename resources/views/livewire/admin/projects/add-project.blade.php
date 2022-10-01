<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Ajouter un projet</h1>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informations sur le projet</h5>
                    </div>
                    <form method="POST" wire:submit.prevent="submit">
                        <div class="card-body">
                            <label class="mb-2" for="name">Nom</label>
                            <input wire:model.lazy="name" type="text" class="form-control"
                                name="name" placeholder="Entrer le nom du projet">
                            @error('name')
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="card-body">
                                    <label class="mb-2" for="category">Catégorie(s)</label>
                                    <select wire:model="category" name="category" class="form-control">
                                    <option value="">Selectionner une catégorie</option>
                                        @if($this->categories)
                                            @foreach ($this->categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('selectCategories')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @if(count($selectCategories))
                            <label class="mb-2" style="margin-left: 20px;">Catégories attribuées</label>
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <ul class="d-flex list-unstyled attributed-stats-list">
                                        @foreach ($selectCategories as $item)
                                            <button type="button" wire:click.prevent='unsetCategory({{ $item }})'>
                                                <span>{{ App\Models\Category::find($item)->name }}</span>
                                            </button>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="card-body">
                                    <label class="mb-2" for="date">Date de finition</label>
                                    <input wire:model.lazy="date" type="date" class="form-control"
                                        name="date" placeholder="Entrer la date de finition">
                                    @error('date')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="card-body">
                                    <label class="mb-2" for="client">Client</label>
                                    <input wire:model.lazy="client" type="text" class="form-control"
                                        name="client" placeholder="Entrer le nom du client">
                                    @error('client')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="card-body">
                                    <label class="mb-2" for="password">Lien du projet <sup>(optionel)</sup></label>
                                    <input wire:model.lazy="url" type="url" class="form-control"
                                        name="url" placeholder="Entrer un lien vers le projet">
                                    @error('url')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="card-body">
                                    <label class="mb-2" for="password_confirmation">Description</label>
                                    <textarea wire:model.lazy="description" class="form-control" rows="2" name="address"
                                        placeholder="Entrer une description du projet"></textarea>
                                    @error('description')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
