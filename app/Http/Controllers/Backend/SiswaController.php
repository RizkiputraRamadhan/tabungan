<?php

namespace App\Http\Controllers\Backend;
// namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Result;
use App\Models\Categories;
use Illuminate\Support\Str;
use App\Models\Backend\Akun;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Saving;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akun = User::where('typeuser', 3)->get();
        return view('backend.v_siswa.index', [
            'judul' => 'Akun Siswa',
            'sub' => 'Data Akun Siswa',
            'akun' => $akun,
        ]);
    }

    public function saving()
    {
        $id = auth()->user()->id;
        $siswa = User::findOrFail($id);
        $profile = Siswa::where('users_id' ,$id)->first();
        if(!$profile) {
            $profile = new Siswa();
        }
        $histori = Saving::where('student_id', $id)->get();
        $debit = Saving::where('student_id', $id)->where('jenis_transaksi', 1)->get();
        $kredit = Saving::where('student_id', $id)->where('jenis_transaksi', 2)->get();
        $sumSaldoAll = User::where('id', $id)->first();
        $sumSaldoDebit = Saving::where('student_id', $id)->where('jenis_transaksi', 1)->sum('saldo_transaksi');
        $sumSaldoKredit = Saving::where('student_id', $id)->where('jenis_transaksi', 2)->sum('saldo_transaksi');
        return view('backend.v_siswa.saving', [
            'judul' => 'Tabungan',
            'sub' => 'History Tabungan',
            'siswa' => $siswa,
            'profile' => $profile,
            'histori' => $histori,
            'sumSaldoAll' => $sumSaldoAll,
            'sumSaldoKredit' => $sumSaldoKredit,
            'sumSaldoDebit' => $sumSaldoDebit,
            'debit' => $debit,
            'kredit' => $kredit,
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
            ->with('success', 'Siswa Berhasil Didaftarkan.');
    }

    public function edit(string $id)
    {
        $siswa = User::findOrFail($id);
        return view('backend.v_siswa.edit', [
            'judul' => 'Akun Siswa',
            'sub' => $siswa->nama,
            'siswa' => $siswa,
        ]);
    }

    public function profilComplete(string $id)
    {
        $siswa = User::findOrFail($id);
        $profile = Siswa::where('users_id' ,$id)->first();
        if(!$profile) {
            $profile = new Siswa();
        }
        return view('backend.v_siswa.profile', [
            'judul' => 'Akun Siswa',
            'sub' => $siswa->nama,
            'siswa' => $siswa,
            'profile' => $profile,
        ]);
    }
    public function show(string $id)
    {
        $siswa = User::findOrFail($id);
        $profil = Siswa::where('users_id', $id)->first();
        $histori = Saving::where('student_id', $id)->get();
        $debit = Saving::where('student_id', $id)->where('jenis_transaksi', 1)->get();
        $kredit = Saving::where('student_id', $id)->where('jenis_transaksi', 2)->get();
        $sumSaldoAll = User::where('id', $id)->first();
        $sumSaldoDebit = Saving::where('student_id', $id)->where('jenis_transaksi', 1)->sum('saldo_transaksi');
        $sumSaldoKredit = Saving::where('student_id', $id)->where('jenis_transaksi', 2)->sum('saldo_transaksi');
        return view('backend.v_siswa.detail', [
            'judul' => 'Detail Akun Siswa',
            'sub' => $siswa->nama,
            'siswa' => $siswa,
            'profil' => $profil,
            'histori' => $histori,
            'sumSaldoAll' => $sumSaldoAll,
            'sumSaldoKredit' => $sumSaldoKredit,
            'sumSaldoDebit' => $sumSaldoDebit,
            'debit' => $debit,
            'kredit' => $kredit,
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'no_induk' => 'required|string',
        ]);

        $siswa = User::find($id);
        $siswa->update([
            'name' => $request->input('name'),
            'no_induk' => $request->input('no_induk'),
            'email' => $request->input('email'),
            'password' => $request->has('password') ? bcrypt($request->input('password')) : $siswa->password,
        ]);

        return redirect('/siswa')->with('success', 'Akun Siswa Berhasil diupdate.');
    }

    public function profil(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tempat_tanggal_lahir_siswa' => 'nullable|string|max:255',
            'kelas' => 'nullable|string|max:255',
            'alamat_lengkap' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'nama_ayah' => 'nullable|string|max:255',
            'foto_kk' => 'nullable||image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_tlp' => 'nullable|string|max:255',
            'kelamin' => 'nullable|string|max:255',
        ]);

        $imagePath = null;
        $fotokk = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $Extension = $image->getClientOriginalExtension();
            $imagePath = Str::random(10) . '_' . time() . '.' . $Extension;
            $image->move('storage/siswa', $imagePath);
        }

        if ($request->hasFile('foto_kk')) {
            $image = $request->file('foto_kk');
            $Extension = $image->getClientOriginalExtension();
            $fotokk = 'kk_'. Str::random(10) . '_' . time() . '.' . $Extension;
            $image->move('storage/siswa/berkas', $fotokk);
        }

        $user = User::where('id', $id)->first();
        $profile = Siswa::where('users_id', $user->id)->first();

        $data = [
            'users_id' => $user->id,
            'image' => $imagePath ? $imagePath : ($profile ? $profile->image : null),
            'nomer_induk' => $user->no_induk,
            'nama_siswa' => $user->name,
            'tempat_tanggal_lahir_siswa' => $request->tempat_tanggal_lahir_siswa,
            'kelas' => $request->kelas,
            'alamat_lengkap' => $request->alamat_lengkap,
            'nama_ibu' => $request->nama_ibu,
            'nama_ayah' => $request->nama_ayah,
            'foto_kk' => $fotokk ? $fotokk : ($profile ? $profile->foto_kk : null),
            'no_tlp' => $request->no_tlp,
            'kelamin' => $request->kelamin,
        ];

        if ($profile) {
            $profile->update($data);
            return redirect()->back()
            ->with('success', 'Profil Berhasil Diupdate.');
        } else {
            Siswa::create($data);
            return redirect()->back()
                ->with('success', 'Profil Lengkap.');
        }

    }

    public function destroy($id)
    {
        $siswa = User::find($id);
        try {
            $siswa->delete();
            return redirect()
                ->back()
                ->with('success', 'Akun Siswa deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error deleting akun karena akun masih aktif');
        }
    }
}
