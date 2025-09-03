<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();
        return view('dokumen', compact('profiles'));
    }

    public function create()
    {
        $profile = null;
        return view('user.profile', compact('profile'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto'      => 'nullable|array',
            'foto.*'    => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama'      => 'required|string|max:255',
            'email'     => 'required|string|max:255',
            'telpon'    => 'required|string|max:20',
            'alamat'    => 'required|string',
        ]);

        $fotoPaths = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                if ($file->isValid()) {
                    $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    // Simpan ke disk 'public' di folder 'foto'
                    $file->storeAs('foto', $filename, 'public');
                    $fotoPaths[] = $filename;
                }
            }
        }

        Profile::create([
            'foto'    => !empty($fotoPaths) ? json_encode($fotoPaths) : null,
            'nama'    => $request->nama,
            'email'   => $request->email,
            'telpon'  => $request->telpon,
            'alamat'  => $request->alamat,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
        return view('user.profile', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);

        $request->validate([
            'foto'      => 'nullable|array',
            'foto.*'    => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama'      => 'required|string|max:255',
            'email'     => 'required|string|max:255',
            'telpon'    => 'required|string|max:20',
            'alamat'    => 'required|string',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($profile->foto) {
                foreach (json_decode($profile->foto, true) as $oldFoto) {
                    Storage::disk('public')->delete('foto/' . $oldFoto);
                }
            }

            $fotoPaths = [];
            foreach ($request->file('foto') as $file) {
                $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('foto', $filename, 'public');
                $fotoPaths[] = $filename;
            }

            $profile->foto = json_encode($fotoPaths);
        }

        $profile->nama   = $request->nama;
        $profile->email  = $request->email;
        $profile->telpon = $request->telpon;
        $profile->alamat = $request->alamat;
        $profile->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function show($id)
    {
        $profile = Profile::findOrFail($id);

        $images = [];
        if ($profile->foto) {
            foreach (json_decode($profile->foto, true) as $foto) {
                $images[] = asset('storage/foto/' . $foto);
            }
        }

        return view('user.laporan', compact('profile', 'images'));
    }

    public function download($id)
    {
        $profile = Profile::findOrFail($id);

        $images = [];
        foreach (json_decode($profile->foto ?? '[]', true) as $foto) {
            $path = storage_path('app/public/foto/' . $foto);
            if (file_exists($path)) {
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                $images[] = $base64;
            }
        }

        $pdf = Pdf::loadView('user.laporan', [
            'profile' => $profile,
            'images'  => $images,
        ]);

        return $pdf->download('profile-' . $profile->nama . '.pdf');
    }
}
