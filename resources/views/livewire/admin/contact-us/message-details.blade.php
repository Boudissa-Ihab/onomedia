<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Détails du message</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informations personnelles</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Nom :
                            <b>
                                @if($this->message->name != null)
                                    {{ $this->message->name }}
                                @else
                                    /
                                @endif
                            </b>
                        </p>
                        <p class="card-text">Email :
                            <a href="mailto:{{ $this->message->email }}">
                                <b>{{ $this->message->email }}</b>
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Contenu du message</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $this->message->message }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
