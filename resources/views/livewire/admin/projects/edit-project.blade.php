<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Modifier un projet</h1>
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
                                        style="float:right; margin-bottom: 10px;">Modifier</button>
                                </div>
                            </div>
                        </div>

                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Photos du projet</h5>
                                </div>
                                <div class="file-upload blue-btn btn width100">
                                    <span>Choisir des photos</span>
                                    <div
                                    x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <!-- File Input -->
                                        <input wire:model="selectPhotos" type="file" class="upload-logo"
                                        name="photo" accept=".webp,.jpeg,.jpg,.png,.svg,.bmp" multiple/>
                                        <!-- Progress Bar -->
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>
                                    @error('selectPhotos')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="container" wire:ignore>
                            <div class="product-img-gallery">
                                <div class="row justify-content-center">
                                    <div class="col-md-10">
                                        @if(count($this->images))
                                            <div class="main-img-wrapper"
                                                style="width: 50%; height: auto; margin: auto; padding: 10px; position: relative;">
                                                <div id="sync1" class="main-img-wrapper-carousel owl-carousel owl-theme">
                                                    @foreach ($this->images as $image)
                                                        <div class="item">
                                                            <img src="{{ asset('storage/projects/' . $project->name . '/' . $image->url) }}" class="zoom" alt="Image">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="img-thumbs mt-4 d-flex">
                                                <div id="sync2" class="img-thumbs-carousel owl-carousel owl-theme">
                                                    @foreach ($this->images as $image)
                                                        <div class="item">
                                                            <div class="img-thumbs-item">
                                                                <img src="{{ asset('storage/projects/' . $project->name . '/' . $image->url)}}" alt="Image">
                                                                <button class="delet-btn" wire:click.prevent="$emit('triggerDelete', {{ $image->id }})"
                                                                    title="Supprimer l'image">X</button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            <div class="d-flex flex-column align-items-center justify-content-center" style="height: 20rem">
                                                <span style="font-size: 5em;" class="text-danger">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </span>
                                                <div>Aucune image trouvée</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
