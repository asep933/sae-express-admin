@extends('layouts.admin')

@section('title', 'Dashboard')

@section('main')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">
            <i class="fas fa-smile"></i> Selamat Datang
        </h3>
    </div>
    <div class="card-body">
        <p class="text-center">
            <strong>{{ $user->email ?? 'Pengguna' }}</strong>, selamat datang di aplikasi {{config('app.name')}}.
        </p>
        <p class="text-muted text-center">
            Semoga harimu menyenangkan!
        </p>
    </div>
</div>

@permission('trackings.read')
<div class="row">
    <div class="col-12 mt-2">
        @include('layouts.shared.alert')
    </div>
</div>
{{ csrf_field() }}
{{ method_field('DELETE') }}
<div class="row">
    <div class="col-12">
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Shipments Lists</h3>
            </div>
            <div class="card-body">

                <div id="dataTable_length" class="mb-3">
                    <label for="filter-created-at">Filter:</label>
                    <form action="{{route('filter.process')}}" method="post">
                        @csrf
                        <select id="filter-created-at" name="created_at" class="form-control form-control-sm" style="width: auto; display: inline-block;">
                            <option value="">All</option>
                            @foreach($uniqueMonths as $month)
                            <option value="{{ $month }}">
                                {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y') }}
                            </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-sm btn-default">Filter</button>
                    </form>
                </div>

                <div class="table-responsive">
                    <table id="datatables" data-route="{{ route('admin.dashboard.index') }}"
                        data-configs="{{ json_encode($tableConfigs) }}" class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                @for ($i = 0; $i < count($tableConfigs); $i++)
                                    <th>{{ $tableConfigs[$i]['name'] }}</th>
                                    @endfor
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="delete-modal" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content" id="delete-form">
        </div>
    </div>
</div>
@endpermission

@endsection