@extends('components.adminheader')
@section('title', 'Dashboard Hosting')

@section('content')
    <h3 class="mt-4 pb-4">Pelayanan Website Hosting</h3>
    <div class="card mb-4">
        <div class="card-body">
            <table id="datatablesSimple" class="">
                <thead>
                    <tr>
                        <th>Nama Website</th>
                        <th>Sector</th>
                        <th>Nama Pihak</th>
                        <th>Contact Pihak</th>
                        <th>Nama Petugas</th>
                        <th>Contact Petugas</th>
                        <th>link Github</th>
                        <th>status</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
            <tr>
                <td>{{ $item->nama_website }}</td>
                <td>{{ $item->sector }}</td>
                <td>{{ $item->nama_user }}</td>
                <td>{{ $item->contact_user }}</td>
                <td>{{ $item->nama_petugas }}</td>
                <td>{{ $item->contact_petugas }}</td>
                <td>{{ $item->link_github }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->keterangan }}</td>
    {{-- <td>
        <span class="badge {{ $item->status == 'Sudah Selesai' ? 'bg-success' : 'bg-warning text-dark' }}">
            {{ $item->status }}
        </span>
    </td> --}}
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

  <!-- Modal Disetujui -->
                            <div class="modal fade" id="approveModal{{ $item->id }}" tabindex="-1" aria-labelledby="approveModalLabel{{ $item->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title" id="approveModalLabel{{ $item->id }}">Setujui Peminjaman & Isi Petugas</h5>
                                            <button type="button" class="btn-close bg-black" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('approve.hosting', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Nama Petugas</label>
                                                    <input type="text" name="nama_petugas" value="{{ $item->nama_petugas }}" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Jabatan Petugas</label>
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
                            <div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $item->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="rejectModalLabel{{ $item->id }}">Tolak Peminjaman</h5>
                                            <button type="button" class="btn-close bg-black" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                             <form action="{{ route('reject.hosting', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin <strong>menolak</strong> pengajuan ini?</p>
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
<!-- Modal Update -->
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Update Data Hosting</h5>
                <button type="button" class="btn-close bg-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('hosting.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Website</label>
                            <input type="text" name="nama_website" class="form-control"
                                value="{{ $item->nama_website }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Sector</label>
                            <input type="text" name="sector" class="form-control"
                                value="{{ $item->sector }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Pihak</label>
                            <input type="text" name="nama_user" class="form-control"
                                value="{{ $item->nama_user }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Contact Pihak</label>
                            <input type="text" name="contact_user" class="form-control"
                                value="{{ $item->contact_user }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Petugas</label>
                            <input type="text" name="nama_petugas" class="form-control"
                                value="{{ $item->nama_petugas }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Contact Petugas</label>
                            <input type="text" name="contact_petugas" class="form-control"
                                value="{{ $item->contact_petugas }}" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Link Github</label>
                            <input type="text" name="link_github" class="form-control"
                                value="{{ $item->link_github }}">
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
            <form action="{{ route('hosting.destroy', $item->id) }}" method="POST"
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
