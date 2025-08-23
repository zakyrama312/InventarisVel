<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventaris Vel | Print</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('/')}}assets/images/logos/favicon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="text-center">
            <h1>KARTU INVENTARIS RUANGAN</h1>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <table style="font-weight: 500;">
                    <tr>
                        <td>KABUPATEN/KOTA</td>
                        <td>:</td>
                        <td>KABUPATEN TEGAL</td>
                    </tr>
                    <tr>
                        <td>PROVINSI</td>
                        <td>:</td>
                        <td>JAWA TENGAH</td>
                    </tr>
                    <tr>
                        <td>UNIT KERJA</td>
                        <td>:</td>
                        <td>DINAS PENDIDIKAN DAN KEBUDAYAAN</td>
                    </tr>
                    <tr>
                        <td>SATUAN KERJA</td>
                        <td>:</td>
                        <td>SMK NEGERI 1 SLAWI</td>
                    </tr>
                    <tr>
                        <td>RUANGAN</td>
                        <td>:</td>
                        <td>{{ $ruang->nama_ruang }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6 ">
                <table style="font-weight: 500;" class="ms-auto">
                    <tr>
                        <td>NO. KODE LOKASI</td>
                        <td>:</td>
                        <td>1.01.01.12.05.12</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <table class="table table-bordered" style="border: 1px solid black;">
                <thead>
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Merk / Model</th>
                        <th class="text-center">Spesifikasi</th>
                        <th class="text-center">Ukuran</th>
                        <th class="text-center">Bahan</th>
                        <th class="text-center">Tahun Pembuatan</th>
                        <th class="text-center">Kode Barang</th>
                        <th class="text-center">Jumlah Barang</th>
                        <th class="text-center">Harga Beli</th>
                        <th class="text-center">Keadaan Barang</th>
                        <th class="text-center">Keterangan</th>
                    </tr>
                </thead>
                @foreach ($barangmasuk as $bm)
                <tbody>
                    <tr>
                        <td scope="row" class="text-center">{{ $loop -> iteration }}</td>
                        <td>{{ $bm->nama_barang }}</td>
                        <td>{{ $bm->merk }}</td>
                        <td>{{ $bm->spesifikasi }}</td>
                        <td class="text-center">{{ $bm->ukuran }}</td>
                        <td class="text-center">{{ $bm->bahan }}</td>
                        <td class="text-center">{{ $bm->tahun_beli }}</td>
                        <td class="text-center">{{ $bm->kode_barang }}</td>
                        <td class="text-center">{{ $bm->barangstoks->sum('stok_masuk') }}</td>
                        <td class="text-center">{{ $bm->harga_beli }}</td>
                        <td class="text-center">{{ $bm->kondisi->nama_kondisi }}</td>
                        <td>{{ $bm->keterangan }}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4" style="font-weight: 500;">
                <p>Mengetahui,</p>
                <p style="margin-top: -15px;">Kepala SMK Negeri 1 Slawi</p>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-4" style="font-weight: 500;">
                <p>Slawi, {{ $tanggal }}</p>
                <p style="margin-top: -15px;">Pengurus Barang</p>

            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-1"></div>
            <div class="col-md-4" style="font-weight: 500;">
                <p>Dra. Lutfah Barliana, M.Pd</p>
                <p style="margin-top: -15px;">NIP.19701127 199802 2 005</p>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-4" style="font-weight: 500;">
                <p>Harwoto</p>
                <p style="margin-top: -15px;">NIP.19780612 200901 1 008</p>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        window.print()
    </script>
</body>

</html>