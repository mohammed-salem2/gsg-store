{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

<div class="card-body">
    <div class="form-group">
        <x-input-form name="name" label="Name" :value="$roles->name" />
    </div>
    <div class="form-group">
        @foreach (config('abilities') as $key => $value)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $key }}" @if (in_array($key , $roles->abilities ?? []))
                    checked
                @endif name="abilities[]">
                <label class="form-check-label">
                    {{ $value }}
                </label>
            </div>
        @endforeach
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $button }}</button>
    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
</div>
