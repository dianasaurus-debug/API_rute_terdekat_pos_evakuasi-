@extends('layouts.template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('riwayat.index', $riwayat[0]->bencana) }}">Riwayat Bencana</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $riwayat[0]->bencana->nama }}</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        @include('components.alert')
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-center">
                <div class="d-grid gap-2 d-md-block">
                    <a class="btn btn-primary btn-round {{ $riwayat[0]->bencana->nama == 'Banjir' ? 'active' : '' }}" 
                        href="{{ route('riwayat.index', 'banjir') }}">
                        Banjir
                    </a>
                    <a class="btn btn-primary btn-round {{ $riwayat[0]->bencana->nama == 'Kekeringan' ? 'active' : '' }}" 
                        href="{{ route('riwayat.index', 'kekeringan') }}">
                        Kekeringan
                    </a>
                    <a class="btn btn-primary btn-round {{ $riwayat[0]->bencana->nama == 'Puting Beliung' ? 'active' : '' }}" 
                        href="{{ route('riwayat.index', 'puting-beliung') }}">
                        Puting Beliung
                    </a>
                    <a class="btn btn-primary btn-round {{ $riwayat[0]->bencana->nama == 'Tanah Longsor' ? 'active' : '' }}" 
                        href="{{ route('riwayat.index', 'tanah-longsor') }}">
                        Tanah Longsor
                    </a>
                </div>
                <h5 class="card-title fw-bolder">RIWAYAT BENCANA {{ Str::upper($riwayat[0]->bencana->nama) }}</h5>
            </div>
            <div class="card-body">
                <div class="row pagination justify-content-start">
                    <div class="col">
                        <a class="btn btn-primary" href="{{ route('riwayat.create', $riwayat[0]->bencana) }}">Tambah</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @forelse ($riwayat as $item)
                            @php 
                                $tanggal = Carbon\Carbon::parse($item->tanggal);
                                $jml_hari = $tanggal->diffInDays(Carbon\Carbon::now()); 
                            @endphp
                            <tr>
                                <td>{{ $riwayat->firstItem() + $loop->index }}.</td>
                                <td>{{ $tanggal->format('d/m/y H:i'); }}</td>
                                <td>{{ $item->desa ? $item->desa->kecamatan->nama : '-' }}</td>
                                <td>{{ $item->desa ? $item->desa->nama : '-' }}</td>
                                <td>{{ $item->latitude ?: '-' }}</td>
                                <td>{{ $item->longitude ?: '-' }}</td>
                                <td>
                                    <button class="btn {{ ($jml_hari <= 30) ? 'btn-warning' : 'btn-success' }}">
                                        {{ ($jml_hari <= 30) ? 'BARU' : 'LAMA' }}
                                    </button>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-outline-secondary badge" href="{{ route('riwayat.edit', [$item->bencana, $item]) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('riwayat.destroy', [$item->bencana, $item]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                class="btn btn-sm btn-outline-secondary badge" 
                                                onclick="return confirm('Apakah anda yakin ingin menghapus?')"
                                            >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="bg-light text-dark">
                                    <div class="text-center">Tidak ada data.</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer ">
                {!! $riwayat->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection