
$(document).ready(function() {
    // Inisialisasi DataTable untuk tabel barangMasuk
    var urlBarangMasuk = $('#tabeldataBarangMasuk').data('url');
    var tableBarangMasuk = $('#tabeldataBarangMasuk').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: urlBarangMasuk,
            data: function(d) {
                d.start_date = $('#start_date').val(); // Ambil nilai tanggal awal
                d.end_date = $('#end_date').val(); // Ambil nilai tanggal akhir
            }
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                className: 'text-center'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'nama_barang',
                name: 'nama_barang'
            },
            {
                data: 'merk',
                name: 'merk',
                className: 'text-center'
            },
            {
                data: 'stok_masuk',
                name: 'stok_masuk',
                className: 'text-center'
            },
            {
                data: 'kondisi.nama_kondisi',
                name: 'kondisi.nama_kondisi',
                className: 'text-center'
            },
            {
                data: 'ruang.nama_ruang',
                name: 'ruang.nama_ruang'
            },
            {
                data: 'keterangan',
                name: 'keterangan'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        columnDefs: [{
            targets: 0,
            render: function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        }],
        lengthMenu: [
            [10, 25, 50, 100, -1], // Nilai '-1' berarti "semua data"
            [10, 25, 50, 100, "All"] // Label yang akan ditampilkan di dropdown
        ],
        dom: 'Blfrtip', // Menambahkan elemen kontrol DataTables
        buttons: [{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':not(:last-child)',
                    modifier: {
                        page: 'all'
                    }
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':not(:last-child)',
                    modifier: {
                        page: 'all'
                    }
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':not(:last-child)',
                    modifier: {
                        page: 'all'
                    }
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':not(:last-child)',
                    modifier: {
                        page: 'all'
                    }
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':not(:last-child)',
                    modifier: {
                        page: 'all'
                    }
                }
            }
        ]
    });

    var urlLaporanBarangMasuk = $('#tabellaporanBarangMasuk').data('url');
    var tableLaporanBarangMasuk = $('#tabellaporanBarangMasuk').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: urlLaporanBarangMasuk,
                data: function(d) {
                    d.start_date = $('#start_date').val(); // Ambil nilai tanggal awal
                    d.end_date = $('#end_date').val(); // Ambil nilai tanggal akhir
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'merk',
                    name: 'merk',
                    className: 'text-center'
                },
                {
                    data: 'stok_masuk',
                    name: 'stok_masuk',
                    className: 'text-center'
                },
                {
                    data: 'kondisi.nama_kondisi',
                    name: 'kondisi.nama_kondisi',
                    className: 'text-center'
                },
                {
                    data: 'ruang.nama_ruang',
                    name: 'ruang.nama_ruang'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                }
            ],
            columnDefs: [{
                targets: 0,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }],
            lengthMenu: [
                [10, 25, 50, 100, -1], // Nilai '-1' berarti "semua data"
                [10, 25, 50, 100, "All"] // Label yang akan ditampilkan di dropdown
            ],
            dom: 'Blfrtip', // Menambahkan elemen kontrol DataTables
            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                }
            ]
        });

        // Inisialisasi DataTable untuk tabel peminjaman
        var urldataPeminjaman = $('#tabeldataPeminjaman').data('url');
        var tablePeminjaman = $('#tabeldataPeminjaman').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: urldataPeminjaman,
                data: function(d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'barang_id',
                    name: 'barangMasuk.nama_barang'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah',
                    className: 'text-center'
                },
                {
                    data: 'nama_peminjam',
                    name: 'nama_peminjam',
                    className: 'text-center'
                },
                {
                    data: 'kelas',
                    name: 'kelas',
                    className: 'text-center'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'tanggal_pengembalian',
                    name: 'tanggal_kembali'
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        var badgeClass = '';
                        var badgeText = '';

                        if (data === 'dikembalikan') {
                            badgeClass = 'badge bg-success';
                            badgeText = 'dikembalikan';
                        } else if (data === 'ditolak') {
                            badgeClass = 'badge bg-danger';
                            badgeText = 'ditolak';
                        } else if (data === 'pending') {
                            badgeClass = 'badge bg-warning text-white';
                            badgeText = 'pending';

                        } else {
                            badgeClass = 'badge bg-primary text-white';
                            badgeText = 'dipinjam'; // default kalau masih dipinjam
                        }

                        return '<span class="' + badgeClass + '">' + badgeText + '</span>';
                    },
                    className: 'text-center'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    className: 'text-center',
                    searchable: false,
                     visible: (window.userRole === 'admin' || window.userRole === 'kaprodi')
                }
            ],
            columnDefs: [{
                targets: 0,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }],
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            dom: 'Blfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                }
            ]
        });

         // Inisialisasi DataTable untuk tabel permintaan
        var urldataPermintaan = $('#tabeldataPermintaan').data('url');
        var tablePermintaan = $('#tabeldataPermintaan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: urldataPermintaan,
                data: function(d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'barang_id',
                    name: 'barangMasuk.nama_barang'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah',
                    className: 'text-center'
                },
                {
                    data: 'nama_permintaan',
                    name: 'nama_peminjam',
                    className: 'text-center'
                },
                {
                    data: 'kelas',
                    name: 'kelas',
                    className: 'text-center'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        var badgeClass = '';
                        var badgeText = '';

                        if (data === 'disetujui') {
                            badgeClass = 'badge bg-success';
                            badgeText = 'disetujui';
                        } else if (data === 'ditolak') {
                            badgeClass = 'badge bg-danger';
                            badgeText = 'ditolak';
                        } else {
                            badgeClass = 'badge bg-warning text-white';
                            badgeText = 'pending';
                        }

                        return '<span class="' + badgeClass + '">' + badgeText + '</span>';
                    },
                    className: 'text-center'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    className: 'text-center',
                    searchable: false,
                     visible: (window.userRole === 'admin' || window.userRole === 'kaprodi')
                }
            ],
            columnDefs: [{
                targets: 0,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }],
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],

            dom: 'Blfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                }
            ]
        });

        // Inisialisasi DataTable untuk tabel laporan peminjaman
        var urlLaporanPeminjaman = $('#tabelLaporanPeminjaman').data('url');
        var tableLaporanPeminjaman = $('#tabelLaporanPeminjaman').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: urlLaporanPeminjaman,
                data: function(d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'barang_id',
                    name: 'barangMasuk.nama_barang'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah',
                    className: 'text-center'
                },
                {
                    data: 'nama_peminjam',
                    name: 'nama_peminjam',
                    className: 'text-center'
                },
                {
                    data: 'kelas',
                    name: 'kelas',
                    className: 'text-center'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'tanggal_pengembalian',
                    name: 'tanggal_kembali'
                },
                {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            var badgeClass = '';
                            var badgeText = '';

                            if (data === 'dikembalikan') {
                                badgeClass = 'badge bg-success';
                                badgeText = 'dikembalikan';
                            } else if (data === 'ditolak') {
                                badgeClass = 'badge bg-danger';
                                badgeText = 'ditolak';
                            } else if (data === 'pending') {
                                badgeClass = 'badge bg-warning text-white';
                                badgeText = 'pending';

                            } else {
                                badgeClass = 'badge bg-primary text-white';
                                badgeText = 'dipinjam'; // default kalau masih dipinjam
                            }

                            return '<span class="' + badgeClass + '">' + badgeText + '</span>';
                        },
                        className: 'text-center'
                    }
            ],
            columnDefs: [{
                targets: 0,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }],
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            dom: 'Blfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        // columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        // columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        // columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        // columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        // columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                }
            ]
        });

        // Inisialisasi DataTable untuk tabel laporan permintaan
        var urlLaporanPermintaan = $('#tabelLaporanPermintaan').data('url');
        var tableLaporanPermintaan = $('#tabelLaporanPermintaan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: urlLaporanPermintaan,
                data: function(d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'barang_id',
                    name: 'barangMasuk.nama_barang'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah',
                    className: 'text-center'
                },
                {
                    data: 'nama_permintaan',
                    name: 'nama_peminjam',
                    className: 'text-center'
                },
                {
                    data: 'kelas',
                    name: 'kelas',
                    className: 'text-center'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        var badgeClass = '';
                        var badgeText = '';

                        if (data === 'disetujui') {
                            badgeClass = 'badge bg-success';
                            badgeText = 'disetujui';
                        } else if (data === 'ditolak') {
                            badgeClass = 'badge bg-danger';
                            badgeText = 'ditolak';
                        } else {
                            badgeClass = 'badge bg-warning text-white';
                            badgeText = 'pending';
                        }

                        return '<span class="' + badgeClass + '">' + badgeText + '</span>';
                    },
                    className: 'text-center'
                }
            ],
            columnDefs: [{
                targets: 0,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }],
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            dom: 'Blfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        // columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        // columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        // columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        // columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        // columns: ':not(:last-child)',
                        modifier: {
                            page: 'all'
                        }
                    }
                }
            ]
        });





    // Tombol filter untuk tabel barangMasuk
    $('#filter').click(function() {
        tableBarangMasuk.ajax.reload(); // Memuat ulang tabel dengan data yang sudah difilter
    });

    // Tombol filter untuk tabel barangMasuk
        $('#filter').click(function() {
            tableBarangMasuk.ajax.reload(); // Memuat ulang tabel dengan data yang sudah difilter
        });

        // Tombol filter untuk tabel laporan barangMasuk
        $('#filterLaporanBarangMasuk').click(function() {
            tableLaporanBarangMasuk.ajax.reload(); // Memuat ulang tabel dengan data yang sudah difilter
        });

        // Tombol filter untuk tabel peminjaman
        $('#filter1').click(function() {
            tablePeminjaman.ajax.reload(); // Memuat ulang tabel dengan data yang sudah difilter
        });

        // Tombol filter untuk tabel permintaan
        $('#filterPermintaan').click(function() {
            tablePermintaan.ajax.reload(); // Memuat ulang tabel dengan data yang sudah difilter
        });

        // Tombol filter untuk tabel Laporan peminjaman
        $('#filterLaporanPeminjaman').click(function() {
            tableLaporanPeminjaman.ajax.reload(); // Memuat ulang tabel dengan data yang sudah difilter
        });

        // Tombol filter untuk tabel Laporan Permintaan
        $('#filterLaporanPermintaan').click(function() {
            tableLaporanPermintaan.ajax.reload(); // Memuat ulang tabel dengan data yang sudah difilter
        });

});
