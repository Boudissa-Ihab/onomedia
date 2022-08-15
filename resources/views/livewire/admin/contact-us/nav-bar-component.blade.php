<li class="nav-item dropdown">
    <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown"
        data-bs-toggle="dropdown">
        <div class="position-relative">
            <i class="align-middle" data-feather="message-square"></i>
            @if($this->messages->count())
                <span class="indicator">
                    {{ $this->messages->count() }}
                </span>
            @endif
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
        aria-labelledby="messagesDropdown">
        <div class="dropdown-menu-header">
            <div class="position-relative">
                {{ $this->messages->count() }} Nouveau(x) message(s)
            </div>
        </div>
        <div class="list-group">
            @if($this->messages->count())
                @foreach ($this->messages as $message)
                    <a href="{{ route('admin.messages.message-details', ['message' => $message]) }}"
                        class="list-group-item" wire:click.prevent="$emit('readMessage', {{ $message->id }})">
                        <div class="row g-0 align-items-center">
                            <div class="col-12 ps-2">
                                <div class="text-dark">{{ $message->name }}</div>
                                <div class="text-muted small mt-1"><b>{{ Str::limit($message->message, 100) }}</b></div>
                                <div class="text-muted small mt-1">{{ $message->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
        <div class="dropdown-menu-footer">
            <a href="{{ route('admin.messages') }}" class="text-muted">Afficher tous les messages</a>
        </div>
    </div>
</li>
