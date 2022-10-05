@extends('admin.base')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="title">
                    <p>Data Barang</p>

                </div>

                <div class="isi">
                    <div class="table">
                        <table id="table_barang" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama Pelanggan</th>
                                    <th>Alamat</th>
                                    <th>Status Pesanan</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nama Pelanggan</td>
                                    <td>Alamat</td>
                                    <td>Status Pesanan</td>
                                    <td>Total</td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn-utama sml rnd  " id="addData">Detail Pesanan</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>


        </div>
    </div>


    <!-- Modal TAMBAH BARANG-->
    <div class="modal fade" id="modaltambahbarang" tabindex="-1" aria-labelledby="modaltambahbarang" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titlemodaltambahbarang">Detail Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form" onsubmit="return createData()" enctype="multipart/form-data">
                    @csrf
                    <input id="id" name="id" class="textForm" hidden>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="panel">
                                    <div class="title">
                                        <p>Data Pesanan</p>

                                    </div>

                                    <div class="isi">
                                        <div class="table">
                                            <table id="table_barang" class="table table-striped" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Barang</th>
                                                        <th>Kategori</th>
                                                        <th>Foto</th>
                                                        <th>Harga</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="panel">
                                    <div class="title">
                                        <p>Data Pelanggan</p>

                                    </div>

                                    <div class="isi">
                                        <div class="table">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" readonly id="namapel"
                                                    name="namapel" placeholder="namapelanggan">
                                                <label for="namapel" class="form-label">Nama Pelanggan</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" readonly id="alamat"
                                                    name="alamat" placeholder="alamat">
                                                <label for="alamat" class="form-label">Alamat</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" readonly id="nohp"
                                                    name="nohp" placeholder="nohp">
                                                <label for="nohp" class="form-label">No Hp</label>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class=" m-3 ">
                        <div class="text-center">
                            <button type="submit" class="btn-utama ms-auto">Kirim Pesanan</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal TAMBAH STOCK-->
    <div class="modal fade" id="modaltambahstock" tabindex="-1" aria-labelledby="modaltambahstock" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titlemodaltambahstock">Tambah Stock (Nama Barang)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="qty" name="qty" placeholder="qty">
                        <label for="qty" class="form-label">Qty</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="tanggalmasuk" name="Tanggal Masuk"
                            placeholder="tanggalmasuk">
                        <label for="tanggalmasuk" class="form-label">Tanggal Masuk</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="tanggalexpired" name="Tanggal Masuk"
                            placeholder="tanggalexpired">
                        <label for="tanggalexpired" class="form-label">Tanggal Expired</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            placeholder="keterangan">
                        <label for="keterangan" class="form-label">Keterangan</label>
                    </div>


                </div>

                <div class=" m-3">

                    <div class="text-center">
                        <a class="btn-utama">Simpan</a>
                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script src="{{ asset('js/number_formater.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
            $('#table_barang').DataTable();
            $('#table_stock').DataTable();
            $('.datepicker').datepicker();
        });

        $(document).on('click', '#addData, #editData', function() {
            let row = $(this).data('row');
            console.log(row)
            $('.textForm').val('');
            if (row) {
                $.each(row, function(v, k) {
                    if (v != 'image') {
                        $('#' + v).val(row[v])
                    }
                })
            }
            $('#modaltambahbarang').modal('show');
        })

        function createData() {
            saveData('Simpan Data', 'form', window.location.pathname)
            return false;
        }
    </script>
@endsection
