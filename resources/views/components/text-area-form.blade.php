<label for="{{ $id ?? $name }}">{{ $label }}</label>
        <textarea class="form-control @error($name)
        is-invalid
    @enderror" rows="3" placeholder="{{ $label }}" id="{{ $id ?? $name }}" name="{{ $name }}">{{ old($name , $desc) }}</textarea>
        @error($name)
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror
