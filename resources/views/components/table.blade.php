<thead>
    <tr>
        @foreach ($ths as $th)
            @if ($th == 'ID')
                <th style="width: 10px">{{ __($th) }}</th>
            @else
                <th>{{ __($th) }}</th>
            @endif
        @endforeach
    </tr>
</thead>
<tbody>
    @foreach ($parents as $parent)
    @if($table == 'product')
    @if (auth()->user()->role == 1)
    <tr>
        @foreach ($values as $value)
            @if ($value == 'status')
                <td @if ($parent->status == 'active') class="badge badge-success" @endif class="badge badge-danger">
                    {{ $parent->$value }}</td>
            @elseif ($value == 'image_url')
                <td>
                    <img src="{{ $parent->$value }}" width="50">
                </td>
            @elseif ($value == 'forign_id')
                <td>
                    {{ $parent->$relation->name ?? ' ' }}
                </td>
            @else
                <td>{{ $parent->$value }}</td>
            @endif
        @endforeach
        {{-- <td>
            {{ $parent->user->name ?? "No User" }}
        </td> --}}
            <td>
                {{ $parent->admin_data['name'] ?? "Not Found" }}
            </td>
        <td>
            <div class="btn">
                @can('update', $parent)
                    <a href="{{ route($edit, $parent->id) }}" class="btn btn-sm btn-info">
                        <i class="fas fa-edit"></i>
                    </a>
                @endcan
                <a href="{{ route($show, $parent->id) }}" class="btn btn-sm btn-success">
                    <i class="fas fa-eye"></i>
                </a>
                <form action="{{ route($destory, $parent->id) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
                {{-- <button onclick="performDestory({{ $admin->id  }} , this)" type="button" class="btn btn-danger">
                <i class="fas fa-trash"></i>
            </button> --}}
            </div>
        </td>
    </tr>
    {{-- @elseif ($parent->admin_data['id'] == auth()->user()->id) --}}
    @elseif ($parent->user_id == auth()->user()->id)
    <tr>
        @foreach ($values as $value)
            @if ($value == 'status')
                <td @if ($parent->status == 'active') class="badge badge-success" @endif class="badge badge-danger">
                    {{ $parent->$value }}</td>
            @elseif ($value == 'image_url')
                <td>
                    <img src="{{ $parent->$value }}" width="50">
                </td>
            @elseif ($value == 'forign_id')
                <td>
                    {{ $parent->$relation->name ?? ' ' }}
                </td>
            @else
                <td>{{ $parent->$value }}</td>
            @endif
        @endforeach
        {{-- <td>
            {{ $parent->user->name ?? "No User" }}
        </td> --}}
            <td>
                {{ $parent->admin_data['name'] ?? "Not Found" }}
            </td>
        <td>
            <div class="btn">
                @can('update', $parent)
                    <a href="{{ route($edit, $parent->id) }}" class="btn btn-sm btn-info">
                        <i class="fas fa-edit"></i>
                    </a>
                @endcan
                <a href="{{ route($show, $parent->id) }}" class="btn btn-sm btn-success">
                    <i class="fas fa-eye"></i>
                </a>
                <form action="{{ route($destory, $parent->id) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
                {{-- <button onclick="performDestory({{ $admin->id  }} , this)" type="button" class="btn btn-danger">
                <i class="fas fa-trash"></i>
            </button> --}}
            </div>
        </td>
    </tr>
    @endif
    @else
    <tr>
        @foreach ($values as $value)
            @if ($value == 'status')
                <td @if ($parent->status == 'active') class="badge badge-success" @endif class="badge badge-danger">
                    {{ $parent->$value }}</td>
            @elseif ($value == 'image_url')
                <td>
                    <img src="{{ $parent->$value }}" width="50">
                </td>
            @elseif ($value == 'forign_id')
                <td>
                    {{ $parent->$relation->name ?? ' ' }}
                </td>
            @else
                <td>{{ $parent->$value }}</td>
            @endif
        @endforeach
        {{-- <td>
            {{ $parent->user->name ?? "No User" }}
        </td> --}}
            <td>
                {{ $parent->admin_data['name'] ?? "Not Found" }}
            </td>
        <td>
            <div class="btn">
                @can('update', $parent)
                    <a href="{{ route($edit, $parent->id) }}" class="btn btn-sm btn-info">
                        <i class="fas fa-edit"></i>
                    </a>
                @endcan
                <a href="{{ route($show, $parent->id) }}" class="btn btn-sm btn-success">
                    <i class="fas fa-eye"></i>
                </a>
                <form action="{{ route($destory, $parent->id) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
                {{-- <button onclick="performDestory({{ $admin->id  }} , this)" type="button" class="btn btn-danger">
                <i class="fas fa-trash"></i>
            </button> --}}
            </div>
        </td>
    </tr>
    @endif
    @endforeach
</tbody>

