
<main class="content">
    <div class="container-fluid p-0">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="row">
                    <div class="col-7 col-sm-7 col-md-8 col-xl-10 col-xxl-10 d-flex">
                        <h5 class="card-title mb-0">Liste des projets</h5>
                    </div>
                    <div class="col-5 col-sm-5 col-md-4 col-xl-2 col-xxl-2 d-flex">
                        <a href="{{ route('admin.projects.create') }}">
                            <button class="btn btn-lg btn-primary">
                                <i class="align-middle" data-feather="plus"></i> Ajouter un projet
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            @if($this->projects->count())
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell">Nom</th>
                            <th class="d-none d-sm-table-cell">Date</th>
                            <th class="d-none d-sm-table-cell">Client</th>
                            <th class="d-none d-sm-table-cell">Catégories</th>
                            <th class="d-none d-sm-table-cell" style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($this->projects as $project)
                            <tr>
                                <td class="d-none d-sm-table-cell">{{ $project->name }}</td>
                                <td class="d-none d-sm-table-cell">{{ $project->date }}</td>
                                <td class="d-none d-sm-table-cell">{{ $project->client }}</td>
                                <td class="d-none d-sm-table-cell">
                                    @foreach ($project->categories as $category)
                                        @if ($loop->last)
                                            {{ $category->name }}
                                        @else
                                            {{ $category->name }} /
                                        @endif
                                    @endforeach
                                </td>
                                <td class="d-none d-sm-table-cell" style="text-align: center;">
                                    <a href="{{ route('admin.projects.edit', ['project' => $project]) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="align-middle" data-feather="edit-2"></i>
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm"
                                        wire:click.prevent="$emit('triggerDelete', {{ $project->id }})">
                                        <i class="align-middle" data-feather="trash-2"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination justify-content-center mt-3">
                    {{ $this->projects->links() }}
                </div>
            @else
                <div class="d-flex flex-column align-items-center justify-content-center" style="height: 20rem">
                    <span style="font-size: 5em;" class="text-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    <div>Aucun projet trouvé</div>
                </div>
            @endif
        </div>
    </div>
</main>
