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
        <x-input-form name="name" label="Enter Name" :value="$products->name" />
    </div>
    <div class="form-group">
        <x-input-form type="number" name="price" label="Enter Price" :value="$products->price" />
    </div>
    <div class="form-group">
        <x-input-form type="number" name="sale_price" label="Enter Sale Price" :value="$products->sale_price" />
    </div>
    <div class="form-group">
        <x-input-form type="number" name="quantity" label="Enter Quantity" :value="$products->quantity" />
    </div>
    <div class="form-group">
        <x-input-form type="number" name="length" label="Enter Length" :value="$products->length" />
    </div>
    <div class="form-group">
        <x-input-form type="number" name="width" label="Enter Width" :value="$products->width" />
    </div>
    <div class="form-group">
        <x-input-form type="number" name="height" label="Enter Height" :value="$products->height" />
    </div>
    <div class="form-group">
        <x-input-form type="number" name="weight" label="Enter Weight" :value="$products->weight" />
    </div>
    <div class="form-group">
        <x-input-form  name="sku" label="Enter Sku" :value="$products->sku" />
    </div>
    <div class="row">
        <div class="form-group col-12 col-md-6">
            <x-select-form name="category_id" label="Choose Category" firstChoose="Choose Category" :parents="$categories" :parent-id="$products->category_id" />
        </div>
        <div class="form-group col-12 col-md-6">
            <x-select-fix-form name="status" label="Choose Status" :status="$products->status" />
        </div>
    </div>

    <div class="form-group">
        <x-text-area-form name="description" label="Enter Description" :desc="$products->description" />
    </div>
    <div class="form-group">
        <x-input-form type="file" name="image" label="Choose Image" />
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $button }}</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
</div>
