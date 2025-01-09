@extends('layouts.admin')

@section('title', 'Print Label')

@section('main')
<form method="POST" action="{{ route('admin.label.print', $shipment) }}">
    @csrf

    @include('admin.label._form')
    {{-- Submit Button --}}
    <div class="form-group text-left">
        <button type="submit" class="btn btn-primary mb-4">Print Label</button>
    </div>
</form>
@endsection