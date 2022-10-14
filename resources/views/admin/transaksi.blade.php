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
                                <th>Tanggal Pengiriman</th>
                                <th>Nama Pelanggan</th>
                                <th>Alamat</th>
                                <th>Status Pesanan</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="tbTrans">

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
                    <h5 class="modal-title" id="titlemodaltambahbarang">Detail Pesanan (Tanggal Pengiriman : <span id="tanggalKirim"></span>)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form" onsubmit="return createData()" enctype="multipart/form-data">
                    @csrf
                    <input id="id" name="id" class="textForm" hidden>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="panel">
                                    <div class="title" style="display: flex; justify-content: space-between">
                                        <p>Data Pesanan</p>
                                        <h4>Rp. <span id="totalharga"></span></h4>
                                    </div>
                                    <div class="isi">
                                        <div class="table">
                                            <table id="table_barang" class="table table-striped" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>Nama Barang</th>
                                                    <th>Kategori</th>
                                                    <th>Qty</th>
                                                    <th>Harga</th>
                                                    <th>Sub Total</th>
                                                </tr>
                                                </thead>
                                                <tbody id="tbCart">

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
                                        <div class="table" id="formPel">
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
                        <div class="" id="buttonStatus" style="display: flex; justify-content: end">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection

@section('morejs')

    <script>
        $(document).ready(function () {
            $('#table_id').DataTable();
            $('#table_barang').DataTable();
            $('#table_stock').DataTable();
            $('.datepicker').datepicker();
            getData()
        });

        $(document).on('click', '#addData, #editData', function () {
            let id = $(this).data('id');
            detailTrans(id)
            $('#modaltambahbarang').modal('show');
        })

        function createData() {
            saveData('Simpan Data', 'form', window.location.pathname)
            return false;
        }

        function getData() {
            let tabel = $('#tbTrans');
            tabel.empty();
            $.get('/admin/transaksi-all', function (val, status, er) {
                console.log(val)
                $.each(val, function (k,v) {
                    let status = v.status;
                    let textStatus = 'Menunggu'
                    if (status == 1){
                        textStatus = 'Pesanan Diterima'
                    }else if (status == 2){
                        textStatus = 'Pesanan Dikirim'
                    }else if(status == 3){
                        textStatus = 'Selesai'
                    }else if (status == 6){
                        textStatus = 'Pesanan Ditolak'
                    }
                    tabel.append('<tr>' +
                        '           <td>'+moment(v.tanggal_pengiriman).format('LLLL')+'</td>' +
                        '           <td>'+v.user.nama+'</td>' +
                        '           <td>'+v.user.alamat+'</td>' +
                        '           <td>'+textStatus+'</td>' +
                        '           <td>Rp. '+v.total.toLocaleString()+'</td>' +
                        '           <td><a class="btn-utama sml rnd  " data-id="'+v.id+'" id="addData">Detail Pesanan</a></td>' +
                        '          </tr>')
                })
            })
        }

        function detailTrans(id) {
            let tabel = $('#tbCart');
            tabel.empty();
            $('#formPel input').val('');
            $.get(window.location.pathname + '/' + id, function (val, status, er) {
                if (er.status == 200) {
                    console.log(val)

                    $('#namapel').val(val.user.nama);
                    $('#alamat').val(val.user.alamat);
                    $('#nohp').val(val.user.no_hp);
                    $('#tanggalKirim').html(moment(val.tanggal_pengiriman).format('LLLL'));
                    $('#totalharga').html(val.total.toLocaleString());
                    let btnHtlm = '<div style="display: flex">' +
                        '<a  data-id="'+val.id+'" data-status="6"  class="btn-danger me-2 " id="btnStatus">Tolak</a>' +
                        '<a  data-id="'+val.id+'" data-status="1"  class="btn-utama " id="btnStatus">Terima</a>' +
                        '</div>'
                    if(val.status == 1){
                        btnHtlm = '<button type="button" data-id="'+val.id+'" data-status="2"  class="btn-success ms-auto" id="btnStatus">Kirim</button>\n'
                    }else if (val.status == 2){
                        btnHtlm = '<h4>Pesanan Dikirim</h4>'
                    }else if (val.status == 3){
                        btnHtlm = '<h4>Selesai</h4>'
                    }else if(val.status == 6){
                        btnHtlm = '<h4>Pesanan Ditolak</h4>'
                    }
                    $('#buttonStatus').html(btnHtlm)
                    $.each(val.cart, function (k, v) {
                        tabel.append('<tr>' +
                            '           <td>'+v.barangs.nama+'</td>' +
                            '           <td>'+v.barangs.kategori+'</td>' +
                            '           <td>'+v.qty+'</td>' +
                            '           <td>'+v.harga.toLocaleString()+'</td>' +
                            '           <td>'+v.total.toLocaleString()+'</td>' +
                            '          </tr>')
                    })
                }
            })
        }

        $(document).on('click', '#btnStatus', function () {
            console.log()
            let id = $(this).data('id');
            let status = $(this).data('status');
            let data = {
                _token: '{{csrf_token()}}',
                status: status
            }
            $.post(window.location.pathname+'/'+id+'/change-status', data, function (val,status,er) {
                console.log(val);
                console.log(status);
                console.log(er);
                if (er.status == 200){
                    detailTrans(id)
                    getData()
                }
            })
        })
    </script>
@endsection
