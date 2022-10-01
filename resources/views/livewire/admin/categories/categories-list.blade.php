
<main class="content">
    <div class="container-fluid p-0">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="row">
                    <div class="col-7 col-sm-7 col-md-8 col-xl-10 col-xxl-10 d-flex">
                        <h5 class="card-title mb-0">Liste des catégories</h5>
                    </div>
                    <div class="col-5 col-sm-5 col-md-4 col-xl-2 col-xxl-2 d-flex">
                        <a href="javascript:void(0)" type="button" class="btn btn-lg btn-primary" data-target="#add-category"
                            data-toggle="modal" title="Add" role="button" aria-pressed="true">
                            <i class="align-middle" data-feather="plus"></i> Ajouter une catégorie
                        </a>
                    </div>
                </div>
            </div>
            @if($this->categories->count())
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell">Nom</th>
                            <th class="d-none d-sm-table-cell">Nombre de projets</th>
                            <th class="d-none d-sm-table-cell" style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($this->categories as $category)
                            <tr>
                                <td class="d-none d-sm-table-cell">{{ $category->name }}</td>
                                <td class="d-none d-sm-table-cell">{{ $category->projects_count }}</td>
                                <td class="d-none d-sm-table-cell" style="text-align: center;">
                                    <a href="" class="btn btn-warning btn-sm" data-target="#edit-category"
                                        data-toggle="modal" title="Edit" aria-pressed="true"
                                        wire:click.prevent="setCategory({{ $category->id }})">
                                        <i class="align-middle" data-feather="edit-2"></i>
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm"
                                        wire:click.prevent="$emit('triggerDelete', {{ $category->id }})">
                                        <i class="align-middle" data-feather="trash-2"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination justify-content-center mt-3">
                    {{ $this->categories->links() }}
                </div>
            @else
                <div class="d-flex flex-column align-items-center justify-content-center" style="height: 20rem">
                    <span style="font-size: 5em;" class="text-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    <div>Aucune catégorie trouvée</div>
                </div>
            @endif
        </div>
    </div>
    @livewire('admin.categories.add-category-modal')

    <div wire:ignore.self class="modal fade" id="edit-category" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit">Modifier une catégorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" wire:submit.prevent="submit">
                        <label class="mb-2" for="name">Nom</label>
                        <input wire:model.lazy="name" type="text" class="form-control"
                            name="name" placeholder="Entrer le nom de catégorie" autofocus autocomplete>
                        @error('name')
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-primary" wire:click="submit()" data-dismiss="modal" role="button">Confirmer</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
