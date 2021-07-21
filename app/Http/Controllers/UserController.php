<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function App\Helpers\getLastUpdatedData;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->query('cari')) {
            $user = User::where('id', '<>', 1)->where(
                'name', 'like', 
                '%' . request()->query('cari') . '%'
            )->latest()->paginate(5)->appends(request()->query());
        } else {
            $user = User::where('id', '<>', 1)->latest()->paginate(5);
        }

        $lastUpdatedTime = getLastUpdatedData(User::class);

        return view('user.index', compact('user', 'lastUpdatedTime'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users,email',
            'phone' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|confirmed|string|min:8|max:255',
        ]);
        
        $request->merge([
            'password' => Hash::make($request->password)
        ]);

        User::create($request->all());

        return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'nullable|confirmed|string|min:8|max:255',
        ]);
        
        if ($request->password) {
            $request->merge([
                'password' => Hash::make($request->password)
            ]);
            $user->update($request->all());
        } else {
            $user->update($request->except(['password']));
        }

        return redirect()->route('user.index')->with('success', 'Data user berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus!');
    }
}
