<?php

namespace App\Http\Controllers\Backend;
// namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Str;
use App\Models\Backend\Akun;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akun = User::where('typeuser', 2)->get();
        return view('backend.v_guru.index', [
            'judul' => 'Akun Guru',
            'sub' => 'Data Akun Guru',
            'akun' => $akun,
        ]);
    }
    public function profilComplete(string $id)
    {
        $guru = User::findOrFail($id);
        $profile = Guru::where('users_id' ,$id)->first();
        if(!$profile) {
            $profile = new Guru();
        }
        return view('backend.v_guru.profile', [
            'judul' => 'Akun Guru',
            'sub' => $guru->nama,
            'guru' => $guru,
            'profile' => $profile,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'no_induk' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'no_induk' => $request->input('no_induk'),
            'typeuser' => $request->input('typeuser'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Guru Berhasil Didaftarkan.');
    }
    public function edit(string $id)
    {
        $guru = User::findOrFail($id);
        return view('backend.v_guru.edit', [
            'judul' => 'Akun Guru',
            'sub' => $guru->nama,
            'guru' => $guru,
        ]);
    }
    public function show(string $id)
    {
        $guru = User::findOrFail($id);
        $profil = Guru::where('users_id', $id)->first();
        $histori = Guru::where('users_id', $id)->first();
        return view('backend.v_guru.detail', [
            'judul' => 'Detail Akun Guru',
            'sub' => $guru->nama,
            'guru' => $guru,
            'profil' => $profil,
            'histori' => $histori,
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'no_induk' => 'required|string',
        ]);

        $guru = User::find($id);
        $guru->update([
            'name' => $request->input('name'),
            'no_induk' => $request->input('no_induk'),
            'email' => $request->input('email'),
            'password' => $request->has('password') ? bcrypt($request->input('password')) : $guru->password,
        ]);

        return redirect('/guru')
            ->with('success', 'Akun Guru Berhasil diupdate.');
    }

    public function profil(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'no_tlp' => 'nullable|string|max:255',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $Extension = $image->getClientOriginalExtension();
            $imagePath = Str::random(10) . '_' . time() . '.' . $Extension;
            $image->move('storage/guru', $imagePath);
        }


        $user = User::where('id', $id)->first();
        $profile = Guru::where('users_id', $user->id)->first();

        $data = [
            'users_id' => $user->id,
            'image' => $imagePath ? $imagePath : ($profile ? $profile->image : null),
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'no_tlp' => $request->no_tlp,
        ];

        if ($profile) {
            $profile->update($data);
            return redirect()->back()
            ->with('success', 'Profil Berhasil Diupdate.');
        } else {
            Guru::create($data);
            return redirect()->back()
                ->with('success', 'Profil Lengkap.');
        }

    }

    public function destroy($id)
    {
        $guru = User::find($id);
        try {
            $guru->delete();
            return redirect()
                ->back()
                ->with('success', 'Akun Guru deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error deleting akun karena akun masih aktif');
        }
    }
}
