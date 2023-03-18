@extends('admin.base')

@section('content')


    <div class="panel">
        <div class="title">
            <p>Data User</p>
            <a class="btn-utama-soft sml rnd " id="addData">User Baru <i
                    class="material-icons menu-icon ms-2">add_circle</i></a>
        </div>

        <div class="isi">
            <div class="table">
                <table id="table_piutang" class="table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No_HP</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($user as $u)
                        <tr>
                            <td>{{$u->nama}}</td>
                            <td>{{$u->alamat}}</td>
                            <td>{{$u->no_hp}}</td>
                            <td>{{$u->username}}</td>
                            <td class="d-flex">
                                <a class="btn-success sml rnd me-1" id="editData" data-row="{{$u}}">Edit <i
                                        class="material-icons menu-icon ms-2">edit</i></a>
                                <a class="btn-danger sml rnd " data-id="{{$u->id}}" data-name="{{$u->nama}}" id="deleteData">Hapus <i
                                        class="material-icons menu-icon ms-2">delete</i></a>
                            </td>
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

    <!-- Modal -->
    <div class="modal fade" id="modaltambahuser" tabindex="-1" aria-labelledby="modaltambahuser" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaltambahuser">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form" onsubmit="return createData()">
                    @csrf
                    <input id="id" name="id" hidden class="textForm"/>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control textForm" id="nama" name="nama" placeholder="Jhony">
                            <label for="nama" class="form-label">Nama</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control textForm" id="alamat" name="alamat" placeholder="Jhony">
                            <label for="alamat" class="form-label">Alamat</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control textForm" id="no_hp" name="no_hp" placeholder="Jhony">
                            <label for="no_hp" class="form-label">No Hp</label>
                        </div>


                        <hr>
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select mb-3 textForm" aria-label="Default select example" id="role" name="role" required>
                            <option selected>Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="pimpinan">Pimpinan</option>
                            <option value="kasir">Kasir</option>
                        </select>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control textForm" id="username" name="username" placeholder="Jhony">
                            <label for="username" class="form-label">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control textForm " id="password" name="password" placeholder="Jhony">
                            <label for="password" class="form-label">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control textForm " id="password_confirmation"
                                   name="password_confirmation" placeholder="Jhony">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
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
@endsection

@section('morejs')
    <script src="{{ asset('js/number_formater.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#table_id').DataTable();
            $('#table_piutang').DataTable();
        });

        $(document).on('click', '#addData, #editData', function () {
            let row = $(this).data('row');
            $('.textForm').val('');
            if (row) {
                $.each(row, function (v, k) {
                    $('#' + v).val(row[v])
                })
                $('#password').val('*******');
                $('#password_confirmation').val('*******');
            }
            $('#modaltambahuser').modal('show');
        })

        function createData() {
            saveData('Simpan Data', 'form', window.location.pathname)
            return false;
        }

        function afterSave() {

        }

        $(document).on('click','#deleteData', function () {
            let id = $(this).data('id');
            let nama = $(this).data('name');
            let data = {
                '_token' : '{{csrf_token()}}'
            }
            deleteData(nama, window.location.pathname+'/user/destroy/'+id, data)
            return false;
        })
    </script>
@endsection

