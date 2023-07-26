<thead>
    <tr>
        @foreach ($ths as $th )
        @if ($th == 'ID')
        <th style="width: 10px">{{ $th }}</th>
        @else
        <th>{{ $th }}</th>
        @endif
        @endforeach
    </tr>
</thead>
<tbody>
    @foreach ($parents as $parent)
    <tr>
        @foreach ($values as $value )
        @if ($value == "status")
        <td @if ($parent->status == 'active')
            class="badge badge-success"
        @endif class="badge badge-danger">{{ $parent->$value }}</td>
        @elseif ($value == "image")
        <td>
            <img src="{{ asset('storage/' .$parent->$value) }}" width="50">
        </td>
        @elseif ($value == "forign_id")
        <td>
            {{ $parent->$relation->name ?? " " }}
        </td>
        @else
        <td>{{ $parent->$value }}</td>
        @endif
        @endforeach
        <td>
            <div class="btn">
                @can('restore' , $parent)
                <a href="{{ route($restore , $parent->id) }}" class="btn btn-sm btn-info">
                    <i class="fas fa-trash-restore"></i>
                </a>
                @endcan
                @can('force-delete' , $parent)
                <form action="{{ route($destory , $parent->id) }}" method="GET">
                    @csrf
                    <button  type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
                @endcan
                {{-- <button onclick="performDestory({{ $admin->id  }} , this)" type="button" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                </button> --}}
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
