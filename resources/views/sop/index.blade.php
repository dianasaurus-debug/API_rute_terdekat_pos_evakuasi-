@extends('layouts.template.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">SOP Bencana</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $sop[0]->bencana->nama }}</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-center">
                <div class="d-grid gap-2 d-md-block">
                    <a class="btn btn-primary btn-round {{ $sop[0]->bencana->nama == 'Banjir' ? 'active' : '' }}" 
                        href="{{ route('sop.index', 'banjir') }}">
                        Banjir
                    </a>
                    <a class="btn btn-primary btn-round {{ $sop[0]->bencana->nama == 'Kekeringan' ? 'active' : '' }}" 
                        href="{{ route('sop.index', 'kekeringan') }}">
                        Kekeringan
                    </a>
                    <a class="btn btn-primary btn-round {{ $sop[0]->bencana->nama == 'Puting Beliung' ? 'active' : '' }}" 
                        href="{{ route('sop.index', 'puting-beliung') }}">
                        Puting Beliung
                    </a>
                    <a class="btn btn-primary btn-round {{ $sop[0]->bencana->nama == 'Tanah Longsor' ? 'active' : '' }}" 
                        href="{{ route('sop.index', 'tanah-longsor') }}">
                        Tanah Longsor
                    </a>
                </div>
                <h5 class="card-title fw-bolder">
                    SOP BENCANA {{ Str::upper($sop[0]->bencana->nama) }}
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>No</th>
                            <th>SOP</th>
                            <th>Tindakan</th>
                        </thead>
                        <tbody>
                            @php $count = 1 @endphp
                            @forelse ($sop as $item)
                            <tr>
                                @if ($item->is_first)
                                <td class="align-top" rowspan="{{ $types[$item->nama] }}">
                                    {{ $count }}.
                                </td>
                                <td class="align-top" rowspan="{{ $types[$item->nama] }}">
                                    {{ $item->nama }} 
                                </td>
                                @php $count++ @endphp
                                @endif
                                <td>
                                    {{ $item->tindakan }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="bg-light text-dark">
                                    <div class="text-center">Tidak ada data.</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer ">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        @if ($links['prev'])
                        <li class="page-item">
                            <a class="page-link" href="{{ $links['prev'] }}"><<<</a>
                        </li>
                        @endif
                        @if ($links['next'])
                        <li class="page-item">
                            <a class="page-link" href="{{ $links['next'] }}">>>></a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection