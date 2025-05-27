@extends('components.adminheader')
@section('title', 'Dashboard Videotron')

@section('content')
    <h3 class="mt-4 pb-4">Pelayanan Zoom Meeting</h3>
    <div class="card mb-4">
        <div class="card-body">
            <table id="datatablesSimple" class="">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>nama</th>
                        <th>Nama Penyelenggara</th>
                        <th>Contact Penyelenggara</th>
                        <th>Sektor</th>
                        <th>Nama Petugas</th>
                        <th>Contact Petugas</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
<tr>
    <td>{{ $item->tanggal }}</td>
    <td>{{ $item->waktu }}</td>
    <td>{{ $item->nama }}</td>
    <td>{{ $item->nama_user }}</td>
    <td>{{ $item->contact_user }}</td>
    <td>{{ $item->sector }}</td>
    <td>{{ $item->nama_petugas }}</td>
    <td>{{ $item->contact_petugas }}</td>
    <td>
        {{-- <span class="badge {{ $item->status == 'Sudah Selesai' ? 'bg-success' : 'bg-warning text-dark' }}"> --}}
            {{ $item->status }}
        {{-- </span> --}}
    </td>
    <td>{{ $item ->keterangan }}</td>
    <td class="text-center">
        <div class="d-flex flex-column align-items-center">
            <!-- Trigger Modal -->
            <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal"
                data-bs-target="#approveModal{{ $item->id }}">
                Disetujui
            </button>

            <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal"
                data-bs-target="#rejectModal{{ $item->id }}">
                Ditolak
            </button>

            <button type="button" class="btn bg-gradient-dark mb-2" data-bs-toggle="modal"
                data-bs-target="#editModal{{ $item->id }}">
                Update
            </button>

                <!-- Modal Approve -->
                <div class="modal fade" id="approveModal{{ $item->id }}" tabindex="-1" aria-labelledby="approveModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content rounded-4">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title">Setujui & Isi Petugas</h5>
                                <button type="button" class="btn-close bg-black" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('approve.zoom', $item->id) }}" method="POST">
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

                                <!-- Modal Reject -->
                <div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content rounded-4">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title">Tolak Peminjaman</h5>
                                <button type="button" class="btn-close bg-black" data-bs-dismiss="modal"></button>
                            </div>
                      <form action="{{ route('reject.zoom', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin <strong>menolak</strong> zoom ini?</p>
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

            <!-- Modal -->
            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content rounded-4">
                        <div class="modal-header bg-dark text-white">
                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Update Peminjaman Zoom Meeting</h5>
                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('zoom.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control"
                                            value="{{ $item->tanggal }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Waktu</label>
                                        <input type="time" name="waktu" class="form-control"
                                            value="{{ $item->waktu }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Nama</label>
                                        <input type="text" name="nama" class="form-control"
                                            value="{{ $item->nama }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Sektor</label>
                                        <input type="text" name="sector" class="form-control"
                                            value="{{ $item->sector }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <!-- Tombol Hapus -->
            <form action="{{ route('zoom.destroy', $item->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn bg-gradient-dark">Hapus</button>
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
