<?php

namespace App\Http\Controllers;

use App\Models\Bpbd;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use function App\Helpers\getLastUpdatedData;

class BpbdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bpbd = Bpbd::latest()->paginate(5);

        $lastUpdatedTime = getLastUpdatedData(Bpbd::class);

        return view('bpbd.index', compact('bpbd', 'lastUpdatedTime'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bpbd.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:bpbd,email',
            'password' => 'required|confirmed|string|min:8|max:255',
        ]);
        
        $request->merge([
            'password' => Hash::make($request->password)
        ]);

        Bpbd::create($request->all());

        return redirect()->route('bpbd.index')->with('success', 'Data bpbd berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bpbd  $bpbd
     * @return \Illuminate\Http\Response
     */
    public function edit(Bpbd $bpbd)
    {
        return view('bpbd.edit', compact('bpbd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bpbd  $bpbd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bpbd $bpbd)
    {
        $request->validate([
            'nip' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:bpbd,email,' . $bpbd->id,
            'password' => 'nullable|confirmed|string|min:8|max:255',
        ]);
        
        if ($request->password) {
            $request->merge([
                'password' => Hash::make($request->password)
            ]);
            $bpbd->update($request->all());
        } else {
            $bpbd->update($request->except(['password']));
        }

        return redirect()->route('bpbd.index')->with('success', 'Data bpbd berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bpbd  $bpbd
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bpbd $bpbd)
    {
        $bpbd->delete();

        return redirect()->route('bpbd.index')->with('success', 'Data bpbd berhasil dihapus!');
    }
}
