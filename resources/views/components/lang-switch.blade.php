<div class="dropdown show">
    <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-language"></i>
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        @foreach ($langs as $key => $value )
        <a class="dropdown-item" href="{{ URL::current() }}?lang={{ $key }}">{{ $value }}</a>
        @endforeach
    </div>
</div>
