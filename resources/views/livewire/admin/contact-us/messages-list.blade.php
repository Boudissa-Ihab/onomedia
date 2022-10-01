
<main class="content">
    <div class="container-fluid p-0">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-xl-12 col-xxl-12 d-flex">
                        <h5 class="card-title mb-0">Liste des messages</h5>
                    </div>
                </div>
            </div>
            @if($this->messages->count())
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell">Nom</th>
                            <th class="d-none d-sm-table-cell">Adresse mail</th>
                            <th class="d-none d-sm-table-cell">Sujet</th>
                            <th class="d-none d-sm-table-cell">Message</th>
                            <th class="d-none d-sm-table-cell">Status</th>
                            <th class="d-none d-sm-table-cell" style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($this->messages as $message)
                            <tr>
                                <td class="d-none d-sm-table-cell" wire:click="goToDetails({{ $message->id }})">
                                    @if($message->name != null)
                                        {{ $message->name }}
                                    @else
                                        /
                                    @endif
                                </td>
                                <td class="d-none d-sm-table-cell" wire:click="goToDetails({{ $message->id }})">{{ $message->email }}</td>
                                <td class="d-none d-sm-table-cell" wire:click="goToDetails({{ $message->id }})">{{ $message->subject }}</td>
                                <td class="d-none d-sm-table-cell" wire:click="goToDetails({{ $message->id }})">{{ Str::limit($message->message, 70) }}</td>
                                @if($message->read_at == null)
                                    <td wire:click="goToDetails({{ $message->id }})"><span class="badge bg-danger">Non lu</span></td>
                                @else
                                    <td wire:click="goToDetails({{ $message->id }})"><span class="badge bg-success">Lu</span></td>
                                @endif
                                <td class="d-none d-sm-table-cell" style="text-align: center;">
                                    <button class="btn btn-danger btn-sm"
                                        wire:click.prevent="$emit('triggerDelete', {{ $message->id }})">
                                        <i class="align-middle" data-feather="trash-2"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination justify-content-center mt-3">
                    {{ $this->messages->links() }}
                </div>
            @else
                <div class="d-flex flex-column align-items-center justify-content-center" style="height: 20rem">
                    <span style="font-size: 5em;" class="text-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    <div>Aucun message trouvé</div>
                </div>
            @endif
        </div>
    </div>
</main>
