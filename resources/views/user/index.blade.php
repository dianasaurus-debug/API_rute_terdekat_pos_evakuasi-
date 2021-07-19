@extends('layouts.template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('user.index') }}">User</a>
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
                <h5 class="card-title fw-bolder">DATA USER</h5>
            </div>
            <div class="card-body">
                <div class="row pagination justify-content-start">
                    <div class="col">
                        <a class="btn btn-primary" href="{{ route('user.create') }}">Tambah</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Hp</th>
                            <th>Alamat</th>
                        </thead>
                        <tbody>
                            @forelse ($user as $item)
                            <tr>
                                <td>{{ $user->firstItem() + $loop->index }}.</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->address }}</td>
                                <td class="text-center align-middle">
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-outline-secondary badge" href="{{ route('user.edit', $item) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('user.destroy', $item) }}" method="POST">
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
                                <td colspan="6" class="bg-light text-dark">
                                    <div class="text-center">Tidak ada data.</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer ">
                {!! $user->links() !!}
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