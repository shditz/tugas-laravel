<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AbsenController extends Controller
{



 public function search(Request $request)
    {
        $searchDate = $request->input('searchDate');

        $absens = Absen::when($searchDate, function($query) use ($searchDate) {
            return $query->where('tanggal', $searchDate);
        })->get();

        return view('absenini', compact('absens'));
    }
    
    public function index1()
    {
        return view('absen'); // sesuaikan nama view
    }
    public function simpan(Request $request)
{
    $validated = $request->validate([
        'nama'    => 'required|string|max:100',
        'status'  => 'required|in:hadir,sakit,izin',
        'tanggal' => 'required|date',
        'waktu'   => 'required',
        'lokasi'  => 'nullable|string',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric'
    ]);

    // Simpan ke database, misalnya tabel `absensi`
    Absensi::create($validated);

    return redirect()->route('absensi.index1')->with('success', 'Absen berhasil disimpan!');
}






    // Tampilkan semua data absen di peta
    public function index()
    {
        $absens = Absen::all();
        return view('absenini', compact('absens'));
    }

    // Simpan data absen baru
   public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string',
        'status' => 'required|string',
        'waktu' => 'required|string',
        'tanggal' => 'required|string',
        'lokasi' => 'required|string',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
    ]);

    Absen::create($request->all());

    // Redirect kembali ke halaman sebelumnya dengan pesan sukses
    return redirect()->back()->with('success', 'Absen berhasil disimpan.');
}













    public function exportExcel(Request $request)
{
    $request->validate([
        'bulan' => 'required|digits:2',
        'tahun' => 'required|digits:4',
    ]);

    $bulan = $request->input('bulan');
    $tahun = $request->input('tahun');

    $absens = Absen::whereYear('tanggal', $tahun)
                   ->whereMonth('tanggal', $bulan)
                   ->get();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header kolom
    $sheet->setCellValue('A1', 'Nama');
    $sheet->setCellValue('B1', 'Status');
    $sheet->setCellValue('C1', 'Tanggal');
    $sheet->setCellValue('D1', 'Waktu');
    $sheet->setCellValue('E1', 'Lokasi');
    $sheet->setCellValue('F1', 'Latitude');
    $sheet->setCellValue('G1', 'Longitude');

    $row = 2;
    foreach ($absens as $absen) {
        $sheet->setCellValue('A' . $row, $absen->nama);
        $sheet->setCellValue('B' . $row, $absen->status);
        $sheet->setCellValue('C' . $row, $absen->tanggal);
        $sheet->setCellValue('D' . $row, $absen->waktu);
        $sheet->setCellValue('E' . $row, $absen->lokasi);
        $sheet->setCellValue('F' . $row, $absen->latitude);
        $sheet->setCellValue('G' . $row, $absen->longitude);
        $row++;
    }

    $writer = new Xlsx($spreadsheet);
    $filename = "data_absen_{$tahun}_{$bulan}.xlsx";
    $temp_file = tempnam(sys_get_temp_dir(), $filename);
    $writer->save($temp_file);

    return response()->download($temp_file, $filename)->deleteFileAfterSend(true);
}

}