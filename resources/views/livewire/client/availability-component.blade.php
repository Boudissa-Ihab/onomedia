<div class="col-lg-2 col-md-6 footer-links">
    <h4>Horaires de travail</h4>
    <ul>
        @foreach($this->availability as $key => $value)
            <li><i class="bx bx-chevron-right"></i> {{ $key }} : {{ $value['opening_time'] }} - {{ $value['closing_time'] }}</li>
        @endforeach
    </ul>
</div>
