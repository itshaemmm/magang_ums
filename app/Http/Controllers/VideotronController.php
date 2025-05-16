<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videotron;
use Carbon\Carbon;

class VideotronController extends Controller
{
    /**
     * Menyimpan data videotron ke database.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'kegiatan'        => 'required|string|max:255',
            'sector'          => 'required|string|max:255',
            'petugas'         => 'required|string|max:255',
            'link_video'      => 'nullable|string|max:255',
        ]);

        // Simpan ke database
        Videotron::create($validated);
        // Redirect atau response
        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }
    public function index()
    {
        $data = videotron::all();
        $data->map(function ($item) {
            $waktuSelesai = Carbon::parse($item->tanggal . ' ' . $item->waktuend);
            $item->status = $waktuSelesai->isPast() ? 'Sudah Selesai' : 'Belum Dilaksanakan';
            return $item;
        });
        return view('pages.adminvideotron', compact('data'));
    }
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'kegiatan' => 'required|string|max:255',
        'sector' => 'required|string|max:100',
        'petugas' => 'required|string|max:100',
        'link_video' => 'required',
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

}
