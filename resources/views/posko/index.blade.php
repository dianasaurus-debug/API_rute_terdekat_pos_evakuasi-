@extends('layouts.template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('posko.index') }}">Posko Evakuasi</a>
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
                <h5 class="card-title text-center fw-bolder">DATA POSKO EVAKUASI</h5>
            </div>
            <div class="card-body">
                <div class="row pagination justify-content-start">
                    <div class="col">
                        <a class="btn btn-primary" href="{{ route('posko.create') }}">Tambah</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>No</th>
                            <th>Nama Posko</th>
                            <th>Alamat</th>
                            <th>Desa</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Deskripsi</th>
                        </thead>
                        <tbody>
                            @forelse ($posko as $item)
                            <tr>
                                <td>{{ $posko->firstItem() + $loop->index }}.</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->desa->nama }}</td>
                                <td>{{ $item->latitude }}</td>
                                <td>{{ $item->longitude }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td class="text-center align-middle">
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-outline-secondary badge" href="{{ route('posko.edit', $item) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('posko.destroy', $item) }}" method="POST">
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
                {!! $posko->links() !!}
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