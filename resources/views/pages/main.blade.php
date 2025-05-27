@include('components.header')

    <main>
        <section>
            <div class="page-header min-vh-75 relative" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.2) 10%, rgba(0,0,0,0.7) 90%), url('{{ asset('img/business-meeting-room-high-rise-office-building.jpg') }}')">
            <span class="mask bg-gradient-dark opacity-4"></span>
            <div class="container">
                <div class="row">
                <div class="col-lg-10 text-center mx-auto">
                    <h1 class="text-white font-weight-black pt-3 mt-n5">Peminjaman Ruangan SIC dan Videotron</h1>
                    <p class="lead text-white mt-3">Pelayanan Peminjaman Ruangan SIC Dan Videotron Dinas Komunikasi dan Informatika Kabupaten Karanganyar</p>
                </div>
                </div>
            </div>
            </div>
        </section>
    </main>

    <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">



        <section class="pt-3 pb-4">
          <H5 class="text-center pb-4">Layanan Kami</H5>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="card text-center h-100">
                            <div class="card-body shadow-lg">
                              <img src="{{ asset('img/business-meeting-room-high-rise-office-building.jpg') }}" alt="Gambar" class="card-img">
                              <h5 class="mt-4">Peminjaman Ruangan SIC</h5>
                              <p class="card-text">Apabila Tersedia</p>
                              <a href="{{ route('ruang') }}"><button class="btn bg-gradient-dark">Reservasi disini</button></a>
                            </div>
                        </div>                          
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card text-center h-100">
                            <div class="card-body shadow-lg">
                              <img src="{{ asset('img/business-meeting-room-high-rise-office-building.jpg') }}" alt="Gambar" class="card-img">
                              <h5 class="mt-4">Pemesanan Videotron</h5>
                              <p class="card-text">Apabila Tersedia</p>
                              <a href="/videotron"><button class="btn bg-gradient-dark">Reservasi disini</button></a>
                            </div>
                        </div>                          
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card text-center h-100">
                            <div class="card-body shadow-lg">
                              <img src="{{ asset('img/business-meeting-room-high-rise-office-building.jpg') }}" alt="Gambar" class="card-img">
                              <h5 class="mt-4">Pelayanan Website Hosting</h5>
                              <p class="card-text">Apabila Tersedia</p>
                              <a href="/hosting"><button class="btn bg-gradient-dark">Reservasi disini</button></a>
                            </div>
                        </div>                          
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-center h-100">
                            <div class="card-body shadow-lg">
                              <img src="{{ asset('img/business-meeting-room-high-rise-office-building.jpg') }}" alt="Gambar" class="card-img">
                              <h5 class="mt-4">Pelayanan Zoom Meeting</h5>
                              <p class="card-text">Apabila Tersedia</p>
                              <a href="/zoom"><button class="btn bg-gradient-dark">Reservasi disini</button></a>
                            </div>
                        </div>                          
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-3 pb-4">
            <div class="container">
              <h5 class="text-center mb-3">Jadwal Peminjaman Ruangan SIC</h5>
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Leading Sector</th>
                            <th>Kegiatan</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php
                            $data = $data ?? collect();
                            $filtered = $data->where('status', 'Disetujui');
                        @endphp

                        @forelse ($filtered as $item)
                            <tr>
                                <td>{{ $item->tanggal }}</td>
                                   <td>
                                        {{ \Carbon\Carbon::parse($item->waktustart)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($item->waktuend)->format('H:i') }}
                                    </td>
                                <td>{{ $item->sector }}</td>
                                <td>{{ $item->kegiatan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada peminjaman yang disetujui</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
              </div>
            </div>
          </section>

    </div>


@include('components.footer')