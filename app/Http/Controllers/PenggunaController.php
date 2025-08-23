<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePenggunaRequest;
use App\Http\Requests\UpdatePenggunaRequest;
use App\Models\BarangMasuk;
use App\Models\Jurusan;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idjurusan = Auth::user()->prodi_id;
        $users = User::with('departments')
            ->where('prodi_id', $idjurusan)
            ->get();
        $jurusan = Jurusan::all();
        return view('pengguna.index', compact('users', 'jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePenggunaRequest $request)
    {
        // $idjurusan = Auth::user()->prodi_id;
        $request->validated();
        User::create([
            'name' => $request->namapengguna,

            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'prodi_id' => $request->jurusan
        ]);


        return redirect('pengguna');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePenggunaRequest $request, $id)
    {
        // Validasi request
        $data = $request->validate([
            'namapengguna' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string',
            'role' => 'required|string',
            'jurusan' => 'nullable|string',
            // tambahkan validasi lainnya sesuai kebutuhan Anda
        ]);

        // Temukan model berdasarkan $id
        $pengguna = User::findOrFail($id);

        // Update nilai-nilai model
        $pengguna->name = $data['namapengguna'];
        $pengguna->username = $data['username'];
        $pengguna->password = bcrypt($data['password']);
        $pengguna->role = $data['role'];
        $pengguna->prodi_id = $data['jurusan'];

        // Simpan perubahan
        $pengguna->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect('pengguna');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengguna = User::findOrFail($id);
        $pengguna->delete();

        return redirect('pengguna');
    }
}
