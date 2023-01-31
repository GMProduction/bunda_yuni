@extends('admin.base')

@section('content')

    <div class="row">
        <div class="col-6">
            <div class="panel">
                <div class="title">
                    <p>Laporan Pembelian</p>

                    <div class="d-flex ">
                        <div class="form-floating  me-2">
                            <input type="date" class="form-control" id="tanggalawal" name="tanggalawal"
                                   placeholder="tanggalawal">
                            <label for="tanggalawal" class="form-label">Tanggal Awal</label>
                        </div>

                        <div class="form-floating  me-2">
                            <input type="date" class="form-control" id="tanggalakhir" name="tanggalakhir"
                                   placeholder="tanggalakhir">
                            <label for="tanggalakhir" class="form-label">Tanggal Akhir</label>
                        </div>
                        <a class="btn-utama me-2" id="btnTanggal">Tampil</a>
                        <a class="btn-accent" id="btnCetak" target="_blank">Cetak</a>
                    </div>
                    {{-- <a class="btn-utama-soft sml rnd " data-bs-toggle="modal" data-bs-target="#modaltambahnegara">Data
                        Negara Baru
                        <i class="material-icons menu-icon ms-2">add_circle</i></a> --}}
                </div>

                <div class="isi">
                    <div class="table">
                        <table id="table_pesanan" class="table table-striped enselect" style="width:100%">
                            <thead>
                            <tr>
                                <th>Nomor Transaksi</th>
                                <th>Tanggal & Jam</th>
                                <th>Total</th>
                                <th>Kasir</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $d)
                                <tr id="{{$d->id}}">
                                    <td>{{$d->no_transaksi}}</td>
                                    <td>{{date_format($d->created_at,'Y M d')}}</td>
                                    <td>{{number_format($d->total)}}</td>
                                    <td>{{$d->user->nama}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-6">
            <div class="panel">
                <div class="title">
                    <p>Barang yang dibeli ( <span id="noTrans"></span> )</p>
                    {{-- <a class="btn-utama-soft sml rnd " data-bs-toggle="modal" data-bs-target="#modaltambahnegara">Data
                        Negara Baru
                        <i class="material-icons menu-icon ms-2">add_circle</i></a> --}}
                </div>

                <div class="isi">
                    <div class="table">
                        <table id="table_keranjang" class="table table-striped enselect" style="width:100%">
                            <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Total</th>
                                {{--                                    <th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody id="tbCart">


                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script src="{{ asset('js/number_formater.js') }}"></script>


    <script>
        var tableTrans;
        $(document).ready(function () {
            $('#tanggalawal').val('{{request('start')}}');
            $('#tanggalakhir').val('{{request('end')}}');
            tableTrans = $('#table_pesanan').DataTable({
                select: {
                    style: 'single'
                }
            });

            // $('#table_keranjang').DataTable();
        });

        $('#table_pesanan tbody').on('click', 'tr', function () {
            let data = tableTrans.row(this).data();
            let row = data.DT_RowId;
            let total = data[2];
            $('#noTrans').html(data[0]);
            $.get(window.location.pathname + '/' + row, function (response) {
                let table = $('#tbCart');
                table.empty();
                $.each(response, function (k, v) {
                    table.append(' ' +
                        '<tr>\n' +
                        '     <td>' + parseInt(k + 1) + '</td>\n' +
                        '     <td>' + v.barangs.nama + ' ('+v.barangs.kategori+')</td>\n' +
                        '     <td class="text-center">' + v.qty + '</td>\n' +
                        '     <td style="text-align: right">' + (v.harga).toLocaleString() + '</td>\n' +
                        '     <td style="text-align: right">' + (v.total).toLocaleString() + '</td>\n' +
                        ' </tr>')
                })
                table.append(' ' +
                    '<tr>\n' +
                    '     <td colspan="4" class="text-center" style="font-weight: bold">Total Harga</td>\n' +
                    '     <td style="font-weight: bold; text-align: right">' + (total).toLocaleString() + '</td>\n' +
                    ' </tr>')
            })
        });

        $(document).on('click', '#btnTanggal', function () {
            let awal = $('#tanggalawal').val();
            let akhir = $('#tanggalakhir').val();
            let form = {
                awal,
                akhir
            }
            if (awal && akhir) {
                window.location = window.location.pathname + '?start=' + awal + '&end=' + akhir;
            }
        })

        $(document).on('click', '#btnCetak', function () {
            let awal = $('#tanggalawal').val();
            let akhir = $('#tanggalakhir').val();
            let form = {
                awal,
                akhir
            }
            let param = '';
            if (awal) {
                param = '?start=' + awal + '&end=' + akhir;
            }
            console.log(awal);
            console.log(akhir);
            if (awal && akhir) {
                $(this).attr('href', '/admin/cetak' + param).attr('target', '_black');
            } else if (awal === '' && akhir === '') {
                $(this).attr('href', '/admin/cetak' + param).attr('target', '_black');
            }

        })
    </script>
@endsection

