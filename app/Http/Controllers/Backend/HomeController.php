<?php

namespace App\Http\Controllers\Backend;

use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Saving;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $siswa = User::findOrFail($id);
        $guru = User::findOrFail($id);
        $profile = Siswa::where('users_id' ,$id)->first();
        $profileGuru = Guru::where('users_id' ,$id)->first();
        if(!$profile) {
            $profile = new Siswa();
        }
        if(!$profileGuru) {
            $profileGuru = new Guru();
        }
        $histori = Saving::where('student_id', $id)->get();
        $debit = Saving::where('student_id', $id)->where('jenis_transaksi', 1)->get();
        $kredit = Saving::where('student_id', $id)->where('jenis_transaksi', 2)->get();
        $sumSaldoAll = User::where('id', $id)->first();
        $sumSaldoDebit = Saving::where('student_id', $id)->where('jenis_transaksi', 1)->sum('saldo_transaksi');
        $sumSaldoKredit = Saving::where('student_id', $id)->where('jenis_transaksi', 2)->sum('saldo_transaksi');
        return view('backend.v_home.index', [
            'judul' => 'Beranda',
            'sub' => 'Data Beranda',
            'siswa' => $siswa,
            'guru' => $guru,
            'profile' => $profile,
            'profileGuru' => $profileGuru,
            'histori' => $histori,
            'sumSaldoAll' => $sumSaldoAll,
            'sumSaldoKredit' => $sumSaldoKredit,
            'sumSaldoDebit' => $sumSaldoDebit,
            'debit' => $debit,
            'kredit' => $kredit,
        ]);
    }
}
