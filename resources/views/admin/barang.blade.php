@extends('admin.base')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="title">
                    <p>Data Barang</p>
                    <a class="btn-utama-soft  rnd " id="addData">Tambah
                        Barang
                        <i class="material-icons menu-icon ms-2">add_circle</i></a>
                </div>

                <div class="isi">
                    <div class="table">
                        <table id="table_barang" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Foto</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $d)
                                <tr>
                                    <td>{{$d->nama}}</td>
                                    <td>{{$d->kategori}}</td>
                                    <td>{{$d->description}}</td>
                                    <td><img class="" src="{{ asset($d->image) }}"/></td>
                                    <td>{{number_format($d->harga,'0')}}</td>
                                    <td class="">
                                        <div class="d-flex">
                                            <a class="btn-success sml rnd me-1" data-row="{{$d}}" id="editData">Edit <i
                                                    class="material-icons menu-icon ms-2">edit</i></a>
                                            <a class="btn-danger sml rnd ">Hapus<i
                                                    class="material-icons menu-icon ms-2">delete</i></a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse


                            </tbody>

                        </table>
                    </div>
                </div>

            </div>


        </div>
    </div>


    <!-- Modal TAMBAH BARANG-->
    <div class="modal fade" id="modaltambahbarang" tabindex="-1" aria-labelledby="modaltambahbarang"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titlemodaltambahbarang">Tambah Master Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form" onsubmit="return createData()" enctype="multipart/form-data">
                    @csrf
                    <input id="id" name="id" class="textForm" hidden>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control textForm" id="nama" name="nama"
                                   placeholder="namabarang">
                            <label for="namabarang" class="form-label">Nama Barang</label>
                        </div>
                        <label for="role" class="form-label">Kategori</label>
                        <select class="form-select mb-3 textForm" aria-label="Default select example" id="kategori" name="kategori" required>
                            <option value="" selected>Pilih Kategori</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Snack">Snack</option>
                        </select>
                        <div class="form-floating mb-3">
                            <textarea type="text" class="form-control textForm" id="description" name="description"
                                      placeholder="Deskripsi Barang"></textarea>
                            <label for="namabarang" class="form-label">Deskripsi Barang</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control textForm" id="harga" name="harga"
                                   placeholder="harga">
                            <label for="harga" class="form-label">Harga</label>
                        </div>

                        <div class="mb-3">
                            <label for="fotobarang" class="form-label" >Foto Barang</label>
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                    </div>
                    <div class=" m-3">
                        <div class="text-center">
                            <button type="submit" class="btn-utama">Simpan</button>
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
                        <input type="date" class="form-control" id="tanggalmasuk" name="Tanggal Masuk" placeholder="tanggalmasuk">
                        <label for="tanggalmasuk" class="form-label">Tanggal Masuk</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="tanggalexpired" name="Tanggal Masuk" placeholder="tanggalexpired">
                        <label for="tanggalexpired" class="form-label">Tanggal Expired</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="keterangan">
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
        $(document).ready(function () {
            $('#table_id').DataTable();
            $('#table_barang').DataTable();
            $('#table_stock').DataTable();
            $('.datepicker').datepicker();
        });

        $(document).on('click', '#addData, #editData', function () {
            let row = $(this).data('row');
            console.log(row)
            $('.textForm').val('');
            if (row) {
                $.each(row, function (v, k) {
                    if (v != 'image'){
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


