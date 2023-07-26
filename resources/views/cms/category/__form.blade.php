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
        <x-input-form name="name" label="Name" :value="$categories->name" />
    </div>
    <div class="row">
        <div class="form-group col-12 col-md-6">
            <x-select-form name="parent_id" label="Choose Parent" firstChoose="No Parent" :parents="$parents" :parent-id="$categories->parent_id" />
        </div>
        <div class="form-group col-12 col-md-6">
            <x-select-fix-form name="status" label="Choose Status" :status="$categories->status" />
        </div>
    </div>
    <div class="form-group">
        <x-text-area-form name="description" label="Enter Description" :desc="$categories->description" />
    </div>
    <div class="form-group">
        <x-input-form type="file" name="image" label="Choose Image" />
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $button }}</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
</div>
