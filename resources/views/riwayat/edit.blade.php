@extends('layouts.template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('riwayat.index', $bencana) }}">Riwayat Bencana</a>
                </li>
                <li class="breadcrumb-item">{{ $bencana->nama }}</li>
                <li class="breadcrumb-item active" aria-current="page">Edit Riwayat</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-center fw-bolder">EDIT RIWAYAT BENCANA {{ Str::upper($bencana->nama) }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('riwayat.update', [$bencana, $riwayat]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="tanggal">Waktu Kejadian <small class="text-danger">(wajib diisi)</small></label>
                        <input type="datetime-local" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                            id="tanggal" value="{{ old('tanggal', Carbon\Carbon::parse($riwayat->tanggal)->format('Y-m-d\TH:i')) }}">
                        @error('tanggal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="desa">Desa <small class="text-danger">(wajib diisi)</small></label>
                        <select name="desa_id" 
                            class="form-control js-select @error('desa_id') is-invalid @enderror"
                            id="desa" placeholder="Pilih desa">
                            @foreach ($kecamatan as $kec)
                            <optgroup label="{{ $kec->nama }}">
                                @foreach ($kec->desa()->orderBy('nama')->get() as $desa)
                                <option value="{{ $desa->id }}" {{ old('desa_id', $riwayat->desa_id) == $desa->id ? 'selected' : '' }}>
                                    {{ $desa->nama }}
                                </option>
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>
                        @error('desa_id')
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
                                value="{{ old('latitude', $riwayat->latitude) }}" placeholder="Tulis latitude">
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
                                value="{{ old('longitude', $riwayat->longitude) }}" placeholder="Tulis longitude">
                            @error('longitude')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-secondary" href="{{ route('riwayat.index', $bencana) }}">Kembali</a>
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