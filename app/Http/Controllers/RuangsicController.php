<?php

namespace App\Http\Controllers;

use App\Models\ruangsic;
use App\Models\Videotron;
use App\Models\Hosting;
use App\Models\Zoom;

use Illuminate\Http\Request;
use Carbon\Carbon;


class RuangsicController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
        'tanggal' => ['required', 'date'],
        'waktustart' => ['required'],
        'waktuend' => ['required'],
        'kegiatan' => ['required'],
        'sector' => ['required'],
        'contact_peminjam' => [
            'required',
            'regex:/^(\+62|62|0)8[1-9][0-9]{6,9}$/',
            'min:10',
            'max:15'
        ],
        'nama_peminjam' => ['required'],
    ]);
    
        ruangsic::create([
            'tanggal' => $request->tanggal,
            'waktustart' => $request->waktustart,
            'waktuend' => $request->waktuend,
            'kegiatan' => $request->kegiatan,
            'sector' => $request->sector,
            'nama_peminjam' => $request->nama_peminjam,
            'contact_peminjam' => $request->contact_peminjam,
            'nama_petugas' => '-', 
            'contact_petugas' => '-', 
            'status' => 'menunggu' 
        ]);

        $conflict = ruangsic::where('tanggal', $request->tanggal)
            ->where(function($query) use ($request) {
                $query->where('waktustart', '<', $request->waktuend)
                    ->where('waktuend', '>', $request->waktustart);
            })
            ->count() > 1; 

        if ($conflict) {
            return redirect()->back()->with([
                'success' => 'Peminjaman berhasil disimpan.',
                'duplicate' => 'Peminjaman berhasil disimpan. Terdapat jadwal lain yang bentrok dengan waktu yang Anda ajukan. Silakan menunggu konfirmasi.'
            ]);
        }

        return redirect()->back()->with('success', 'Peminjaman berhasil disimpan.');
        

    }

    public function approve(Request $request, $id)
{
    $data = ruangsic::findOrFail($id);
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
    $data = ruangsic::findOrFail($id);
    $data->status = 'Tidak Disetujui';
    $data->keterangan = $request->keterangan;
    $data->save();

    return redirect()->back()->with('success', 'Data peminjaman ditolak.');
}

    public function index()
    {
        $data = ruangsic::all();
        return view('pages.adminsic', compact('data'));
    }

    public function index2()
    {
        $data = ruangsic::all();
        // $data = ruangsic::all()->filter(function ($item) {
        //     // $waktuSelesai = Carbon::parse($item->tanggal . ' ' . $item->waktuend);
        //     // return $waktuSelesai->isFuture(); // hanya ambil yang BELUM lewat
        // });

        return view('pages.main', compact('data'));
    }



    public function update(Request $request, $id){
       // Validasi data
    $validated = $request->validate([
        'tanggal' => ['required', 'date'],
        'waktustart' => ['required'],
        'waktuend' => ['required'],
        'kegiatan' => ['required'],
        'sector' => ['required'],
        'contact_peminjam' => [
            'required',
            'regex:/^(\+62|62|0)8[1-9][0-9]{6,9}$/',
            'min:10',
            'max:15'
        ],
        'nama_peminjam' => ['required'],
        'keterangan' => ['nullable'],
        'nama_petugas' => ['nullable'],
        'contact_petugas' => ['nullable'],
        'status' => ['required']
    ]);

    // Cari dan update data
    $ruang = \App\Models\ruangsic::findOrFail($id);
    $ruang->update($validated);

    return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = ruangsic::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function count()
{
    $now = Carbon::now(); // waktu sekarang

    $ruanganBelum = ruangsic::where(function ($query) use ($now) {
        $query->where('tanggal', '>', $now->toDateString()) // besok atau nanti
              ->orWhere(function ($q) use ($now) {
                  $q->where('tanggal', '=', $now->toDateString())
                    ->where('waktuend', '>', $now->format('H:i:s'));
              });
    })->count();

    $videotronBelum = Videotron::whereDate('tanggal_mulai', '>', $now)->count();

    $zoomBelum = Zoom::where(function ($query) use ($now) {
        $query->where('tanggal', '>', $now->toDateString())
              ->orWhere(function ($q) use ($now) {
                  $q->where('tanggal', '=', $now->toDateString())
                    ->where('waktu', '>', $now->format('H:i:s'));
              });
    })->count();

    $hostingBelum = Hosting::where('status', 'Menunggu')->count();

    return view('pages.admin', [
        'ruanganBelum' => $ruanganBelum,
        'videotronBelum' => $videotronBelum,
        'zoomBelum' => $zoomBelum,
        'hostingBelum' => $hostingBelum
    ]);
}



}