@extends('layouts.admin')

@section('title', 'Filter')

@section('main')

<div class="row">
    <div class="col-12 mt-2">
        @include('layouts.shared.alert')
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mt-3">
            <form class="m-3" action="{{ route('export.tracking-filter') }}" method="GET">
                <input type="hidden" name="created_at" value="{{ $month }}">
                <button type="submit" class="btn btn-sm btn-success">
                    <i class="fas fa-file-excel"></i> Export to Excel
                </button>
            </form>

            <div class="card-header">
                <h3 class="card-title">
                    Filter Table:
                    <span class="d-inline-flex align-items-center ms-3 bg-light rounded-pill px-3 py-1 shadow-sm">
                        <form action="{{route('admin.tracking.index')}}" class="d-flex align-items-center gap-2 mb-0">
                            <span class="text-dark fw-medium">
                                {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y') }}
                            </span>
                            <button type="submit" class="border-0 bg-transparent text-danger p-0 ml-2 fs-4 fw-bold" aria-label="Remove Filter">
                                &times;
                            </button>
                        </form>
                    </span>
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>Awb</th>
                                <th>Status</th>
                                <th>Receiver</th>
                                <th>Package description</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tableConfigs as $row)
                            <tr>
                                <td>{{$row->awb_number}}</td>
                                <td>{{$row->status}}</td>
                                <td>{{$row->receiver->name}}</td>
                                <td>{{$row->shipment->package_description}}</td>
                                <td>{{$row->created_at->format('M d, Y')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$tableConfigs}}
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