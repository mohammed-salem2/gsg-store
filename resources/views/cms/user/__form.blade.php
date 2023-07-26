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
        <x-input-form name="name" label="Name" :value="$users->name" />
    </div>
    <div class="form-group">
        <x-input-form type="email" name="email" label="Email" :value="$users->email" />
    </div>
    <div class="form-group">
        <x-input-form type="password" name="password" label="Password" :value="$users->password" />
    </div>
    <div class="row">
        <div class="form-group col-12">
            <x-select-form name="role" label="Choose Role" firstChoose="Choose Role" :parents="$roles" :parent-id="$users->role" />
        </div>
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $button }}</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
</div>
