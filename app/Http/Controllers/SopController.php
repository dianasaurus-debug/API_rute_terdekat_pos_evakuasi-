<?php

namespace App\Http\Controllers;

use App\Models\Bencana;

class SopController extends Controller
{
    public function __invoke(Bencana $bencana)
    {
        $sop = $bencana->sopBpbd()->get();
        $types = [
            'Prabencana' => $sop->where('nama', 'Prabencana')->count(),
            'Saat Bencana' => $sop->where('nama', 'Saat Bencana')->count(),
            'Pascabencana' => $sop->where('nama', 'Pascabencana')->count()
        ];

        // for get links of prev or next page
        $prev = Bencana::find($bencana->id - 1);
        $next = Bencana::find($bencana->id + 1);
        $links = [
            'prev' => $prev ? route('sop.index', $prev->slug) : null,
            'next' => $next ? route('sop.index', $next->slug) : null
        ];

        return view('sop.index', compact('sop', 'types', 'links'));
    }
}
