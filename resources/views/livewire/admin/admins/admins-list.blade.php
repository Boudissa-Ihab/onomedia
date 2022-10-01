
<main class="content">
    <div class="container-fluid p-0">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="row">
                    <div class="col-7 col-sm-7 col-md-8 col-xl-10 col-xxl-10 d-flex">
                        <h5 class="card-title mb-0">Liste des administrateurs</h5>
                    </div>
                    <div class="col-5 col-sm-5 col-md-4 col-xl-2 col-xxl-2 d-flex">
                        <a href="{{ route('admin.admins.create') }}">
                            <button class="btn btn-lg btn-primary">
                                <i class="align-middle" data-feather="plus"></i> Ajouter un administrateur
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            @if($this->admins->count())
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell">Nom</th>
                            <th class="d-none d-sm-table-cell">Adresse mail</th>
                            <th class="d-none d-sm-table-cell">Numéro de téléphone</th>
                            <th class="d-none d-sm-table-cell" style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($this->admins as $admin)
                            <tr>
                                <td class="d-none d-sm-table-cell">{{ $admin->name }}</td>
                                <td class="d-none d-sm-table-cell">{{ $admin->email }}</td>
                                <td class="d-none d-sm-table-cell">{{ $admin->phone }}</td>
                                <td class="d-none d-sm-table-cell" style="text-align: center;">
                                    {{-- <button class="btn btn-info btn-sm"><i class="align-middle" data-feather="info"></i></button> --}}
                                    @if (auth()->id() != $admin->id)
                                        <button class="btn btn-danger btn-sm"
                                            wire:click.prevent="$emit('triggerDelete', {{ $admin->id }})">
                                            <i class="align-middle" data-feather="trash-2"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination justify-content-center mt-3">
                    {{ $this->admins->links() }}
                </div>
            @else
                <div class="d-flex flex-column align-items-center justify-content-center" style="height: 20rem">
                    <span style="font-size: 5em;" class="text-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    <div>Aucun admin trouvé</div>
                </div>
            @endif
        </div>
    </div>
</main>
