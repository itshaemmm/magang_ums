<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hosting;

class HostingController extends Controller
{
    public function store(Request $request)
    {
    // Validasi input dari form
            $validated = $request->validate([
            'nama_website'      => 'required|string',
            'sector'          => 'required|string',
            'link_github'     => 'required|string|max:255',
            'nama_user'     => 'required|string|max:255',
            'contact_user'     => 'required|string|max:255',
            
        ]);
        $validated['status'] = 'Menunggu';
        $validated['nama_petugas'] = '-';
        $validated['contact_petugas'] = '-';

        // Simpan ke database
        Hosting::create($validated);
        // Redirect atau response
        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }
     public function index()
    {
        $data = hosting::all();
        // $data->map(function ($item) {
        //     $waktuSelesai = Carbon::parse($item->tanggal . ' ' . $item->waktuend);
        //     $item->status = $waktuSelesai->isPast() ? 'Sudah Selesai' : 'Belum Dilaksanakan';
        //     return $item;
        // });
        return view('pages.adminhosting', compact('data'));
    }
      public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nama_website' => 'required|string',
        'sector' => 'required|string',
        'nama_user' => 'required|string',
        'contact_user' => 'required|string',
        'nama_petugas' => 'required|string',
        'contact_petugas' => 'required|string',
        'link_github' => 'nullable|string',
        'status' => 'required|string',
    ]);

    $videotron = hosting::findOrFail($id);
    $videotron->update($validated);

    return redirect()->back()->with('success', 'Data berhasil diperbarui!');
}
     public function destroy($id)
    {
        $data = hosting::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function approve(Request $request, $id)
    {
    $data = hosting::findOrFail($id);
    $data->nama_petugas = $request->nama_petugas;
    $data->contact_petugas = $request->contact_petugas;
    $data->status = 'Disetujui';
    $data->save();

    return redirect()->back()->with('success', 'Data pengajuan disetujui dan petugas diisi.');
    }

    public function reject(Request $request, $id)
    {
    $request->validate([
        'keterangan' => 'required|string|max:255',
    ]);
    $data = hosting::findOrFail($id);
    $data->status = 'Tidak Disetujui';
    $data->keterangan = $request-> keterangan;
    $data->save();

    return redirect()->back()->with('success', 'Data pengajuan ditolak.');
    }   

    public function count()
    {    
    }
}



