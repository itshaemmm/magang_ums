@include('components.header')

<main>
    <section>
        <div class="page-header min-vh-75 relative"
            style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.2) 10%, rgba(0,0,0,0.7) 90%), url('{{ asset('img/business-meeting-room-high-rise-office-building.jpg') }}')">
            <span class="mask bg-gradient-dark opacity-4"></span>
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 text-center mx-auto">
                        <h1 class="text-white font-weight-black pt-3 mt-n5">Pesan Ruangan</h1>
                        <p class="lead text-white mt-3">Pelayanan Pemesanan Ruangan Dinas Komunikasi dan Informatika
                            Kabupaten Karanganyar</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-n8">
            <section class="pt-5 pb-5">
                <div class="container">
                    <div class="card rounded-4" style="box-shadow: 5px 5px 20px 1px rgba(0,0,0, 0.20)">
                        <div class="card-header bg-gradient-dark text-white rounded-top-4">
                            <h5 class="mb-0 text-white">Formulir Peminjaman Ruangan</h5>
                        </div>
                        <form action="{{ route('ruang.store') }}" method="POST" class="p-4 row">
                            @csrf
                            <h6 class="fw-bold">Silakan isi dengan sesuai:</h6>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tanggal Peminjaman</label>
                                <input type="date" name="tanggal" class="form-control border border-2 shadow-sm px-2"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Waktu Mulai</label>
                                <input type="time" name="waktustart"
                                    class="form-control border border-2 shadow-sm px-2" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Waktu Selesai</label>
                                <input type="time" name="waktuend"
                                    class="form-control border border-2 shadow-sm px-2" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Kegiatan</label>
                                <input type="text" name="kegiatan"
                                    class="form-control border border-2 shadow-sm px-2" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Leading Sector</label>
                                <input type="text" name="sector" class="form-control border border-2 shadow-sm px-2"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Peminjam</label>
                                <input type="text" name="nama_peminjam" class="form-control border border-2 shadow-sm px-2"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Contact Person (Nomor Telpon)</label>
                                <input type="tel" pattern="[0-9]{10,15}" name="contact_peminjam" class="form-control border border-2 shadow-sm px-2"
                                    required>
                            </div>
                            <button type="submit" class="btn bg-gradient-dark mt-2">Kirim</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>

@if (session('duplicate'))
    <style>
        #popup-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(5px);
            z-index: 998;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .popup {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            padding: 30px;
            text-align: center;
            z-index: 999;
            width: 90%;
            max-width: 400px;
        }

        .popup h4 {
            color: red;
            font-weight: bold;
        }
    </style>

    <div id="popup-wrapper">
        <div class="popup">
            <h4>Jadwal Bentrok</h4>
            <p>{{ session('duplicate') }}</p>
            <button onclick="closePopup()" class="btn btn-danger">Tutup</button>
        </div>
    </div>

    <script>
        function closePopup() {
            const popup = document.getElementById('popup-wrapper');
            if (popup) {
                popup.remove();
            }
        }

        window.onload = function() {
            setTimeout(() => {
                closePopup();
            }, 10000);
        }
    </script>
@elseif (session('success'))
    <style>
        #popup-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(5px);
            z-index: 998;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .popup {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            padding: 30px;
            text-align: center;
            z-index: 999;
            width: 90%;
            max-width: 400px;
        }

        .popup h4 {
            color: green;
            font-weight: bold;
        }
    </style>

    <div id="popup-wrapper">
        <div class="popup">
            <h4>Peminjaman Berhasil</h4>
            <p>{{ session('success') }}</p>
            <button onclick="closePopup()" class="btn btn-success">Tutup</button>
        </div>
    </div>

    <script>
        function closePopup() {
            const popup = document.getElementById('popup-wrapper');
            if (popup) {
                popup.remove();
                location.reload();
            }
        }

        window.onload = function() {
            setTimeout(() => {
                closePopup();
            }, 10000);
        }
    </script>
@endif


    </section>
</main>

