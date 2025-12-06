<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="icon" href="{{ asset('assets/icon.png') }}" />
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <div class="container">
        <header>
            <nav>
                <div class="logo">
                    <img src="{{ asset('assets/logo.png') }}" alt="" />
                </div>
                <input type="checkbox" id="click" />
                <label for="click" class="menu-btn">
                    <i class="fas fa-bars"></i>
                </label>
                <ul>
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#">Kategori</a></li>
                    <li><a href="#" class="btn_login">Masuk</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <div class="jumbotron">
                <div class="jumbotron-text">
                    <h1>Cari Kucing Kecil Barumu, Jadilah Temannya</h1>
                    <p>Teman barumu yang lucu menunggu mu, ayo temukan mereka sekarang</p>
                    <button type="button" class="btn_getStarted">Mulai</button>
                </div>
                <div class="jumbotron-img">
                    <img src="assets/jumbotron.png" alt="" />
                </div>
            </div>
            <div class="cards-categories">
                <h2>Kategori Kucing</h2>
                <div class="card-categories">
                    @if (count($categories) == 0)
                        <h3 style="text-align: center; color: red;">Data Kosong</h3>
                    @endif
                    @foreach ($categories as $data)
                        <div class="card">
                            <div class="card-image">
                                <img src="{{ asset('img_categories/' . $data->gambar) }}" alt="tidak ada gambar" />
                            </div>
                            <div class="card-content">
                                <h5>{{ $data->nama }}</h5>
                                <p class="description">{{ $data->deskripsi }}</p>
                                <p class="price">{{ $data->harga }}</p>
                                <button class="btn_belanja" type="button"
                                    onclick='bukaModal({{ $data->id_categories }})'>Beli</button>
                            </div>
                        </div>
                        <!-- Modal 1 -->
                        <div id="myModal{{ $data->id_categories }}" class="modal-container"
                            onclick="tutupModal({{ $data->id_categories }})">
                            <div class="modal-dialog" onclick="event.stopPropagation()">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title " style="color:  #ffb72b;">Formulir Pembayaran</h1>
                                        <button type="button" class="btn-close" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <input type="hidden" name="category_id" id="category_id"
                                                value="{{ $data->id_categories }}">
                                            <div class="form-group">
                                                <label class="labelmodal" for="recipient-name">Nama :</label>
                                                <input class="inputdata" type="text" class="form-control"
                                                    id="recipient-name">
                                            </div>
                                            <div class="form-group">
                                                <label class="labelmodal" for="handphone">No. Hp :</label>
                                                <input class="inputdata" type="text" class="form-control"
                                                    id="handphone">
                                            </div>
                                            <div class="form-group">
                                                <label class="labelmodal" for="alamat-text">Alamat:</label>
                                                <textarea class="inputalamat" class="form-control" id="alamat-text"></textarea>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            onclick="tutupModal({{ $data->id_categories }})">Keluar</button>
                                        <button type="button" class="btn btn-yellow"
                                            onclick="bukaModal2({{ $data->id_categories }})">Lanjutkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal 2 -->
                        <div id="myModal2{{ $data->id_categories }}" class="modal-container"
                            onclick="tutupModal2({{ $data->id_categories }})">
                            <div class="modal-dialog" onclick="event.stopPropagation()">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title" style="color:  #ffb72b;">Data Transaksi</h1>
                                        <button type="button" class="btn-close" aria-label="Close"
                                            onclick="tutupModal2()"></button>
                                    </div>
                                    <form action="{{ route('transaction') }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <h4> Kategori</h4>
                                            <div class="form-group">
                                                <input type="hidden" name="id_categories"
                                                    value="{{ $data->id_categories }}">
                                                <label class="labelmodal" for="detail-kategori">Kategori :</label>
                                                <input class="inputdata" type="text" name="detail-kategori"
                                                    class="form-control" id="detail-kategori"
                                                    value="{{ $data->nama }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="labelmodal" for="detail-harga">Harga :</label>
                                                <input class="inputdata" type="text" name="detail-harga"
                                                    class="form-control" id="detail-harga"
                                                    value="{{ $data->harga }}" readonly>
                                            </div>
                                            <h4>Pembeli</h4>
                                            <div class="form-group">
                                                <label class="labelmodal" for="detail-nama">Nama :</label>
                                                <input class="inputdata" name="detail-nama" type="text"
                                                    class="form-control" id="detail-nama" readonly>
                                                @error('detail-nama')
                                                    <p style="font-size: 10px; color: red">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="labelmodal" for="detail-nomorhp">No. Hp :</label>
                                                <input class="inputdata" name="detail-nomor" type="text"
                                                    class="form-control" id="detail-nomorhp" readonly>
                                                @error('detail-nomor')
                                                    <p style="font-size: 10px; color: red">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="labelmodal" for="detail-alamat">Alamat:</label>
                                                <textarea class="inputalamat" name="detail-alamat" class="form-control" id="detail-alamat" readonly></textarea>
                                                @error('detail-alamat')
                                                    <p style="font-size: 10px; color: red">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <input type="hidden" name="status" value="succes">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                onclick="kembaliKeModalPertama({{ $data->id_categories }})">Kembali</button>
                                            <button name="simpan" type="submit" class="btn btn-yellow"
                                                onclick="lakukanPembayaran()">Lakukan Pembayaran</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


        </main>
        <footer>
            <h4>&copy; Lab Pemrograman Komputer 2025</h4>
        </footer>
    </div>
    <script>
        function bukaModal(categoryId) {
            var modal = document.getElementById('myModal' + categoryId);
            modal.style.display = 'flex';
        }

        function tutupModal(categoryId) {
            var modal = document.getElementById('myModal' + categoryId);
            modal.style.display = 'none';
        }

        function bukaModal2(categoryId) {
            tutupModal(categoryId); // Tutup modal pertama
            var modal2 = document.getElementById('myModal2' + categoryId);
            modal2.style.display = 'flex';

            // Ambil nilai dari input fields pada modal pertama
            var modal1 = document.getElementById('myModal' + categoryId);
            var nama = modal1.querySelector("#recipient-name").value;
            var nomorhp = modal1.querySelector("#handphone").value;
            var alamat = modal1.querySelector("#alamat-text").value;

            // Set nilai pada modal kedua
            var modal2 = document.getElementById('myModal2' + categoryId);
            modal2.querySelector("#detail-nama").value = nama;
            modal2.querySelector("#detail-nomorhp").value = nomorhp;
            modal2.querySelector("#detail-alamat").value = alamat;

        }

        function tutupModal2(categoryId) {
            var modal2 = document.getElementById('myModal2' + categoryId);
            modal2.style.display = 'none';
        }
        function kembaliKeModalPertama(categoryId) {
            tutupModal2(categoryId);
            bukaModal(categoryId);
        }
        window.onclick = function(event) {
            if (event.target.classList.contains('modal-container')) {
                event.target.style.display = 'none';
            }
        };

        function lakukanPembayaran() {
            alert("Pembayaran berhasil!");
            tutupModal2();
            document.getElementById("recipient-name").value = "";
            document.getElementById("handphone").value = "";
            document.getElementById("alamat-text").value = "";
        }
    </script>
</body>

</html>
