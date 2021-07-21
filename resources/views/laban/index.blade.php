@extends('layouts.template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('laban.index') }}">Laporan Bantuan</a>
                </li>
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
            <div class="card-header">
                <h5 class="card-title text-center fw-bolder">LAPORAN PENGAJUAN BANTUAN</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>No</th>
                            <th>Bencana</th>
                            <th>Bantuan</th>
                            <th>Nama Pelapor</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @forelse ($laban as $item)
                            @php
                                $tanggal = Carbon\Carbon::parse($item->tanggal);
                            @endphp
                            <tr>
                                <td>{{ $laban->firstItem() + $loop->index }}.</td>
                                <td>{{ $item->bencana->nama }}</td>
                                <td>{{ $item->bantuan ? $item->bantuan->type : '-' }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $tanggal->format('d/m/y H:i'); }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td><div class="btn btn-primary">{{ $item->status }}</div></td>
                                <td class="text-center align-middle">
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-outline-secondary badge" href="{{ route('laban.edit', $item) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('laban.destroy', $item) }}" method="POST">
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
                {!! $laban->links() !!}
                @if ($lastUpdatedTime)
                <hr>
                <div class="stats">
                    <i class="fa fa-history"></i> Diperbaiki {{ $lastUpdatedTime }}
                </div> 
                @endif
            </div>
        </div>
    </div>
</div>
@endsection