@extends('layouts.homepage')

@section('title', 'Lacak Pengiriman')

@section('main')
<div class="tracking">
    <div id="cek-resi" class="container col-md-6 offset-md-3">
        {{-- Form Cek Resi --}}
        <div class="card" style="max-width: 720px; margin-left: auto; margin-right: auto;">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-search"></i> Lacak Pengiriman</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('tracking.search') }}" method="GET">
                    @csrf
                    <div class="form-group">
                        <label for="awb_number">Nomor Resi</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="awb_number" name="awb_number" placeholder="Masukkan Nomor Resi" required>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-2">
                @include('layouts.shared.alert')
            </div>
        </div>

    </div>
</div>
</div>

<section>
    <div class="col-md-6 offset-md-3">
        @if(isset($tracking))
        <div class="card mt-4">
            <div class="card-header bg-success text-white">
                <h3 class="card-title"><i class="fas fa-box"></i> Hasil Tracking</h3>
            </div>

            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-info-circle"></i> Ringkasan</h4>
            </div>

            <div class="card-body">
                <ul class="list-group mb-4">
                    <li class="list-group-item">
                        <strong>Pengirim: </strong><span>{{ $tracking->shipment->sender->name }}</span><br>
                    </li>

                    <li class="list-group-item">
                        <strong>Penerima: </strong><span>{{ $tracking->shipment->receiver->name }}</span><br>
                    </li>

                    <li class="list-group-item">
                        <strong>Nomor Resi: </strong><span>{{ $tracking->awb_number }}</span><br>
                    </li>

                    <li class="list-group-item">
                        <strong>Tujuan: </strong><span>{{ $tracking->shipment->receiver->country }}</span><br>
                    </li>
                </ul>



                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Status:</strong>
                            <span class="badge badge-{{ $tracking->status == 'Delivered' ? 'success' : 'warning' }}">
                                {{ $tracking->status }}
                            </span>
                        </li>
                        <li class="list-group-item">
                            <strong>Lokasi:</strong>
                            <div class="timeline">
                                @foreach($locations as $location)
                                <div class="timeline-item">
                                    <div class="timeline-row">
                                        <div class="timeline-point">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <p>{{ trim($location) }}</p>
                                            <small class="text-muted">Diperbarui pada: {{ $tracking->created_at->format('d M Y H:i') }}</small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            @endif
        </div>
</section>

@endsection