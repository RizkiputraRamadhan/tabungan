<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Saving;
use App\Models\Question;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SavingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saving = Saving::orderBy('id', 'desc')->get();
        $debit = Saving::where('jenis_transaksi', 1)->get();
        $kredit = Saving::where('jenis_transaksi', 2)->get();
        $studentId = User::where('typeuser', 3)->get();
        $sumSaldoAll = User::where('typeuser', 3)->sum('saldo');
        $sumSaldoDebit = Saving::where('jenis_transaksi', 1)->sum('saldo_transaksi');
        $sumSaldoKredit = Saving::where('jenis_transaksi', 2)->sum('saldo_transaksi');
        return view('backend.v_saving.index', [
            'judul' => 'Tabungan',
            'sub' => 'Data Tabungan',
            'saving' => $saving,
            'studentId' => $studentId,
            'debit' => $debit,
            'kredit' => $kredit,
            'sumSaldoAll' => $sumSaldoAll,
            'sumSaldoKredit' => $sumSaldoKredit,
            'sumSaldoDebit' => $sumSaldoDebit,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function storeSaving(Request $request)
    {
        $request->validate(
            [
                'student_id' => 'required',
                'jenis_transaksi' => 'required',
                'saldo_transaksi' => 'required',
                'keterangan' => 'nullable',
            ],
            [
                'student_id.required' => 'Siswa Belum Dipilih',
                'jenis_transaksi.required' => 'Jenis Transaksi Error Value',
                'saldo_transaksi.required' => 'Saldo Belum Ditambahkan',
            ],
        );

        $user = auth()->user()->id;
        $siswa = User::where('id', $request->student_id)->first();
        $saldo_user = $siswa->saldo;
        if ($request->jenis_transaksi == 1) {
            $saldo_final = $saldo_user + $request->saldo_transaksi;
            $jenis = 'Ditambah';
        } else {
            if ($request->saldo_transaksi > $saldo_user) {
                return redirect()
                    ->back()
                    ->with('error', 'Saldo tidak cukup');
            } else {
                $saldo_final = $saldo_user - $request->saldo_transaksi;
                $jenis = 'Ditarik';
            }
        }

        $siswa->update([
            'saldo' => $saldo_final,
        ]);

        $saving = new Saving([
            'student_id' => $request->student_id,
            'teacher_id' => $user,
            'saldo_user' => $saldo_final,
            'jenis_transaksi' => $request->jenis_transaksi,
            'saldo_transaksi' => $request->saldo_transaksi,
            'saldo_final' => $saldo_final,
            'keterangan' => $request->keterangan,
        ]);
        $saving->save();
        return redirect()
            ->back()
            ->with('success', 'Tabungan berhasil ' . $jenis . ' untuk ' . $siswa->name . ' sejumlah Rp. ' . number_format($request->saldo_transaksi, 0, ',', ','));
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Categories::findOrFail($id);
        return view('backend.v_kategori.edit', [
            'judul' => 'Kategori',
            'sub' => 'Ubah Kategori',
            'edit' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $kategori = Categories::findOrFail($id);


    // Delete related records in the questions table
    Question::where('category_id', $kategori->id)->delete();

    // Now, delete the category
    $kategori->delete();

    return redirect('/categories')->with('success', 'Category and related questions and results have been deleted.');
}

}
