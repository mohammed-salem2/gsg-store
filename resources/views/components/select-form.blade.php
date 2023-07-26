<label for="{{ $id ?? $name }}">{{ __($label) }}</label>
            <select class="custom-select form-control-border @error($name)
            is-invalid
        @enderror " id="{{ $id ?? $name }}" name="{{ $name }}">
                <option value=" ">{{ $firstChoose}}</option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id}}" @if ($parent->id == old($name , $parentId)) selected @endif>
                        {{ $parent->name }}</option>
                @endforeach
            </select>
            @error($name)
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
