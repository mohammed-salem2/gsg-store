<label for="{{ $id ?? $name }}">{{ $label }}</label>
            <select class="custom-select form-control-border @error($name)
            is-invalid
        @enderror" id="{{ $id ?? $name }}" name="{{ $name }}">
                <option value="active" @if (old($name , $status) == 'active') selected @endif>Active</option>
                <option value="draft" @if (old($name , $status) == 'draft') selected @endif>Draft</option>
            </select>
            @error($name)
            <p class="text-danger">{{ $message }}</p>
            @enderror
