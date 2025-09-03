<?php

namespace App\Http\Controllers;

use App\Models\Rili;
use Illuminate\Http\Request;

class RiliController extends Controller
{

    
    public function index()
    {
        $data = Rili::all();
        return view('rilis', compact('data'));
    }

    public function create()
    {
        return view('rilisu');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'pesan' => 'required|string',
            'foto' => 'required|array', // array wajib ada
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validasi untuk tiap file
        ]);

        $fotos = [];
    if ($request->hasFile('foto')) {
        foreach ($request->file('foto') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $fotos[] = $filename;
        }
    }

    // Simpan ke database (foto disimpan dalam bentuk JSON)
    $validated['foto'] = json_encode($fotos);

    Rili::create($validated);
        

    // Redirect kembali ke halaman form (rili.create)
    return redirect()->route('rilisu')->with('success', 'Data berhasil disimpan!');
    }

  public function show($id)
{
    $rilisan = Rili::findOrFail($id); // sesuaikan nama model
    return view('isirilis', compact('rilisan')); // sesuaikan nama variabel
}


   

    

    public function destroy(Rili $rili)
    {
        $rili->delete();
        return redirect()->route('rili.index')->with('success', 'Data berhasil dihapus');
    }





    ///

public function edit($id)
{
    $rilisan = Rili::findOrFail($id);
    return view('edit-rilis', compact('rilisan'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'jabatan' => 'required|string|max:255',
        'judul' => 'required|string|max:255',
        'status' => 'required|string|max:50',
        'pesan' => 'required|string',
    ]);

    $rili = Rili::findOrFail($id);
    $rili->update($validated);

    return redirect()->route('rilis.edit', $id)->with('success', 'Data berhasil diperbarui.');
}


}
