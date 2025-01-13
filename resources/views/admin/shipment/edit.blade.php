@extends('layouts.admin')

@section('title', 'Shipment Edit')

@section('main')
<form method="POST" action="{{ route('admin.shipment.update', $shipment) }}">
    @csrf
    @method('patch')

    @include('admin.label._form')
    {{-- Submit Button --}}
    <div class="form-group text-left">
        <button type="submit" class="btn btn-primary mb-4">Update</button>
    </div>
</form>
@endsection