@extends('layouts.template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('bpbd.index') }}">Bpbd</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Bpbd</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-center fw-bolder">TAMBAH BPBD</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('bpbd.store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nip">NIP <small class="text-danger">(wajib diisi)</small></label>
                            <input type="text" name="nip"
                                class="form-control @error('nip') is-invalid @enderror" id="nip"
                                value="{{ old('nip') }}" placeholder="Tulis nip">
                            @error('nip')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">Username <small class="text-danger">(wajib diisi)</small></label>
                            <input type="text" name="username"
                                class="form-control @error('username') is-invalid @enderror" id="username"
                                value="{{ old('username') }}" placeholder="Tulis username">
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email <small class="text-danger">(wajib diisi)</small></label>
                        <input type="email" name="email"
                            class="form-control @error('email') is-invalid @enderror" id="email"
                            value="{{ old('email') }}" placeholder="Tulis email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Password <small class="text-danger">(wajib diisi)</small></label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                value="{{ old('password') }}" placeholder="Tulis password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation">Konfirmasi Password <small class="text-danger">(wajib diisi)</small></label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                                value="{{ old('password_confirmation') }}" placeholder="Tulis ulang password">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-secondary" href="{{ route('bpbd.index') }}">Kembali</a>
                </form>
            </div>
            <div class="card-footer">
                <hr>
                <div class="stats">
                    <i class="fa fa-info-circle"></i> Pastikan isian data benar
                </div>
            </div>
        </div>
    </div>
</div>
@endsection