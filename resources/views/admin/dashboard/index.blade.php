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

@endsection