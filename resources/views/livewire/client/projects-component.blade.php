<div class="col-lg-2 col-md-6 footer-links">
    <h4>Nos projets</h4>
    <ul>
        @foreach($this->projects as $project)
            <li><i class="bx bx-chevron-right"></i>
                <a href="{{ route('projects.project', ['project' => $project]) }}">{{ $project->name }}</a>
            </li>
        @endforeach
    </ul>
</div>
