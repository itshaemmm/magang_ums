@extends('components.adminheader')
@section('title', 'Dashboard Ruang SIC')

@section('content')
    <h3 class="mt-4 pb-4">Peminjaman Ruang SIC</h3>
    <div class="card mb-4">
        <div class="table-responsive">
            <table id="datatablesSimple" class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Kegiatan</th>
                        <th>Sektor</th>
                        <th>Nama Peminjam</th>
                        <th>Contact Peminjam</th>
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
                    <td>{{ $item->waktustart }}</td>
                    <td>{{ $item->waktuend }}</td>
                    <td>{{ $item->kegiatan }}</td>
                    <td>{{ $item->sector }}</td>
                    <td>{{ $item->nama_peminjam }}</td>
                    <td>{{ $item->contact_peminjam }}</td>
                    <td>{{ $item->nama_petugas }}</td>
                    <td>{{ $item->contact_petugas }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->keterangan }}</td>
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

                            <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $item->id }}">
                                Update
                            </button>
                       
                            <!-- Modal Disetujui -->
                            <div class="modal fade" id="approveModal{{ $item->id }}" tabindex="-1" aria-labelledby="approveModalLabel{{ $item->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title" id="approveModalLabel{{ $item->id }}">Setujui Peminjaman & Isi Petugas</h5>
                                            <button type="button" class="btn-close bg-black" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('approve.ruang', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Nama Petugas</label>
                                                    <input type="text" name="nama_petugas" value="{{ $item->nama_petugas }}" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Contact Petugas</label>
                                                    <input type="text" name="contact_petugas" value="{{ $item->contact_petugas }}" class="form-control" required>
                                                </div>
                                                <input type="hidden" name="status" value="disetujui">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-success">Setujui & Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Reject -->
                            <!-- Modal Reject -->
                            <div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $item->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="rejectModalLabel{{ $item->id }}">Tolak Peminjaman</h5>
                                            <button type="button" class="btn-close bg-black" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('reject.ruang', $item->id) }}" method="POST">
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



                            <!-- Modal update -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Update Data Ruang SIC</h5>
                                            <button type="button" class="btn-close bg-black" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('updateruang.update', $item->id) }}" method="POST">
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
                                                        <label class="form-label fw-bold">Waktu Mulai</label>
                                                        <input type="time" name="waktustart" class="form-control"
                                                            value="{{ $item->waktustart }}" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Waktu Selesai</label>
                                                        <input type="time" name="waktuend" class="form-control"
                                                            value="{{ $item->waktuend }}" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Kegiatan</label>
                                                        <input type="text" name="kegiatan" class="form-control"
                                                            value="{{ $item->kegiatan }}" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Sector</label>
                                                        <input type="text" name="sector" class="form-control"
                                                            value="{{ $item->sector }}" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Nama Peminjam</label>
                                                        <input type="text" name="nama_peminjam" class="form-control"
                                                            value="{{ $item->nama_peminjam }}" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Contact Person</label>
                                                        <input type="text" name="contact_peminjam" class="form-control"
                                                        value="{{ $item->contact_peminjam }}" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Status</label>
                                                        <select name="status" class="form-select text-dark">
                                                            <option value="menunggu" {{ $item->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                            <option value="disetujui" {{ $item->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                                            <option value="tidak_disetujui" {{ $item->status == 'tidak_disetujui' ? 'selected' : '' }}>Tidak Disetujui</option>
                                                    </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-bold">Keterangan</label>
                                                        <input type="text" name="keterangan" class="form-control"
                                                        value="{{ $item->keterangan}}" nullable>
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
                            <form action="{{ route('adminsic.destroy', $item->id) }}" method="POST"
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
