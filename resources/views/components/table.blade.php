<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route($createRoute) }}" class="btn btn-primary float-right">
            <i class="fas fa-fw fa-plus-circle"></i> Tambah Data
        </a>
        <h5 class="m-0 font-weight-bold text-primary">{{ $title }}</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        @foreach ($columns as $column)
                            <th>{{ $column['label'] }}</th>
                        @endforeach
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        @foreach ($columns as $column)
                            <th>{{ $column['label'] }}</th>
                        @endforeach
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse ($data as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            @foreach ($columns as $column)
                                @if (!empty($column['html']) && $column['html'])
                                    <td>{!! $item[$column['field']] !!}</td>
                                @else
                                    <td>{{ $item[$column['field']] }}</td>
                                @endif
                            @endforeach
                            <td class="d-flex gap-1">
                                <a href="{{ route($showRoute, $item['id']) }}" class="btn btn-sm btn-info m-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route($editRoute, $item['id']) }}" class="btn btn-sm btn-primary m-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm m-1"
                                    onclick="confirmDelete('{{ route($deleteRoute, $item['id']) }}', '{{ $item[$columns[0]['field']] }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($columns) + 2 }}" class="text-center">Data Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(url, name) {
        document.getElementById('dataName').innerText = name;
        document.getElementById('deleteForm').action = url;

        var confirmModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        confirmModal.show();
    }
</script>
