@extends('layouts.template.app')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-globe text-warning"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Desa</p>
                                <small class="card-title">{{ $data['desa'][0] }} Desa</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        @if ($data['desa'][1])
                        <i class="fa fa-history"></i> {{ $data['desa'][1] }}
                        @else
                        <i class="fa fa-refresh"></i> Update
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-money-coins text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Kecamatan</p>
                                <small class="card-title">{{ $data['kecamatan'][0] }} Kec</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        @if ($data['kecamatan'][1])
                        <i class="fa fa-history"></i> {{ $data['kecamatan'][1] }}
                        @else
                        <i class="fa fa-refresh"></i> Update
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-vector text-danger"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Lap Bencana</p>
                                <small class="card-title">{{ $data['lap_bencana'][0] }} Lap</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        @if ($data['lap_bencana'][1])
                        <i class="fa fa-history"></i> {{ $data['lap_bencana'][1] }}
                        @else
                        <i class="fa fa-refresh"></i> Update
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-favourite-28 text-primary"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Lap Bantuan</p>
                                <small class="card-title">{{ $data['lap_bantuan'][0] }} Lap</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        @if ($data['lap_bantuan'][1])
                        <i class="fa fa-history"></i> {{ $data['lap_bantuan'][1] }}
                        @else
                        <i class="fa fa-refresh"></i> Update
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <div class="d-grid gap-2 d-md-block">
                        <a class="btn btn-primary btn-round {{ $riwayat[0]['bencana'] == 'Banjir' ? 'active' : '' }}" 
                            href="{{ route('dashboard', ['bencana' => 'banjir']) }}">
                            Banjir
                        </a>
                        <a class="btn btn-primary btn-round {{ $riwayat[0]['bencana'] == 'Kekeringan' ? 'active' : '' }}" 
                            href="{{ route('dashboard', ['bencana' => 'kekeringan']) }}">
                            Kekeringan
                        </a>
                        <a class="btn btn-primary btn-round {{ $riwayat[0]['bencana'] == 'Puting Beliung' ? 'active' : '' }}" 
                            href="{{ route('dashboard', ['bencana' => 'puting-beliung']) }}">
                            Puting Beliung
                        </a>
                        <a class="btn btn-primary btn-round {{ $riwayat[0]['bencana'] == 'Tanah Longsor' ? 'active' : '' }}" 
                            href="{{ route('dashboard', ['bencana' => 'tanah-longsor']) }}">
                            Tanah Longsor
                        </a>
                    </div>
                    <h5 class="card-title fw-bolder">RIWAYAT BENCANA {{ Str::upper($riwayat[0]['bencana']) }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                            <th>Tahun</th>
                            <th>Kejadian</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Status</th>
                            </thead>
                            <tbody>
                            @forelse ($riwayat as $item)
                            <tr>
                                @if ($item['tahun'])
                                <td class="align-top" rowspan="{{ $item['jumlah'] }}">
                                    {{ $item['tahun'] }}
                                </td>
                                <td class="align-top" rowspan="{{ $item['jumlah'] }}">
                                    {{ $item['jumlah'] }}
                                </td>
                                @endif
                                <td>{{ $item['kecamatan'] }}</td>
                                <td>{{ $item['desa'] }}</td>
                                <td>{{ $item['latitude'] }}</td>
                                <td>{{ $item['longitude'] }}</td>
                                <td>
                                    <button class="btn {{ $item['status'] == 'LAMA' ? 'btn-success' : 'btn-warning' }}">
                                        {{ $item['status'] }}
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="bg-light text-dark">
                                    <div class="text-center">Tidak ada data.</div>
                                </td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
