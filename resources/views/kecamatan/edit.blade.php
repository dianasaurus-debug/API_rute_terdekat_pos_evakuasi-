@extends('layouts.template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('kecamatan.index') }}">Kecamatan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Kecamatan</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-center fw-bolder">EDIT KECAMATAN</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('kecamatan.update', $kecamatan) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama Kecamatan <small class="text-danger">(wajib diisi)</small></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            id="nama" value="{{ old('nama', $kecamatan->nama) }}" placeholder="Tulis nama kecamatan">
                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="latitude">Latitude</label>
                            <input type="text" name="latitude"
                                class="form-control @error('latitude') is-invalid @enderror" id="latitude"
                                value="{{ old('latitude', $kecamatan->latitude) }}" placeholder="Tulis latitude">
                            @error('latitude')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="longitude">Longitude</label>
                            <input type="text" name="longitude"
                                class="form-control @error('longitude') is-invalid @enderror" id="longitude"
                                value="{{ old('longitude', $kecamatan->longitude) }}" placeholder="Tulis longitude">
                            @error('longitude')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-secondary" href="{{ route('kecamatan.index') }}">Kembali</a>
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