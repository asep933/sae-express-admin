@extends('layouts.admin')

@section('title', 'Tracking')

@section('main')
<div class="row">
    <div class="col-6"></div>
    <div class="col-6">
        @permission('shipment.create')
        <a href="{{ route('admin.shipment.index') }}" class="mt-3 btn btn-primary float-right">
            <i class="fas fa-plus mr-1"></i>
            {{ __('New Label') }}
        </a>
        @endpermission
    </div>
</div>
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
                <h3 class="card-title">Shipments AWB Lists</h3>
            </div>

            <div class="card-body">
                <form class="mb-3" action="{{ route('export.tracking') }}" method="GET">
                    <input type="hidden" name="created_at" value="{{ request('created_at') }}">
                    <button type="submit" class="btn btn-sm btn-success">
                        <i class="fas fa-file-excel"></i> Export to Excel
                    </button>
                </form>

                <div class="table-responsive">

                    <div id="dataTable_length" class="mb-3">
                        <form method="POST" action="{{route('filter.process-tracking')}}">
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

                    <table id="datatables" data-route="{{ route('admin.tracking.index') }}"
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
@endsection