@extends('layouts.template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('bpbd.index') }}">Bpbd</a>
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
            <div class="card-header text-center">
                <div class="d-grid gap-2 d-md-block">
                    <a class="btn btn-primary btn-round {{ request()->routeIs('user*') ? 'active' : '' }}" 
                        href="{{ route('user.index') }}">
                        Data User
                    </a>
                    <a class="btn btn-primary btn-round {{ request()->routeIs('bpbd*') ? 'active' : '' }}" 
                        href="{{ route('bpbd.index') }}">
                        Data BPBD
                    </a>
                </div>
                <h5 class="card-title fw-bolder">DATA BPBD</h5>
            </div>
            <div class="card-body">
                <div class="row pagination justify-content-start">
                    <div class="col">
                        <a class="btn btn-primary" href="{{ route('bpbd.create') }}">Tambah</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>No</th>
                            <th>NIP</th>
                            <th>Username</th>
                            <th>Email</th>
                        </thead>
                        <tbody>
                            @forelse ($bpbd as $item)
                            <tr>
                                <td>{{ $bpbd->firstItem() + $loop->index }}.</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->email }}</td>
                                <td class="text-center align-middle">
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-outline-secondary badge" href="{{ route('bpbd.edit', $item) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('bpbd.destroy', $item) }}" method="POST">
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
                                <td colspan="4" class="bg-light text-dark">
                                    <div class="text-center">Tidak ada data.</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer ">
                {!! $bpbd->links() !!}
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