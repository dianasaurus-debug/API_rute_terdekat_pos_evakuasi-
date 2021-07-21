@extends('layouts.template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('laben.index') }}">Laporan Bencana</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Laporan Bencana</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-center fw-bolder">EDIT LAPORAN BENCANA</h5>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <strong>Nama Pelapor :</strong> {{ $laben->user->name }}
                </div>
                <div class="mb-2">
                    <strong>Status :</strong> {{ $laben->validation ? 'Disetujui' : 'Menunggu' }}
                </div>
                <form method="POST" action="{{ route('laben.update', $laben) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="bencana">Bencana <small class="text-danger">(wajib diisi)</small></label>
                            <select name="bencana_id" 
                                class="form-control js-select @error('bencana_id') is-invalid @enderror"
                                id="bencana" placeholder="Pilih bencana">
                                @foreach ($bencana as $item)
                                <option value="{{ $item->id }}" {{ old('laben_id', $laben->bencana_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                                @endforeach
                            </select>
                            @error('bencana_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tanggal">Tanggal <small class="text-danger">(wajib diisi)</small></label>
                            <input type="datetime-local" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                                id="tanggal" value="{{ old('tanggal', Carbon\Carbon::parse($laben->tanggal)->format('Y-m-d\TH:i')) }}">
                            @error('tanggal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="deskripsi">Deskripsi <small class="text-danger">(wajib diisi)</small></label>
                            <input type="text" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                id="deskripsi" value="{{ old('deskripsi', $laben->deskripsi) }}" placeholder="Tulis deskripsi">
                            @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-secondary" href="{{ route('laben.index') }}">Kembali</a>
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