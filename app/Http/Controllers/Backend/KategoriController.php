<?php

namespace App\Http\Controllers\Backend;

use App\Models\Result;
use App\Models\Question;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Categories::orderBy('id', 'desc')->get();
        return view('backend.v_kategori.index', [
            'judul' => 'Kategori',
            'sub' => 'Data Kategori',
            'kategori' => $kategori
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_kategori.create', [
            'judul' => 'Kategori',
            'sub' => 'Tambah Kategori',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required',
            'tanggal_pelaksanaan' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'durasi' => 'required|integer',
        ]);

        $validatedData['status'] = 1;
        $randomString = str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        $timestamp = now()->format('YmdHis');
        $token = 'start-'.substr($randomString, 0, 70) . $timestamp;
        $validatedData['token'] = $token;


        Categories::create($validatedData);

        return redirect('/categories')->with('success', 'Data berhasil tersimpan');
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
    public function update(Request $request, string $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required',
            'tanggal_pelaksanaan' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'durasi' => 'required|integer',
        ]);

        // Ambil kategori yang akan diperbarui berdasarkan $id
        $category = Categories::findOrFail($id);

        // Perbarui data kategori
        $category->update($validatedData);

        return redirect('/categories')->with('success', 'Data berhasil diperbarui');
    }
    public function publish(Request $request, string $id)
    {

        $category = Categories::findOrFail($id);
        $validatedData['status'] = 1;
        $category->update($validatedData);

        return redirect()->back()->with('success', 'Ujian berhasil dipublish');
    }
    public function draft(Request $request, string $id)
    {

        $category = Categories::findOrFail($id);
        $validatedData['status'] = 2;
        $category->update($validatedData);

        return redirect()->back()->with('success', 'Ujian berhasil disematkan');
    }

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
