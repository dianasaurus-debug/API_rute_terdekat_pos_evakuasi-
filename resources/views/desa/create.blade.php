@extends('layouts.template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('desa.index') }}">Desa</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Desa</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-center fw-bolder">TAMBAH DESA</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('desa.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Desa <small class="text-danger">(wajib diisi)</small></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            id="nama" value="{{ old('nama') }}" placeholder="Tulis nama desa">
                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan <small class="text-danger">(wajib diisi)</small></label>
                        <select name="kecamatan_id" 
                            class="form-control js-select @error('kecamatan_id') is-invalid @enderror"
                            id="kecamatan" placeholder="Pilih kecamatan">
                            @foreach ($kecamatan as $item)
                            <option value="{{ $item->id }}" {{ old('kecamatan_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('kecamatan_id')
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
                                value="{{ old('latitude') }}" placeholder="Tulis latitude">
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
                                value="{{ old('longitude') }}" placeholder="Tulis longitude">
                            @error('longitude')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-secondary" href="{{ route('desa.index') }}">Kembali</a>
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

@push('head')
<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-selection { overflow: hidden; }
    .select2-selection__rendered { white-space: normal; word-break: break-all; }
</style>
@endpush

@push('script')
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-select').select2({
            width: '100%'
        });
    });
</script>
@endpush