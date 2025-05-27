@extends('components.adminheader')
@section('title', 'Dashboard Videotron')

@section('content')
<h3 class="mt-4 pb-4">Peminjaman Videotron</h3>
<div class="card mb-4">
    <div class="card-body">
        <table id="datatablesSimple" class="table table-striped">
            <thead>
                <tr>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Nama Acara</th>
                    <th>Link Video</th>
                    <th>Nama Peminjam</th>
                    <th>Kontak Peminjam</th>
                    <th>Nama Petugas</th>
                    <th>Kontak Petugas</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->tanggal_mulai }}</td>
                    <td>{{ $item->tanggal_selesai }}</td>
                    <td>{{ $item->waktumulai }}</td>
                    <td>{{ $item->waktuselesai }}</td>
                    <td>{{ $item->nama_acara }}</td>
                    <td>{{ $item->link_video }}</td>
                    <td>{{ $item->nama_peminjam }}</td>
                    <td>{{ $item->contact_peminjam }}</td>
                    <td>{{ $item->nama_petugas }}</td>
                    <td>{{ $item->contact_petugas }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td class="text-center">
                        <div class="d-flex flex-column align-items-center">

                            <!-- Tombol Modal Setujui -->
                            <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#approveModal{{ $item->id }}">Disetujui</button>

                            <!-- Modal Approve -->
                            <div class="modal fade" id="approveModal{{ $item->id }}" tabindex="-1" aria-labelledby="approveModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title">Setujui & Isi Petugas</h5>
                                            <button type="button" class="btn-close bg-black" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('approve.videotron', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Nama Petugas</label>
                                                    <input type="text" name="nama_petugas" value="{{ $item->nama_petugas }}" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Kontak Petugas</label>
                                                    <input type="text" name="contact_petugas" value="{{ $item->contact_petugas }}" class="form-control" required>
                                                </div>
                                                <input type="hidden" name="status" value="disetujui">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Modal Reject -->
                            <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $item->id }}">Ditolak</button>

                            <!-- Modal Reject -->
                            <div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">Tolak Peminjaman</h5>
                                            <button type="button" class="btn-close bg-black" data-bs-dismiss="modal"></button>
                                        </div>
                                           <form action="{{ route('reject.videotron', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin <strong>menolak</strong> peminjaman ini?</p>
                                                <div class="mb-3">
                                                    <label for="keterangan" class="form-label fw-bold">Keterangan Penolakan</label>
                                                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Masukkan alasan penolakan..." required></textarea>
                                                </div>
                                                <input type="hidden" name="status" value="tidak_disetujui">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Tolak</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Modal Update -->
                            <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Update</button>

    
                          <!-- Modal Edit -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title">Edit Peminjaman</h5>
                                            <button type="button" class="btn-close bg-black" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('videotron.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Tanggal Mulai</label>
                                                        <input type="date" name="tanggal_mulai" class="form-control" value="{{ $item->tanggal_mulai }}" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Tanggal Selesai</label>
                                                        <input type="date" name="tanggal_selesai" class="form-control" value="{{ $item->tanggal_selesai }}" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Waktu Mulai</label>
                                                        <input type="time" name="waktumulai" class="form-control" value="{{ $item->waktumulai }}" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Waktu Selesai</label>
                                                        <input type="time" name="waktuselesai" class="form-control" value="{{ $item->waktuselesai }}" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Nama Acara</label>
                                                        <input type="text" name="nama_acara" class="form-control" value="{{ $item->nama_acara }}" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Link Video</label>
                                                        <input type="text" name="link_video" class="form-control" value="{{ $item->link_video }}">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Nama Peminjam</label>
                                                        <input type="text" name="nama_peminjam" class="form-control" value="{{ $item->nama_peminjam }}" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Kontak Peminjam</label>
                                                        <input type="text" name="contact_peminjam" class="form-control" value="{{ $item->contact_peminjam }}" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Nama Petugas</label>
                                                        <input type="text" name="nama_petugas" class="form-control" value="{{ $item->nama_petugas }}">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Kontak Petugas</label>
                                                        <input type="text" name="contact_petugas" class="form-control" value="{{ $item->contact_petugas }}">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Status</label>
                                                        <select name="status" class="form-control">
                                                            <option value="Menunggu" {{ $item->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                            <option value="Disetujui" {{ $item->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                                            <option value="Ditolak" {{ $item->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold">Keterangan</label>
                                                        <textarea name="keterangan" class="form-control" rows="2">{{ $item->keterangan }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!-- Tombol Hapus -->
                            <form action="{{ route('videotron.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-dark">Hapus</button>
                            </form>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
