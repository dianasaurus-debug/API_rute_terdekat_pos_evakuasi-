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
            <div class="card ">
                <div class="card-header pagination justify-content-center">
                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-primary btn-round" type="button">Longsor</button>
                        <button class="btn btn-primary btn-round" type="button">Banjir</button>
                        <button class="btn btn-primary btn-round" type="button">Kekeringan</button>
                        <button class="btn btn-primary btn-round" type="button">Puting Beliung</button>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="text-center fw-bolder">RIWAYAT BENCANA TANAH LONGSOR</h5>
                    <div class="row pagination justify-content-end">
                        <div class = "col-md-2 offset-md-2">
                            <button class="btn btn-primary" type="button">Tambah</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>
                                Tahun
                            </th>
                            <th>
                                Kejadian
                            </th>
                            <th>
                                Kecamatan
                            </th>
                            <th>
                                Desa
                            </th>
                            <th>
                                Latitude
                            </th>
                            <th>
                                Longitude
                            </th>
                            <th>
                                Status
                            </th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    2015
                                </td>
                                <td>
                                    21
                                </td>
                                <td>
                                    Temayang
                                </td>
                                <td>
                                    Kedungsumber
                                </td>
                                <td>
                                    7568909084
                                </td>
                                <td>
                                    -907865788
                                </td>
                                <td>
                                    <button class="btn btn-success"> LAMA </button>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-secondary badge" type="button"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-secondary badge" type="button"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    2016
                                </td>
                                <td>
                                    16
                                </td>
                                <td>
                                    Padangan
                                </td>
                                <td>
                                    Banjarjo
                                </td>
                                <td>
                                    7568909084
                                </td>
                                <td>
                                    -907865788
                                </td>
                                <td>
                                    <button class="btn btn-success"> LAMA </button>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-secondary badge" type="button"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-secondary badge" type="button"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-history"></i> Diperbaiki 3 minggu lalu
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
