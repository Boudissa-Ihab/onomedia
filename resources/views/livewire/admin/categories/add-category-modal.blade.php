<div wire:ignore.self class="modal fade" id="add-category" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add">Ajouter une catégorie</h5>
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
