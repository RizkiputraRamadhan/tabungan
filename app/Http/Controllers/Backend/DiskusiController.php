<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Diskusi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DiskusiController extends Controller
{
    public function index()
    {
        $diskusi = Diskusi::all();
        return view('backend.v_diskusi.index', [
            'judul' => 'Diskusi',
            'sub' => 'Ruang Diskusi',
            'diskusi' => $diskusi,
        ]);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'text' => 'required',
        ]);

        $validatedData['users_id'] = auth()->user()->id;

        Diskusi::create($validatedData);

        return redirect('/diskusi');
    }
}
