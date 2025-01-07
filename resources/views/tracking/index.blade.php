@extends('layouts.tracking')

@section('title', 'Tracking Pengiriman')

@section('main')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <!-- Form Cek Resi -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-search"></i> Cek Resi</h3>
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
                        <strong>Pengirim:</strong><br>
                        <ul>
                            <li><strong>Nama:</strong> {{ $tracking->shipment->sender->name }}</li>
                            <li><strong>Alamat:</strong> {{ $tracking->shipment->sender->street_address }}</li>
                            <li><strong>Negara:</strong> {{ $tracking->shipment->sender->country }}</li>
                        </ul>
                    </li>

                    <li class="list-group-item">
                        <strong>Penerima:</strong><br>
                        <ul>
                            <li><strong>Nama:</strong> {{ $tracking->shipment->receiver->name }}</li>
                            <li><strong>Alamat:</strong> {{ $tracking->shipment->receiver->street_address }}</li>
                            <li><strong>Kota:</strong> {{ $tracking->shipment->receiver->city }}</li>
                            <li><strong>Negara:</strong> {{ $tracking->shipment->receiver->country }}</li>
                            <li><strong>Negara Bagian:</strong> {{ $tracking->shipment->receiver->state }}</li>
                            <li><strong>Kode Pos:</strong> {{ $tracking->shipment->receiver->postal_code }}</li>
                        </ul>
                    </li>

                    <li class="list-group-item">
                        <strong>Deskripsi Paket:</strong> {{ $tracking->shipment->package_description }}<br>
                        <strong>Berat:</strong> {{ $tracking->shipment->weight }} g
                    </li>
                </ul>



                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Nomor Resi:</strong> {{ $tracking->awb_number }}</li>
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
    </div>
    @stop