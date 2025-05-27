<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videotron;
use Carbon\Carbon;

class VideotronController extends Controller
{
  public function store(Request $request)
{
    $validated = $request->validate([
        'tanggal_mulai'     => 'required|date',
        'tanggal_selesai'   => 'required|date|after_or_equal:tanggal_mulai',
        'waktumulai'        => 'required',
        'waktuselesai'      => 'required',
        'nama_acara'        => 'required|string|max:255',
        'nama_peminjam'     => 'required|string|max:255',
        'contact_peminjam'  => 'required|string|max:255',
        'link_video'        => 'nullable|string|max:255',
    ]);

    $validated['status'] = 'Menunggu';
    $validated['nama_petugas'] = '-';
    $validated['contact_petugas'] = '-';
    $validated['keterangan'] = '-';

    $videotron = Videotron::create($validated);

    if ($videotron) {
        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    } else {
        return redirect()->back()->withErrors(['error' => 'Gagal menyimpan data!']);
    }
}
    public function index()
    {
        $data = Videotron::all();

        // $data->map(function ($item) {
        //     $now = Carbon::now();
        //     $mulai = Carbon::parse($item->tanggal_mulai);
        //     $selesai = Carbon::parse($item->tanggal_selesai);

        //     if ($now->lt($mulai)) {
        //         $item->status = 'Belum Dilaksanakan';
        //     } elseif ($now->between($mulai, $selesai)) {
        //         $item->status = 'Sedang Berlangsung';
        //     } else {
        //         $item->status = 'Sudah Selesai';
        //     }

        //     return $item;
        // );

    return view('pages.adminvideotron', compact('data'));
    }

    public function index2()
    {
        $data2 = Videotron::all();

    return view('pages.main', compact('data2'));
    }
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'tanggal_mulai'   => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'waktumulai'      => 'required', 
        'waktuselesai'    => 'required',
        'nama_acara'      => 'required|string|max:255', 
        'link_video'      => 'nullable|string|max:255',
    ]);
    $videotron = Videotron::findOrFail($id);
    $videotron->update($validated);

    return redirect()->back()->with('success', 'Data berhasil diperbarui!');
}
     public function destroy($id)
    {
        $data = videotron::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

      public function approve(Request $request, $id)
{
    $data = videotron::findOrFail($id);
    $data->nama_petugas = $request->nama_petugas;
    $data->contact_petugas = $request->contact_petugas;
    $data->status = 'Disetujui';
    $data->save();

    return redirect()->back()->with('success', 'Data peminjaman disetujui dan petugas diisi.');
}
    public function reject(Request $request, $id)
{
    $request->validate([
        'keterangan' => 'required|string|max:255',
    ]);
    $data = videotron::findOrFail($id);
    $data->status = 'Tidak Disetujui';
    $data->keterangan = $request->keterangan;
    $data->save();

    return redirect()->back()->with('success', 'Data peminjaman ditolak.');
}

    public function count()
    {    
    }
}
