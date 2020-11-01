<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Karyawan - Laravel</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <br>
            <!--button untuk modal tambah-->
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ModalTambah">Tambah Data</a>
            <br>
            <br>
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karyawans as $kry)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$kry->NIK}}</td>
                        <td>{{$kry->Nama}}</td>
                        <td>{{$kry->Jabatan}}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm edit" id="{{$kry->id}}">Ubah</a>
                            <a href="#" class="btn btn-danger btn-sm delete" id="{{$kry->id}}">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div> 
    
    <!-- Modal Tambah-->
    <div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="form-Tambah" method="POST">
                @csrf
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!--Modal Edit-->
    <button id="openEditModal" data-toggle="modal" data-target="#ModalEdit"></button>
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="form-Edit" method="POST">
                <!--@method('PUT')-->
                @csrf
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_edit" name="id">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" id="nik_edit" name="nik">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="nama_edit" name="nama">
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" id="jabatan_edit" name="jabatan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>


    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $('#form-Tambah').submit(function(e){
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url:"{{route('karyawans.store')}}",
                method: "POST",
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(result){
                    if(result=="sukses"){
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Ditambahkan',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href="{{route('karyawans.index')}}";
                            }
                        })
                    }
                }
            });
        });

        $(document).on('click', '.edit', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                url: "{{ url('karyawans') }}/"+id,
                method: "GET",
                dataType: "JSON",
                success:function(data){
                    if(data != ""){
                        $('#openEditModal').click();
                        $("#id_edit").val(data.id);
                        $("#nik_edit").val(data.NIK);
                        $("#nama_edit").val(data.Nama);
                        $("#jabatan_edit").val(data.Jabatan);
                    }
                }
            });
        });

        $('#form-Edit').submit(function(e){
            e.preventDefault();
            var request = new FormData(this);
            var id = $('#id_edit').val();
            $.ajax({
                url: "{{ url('karyawans/ubah') }}/"+id,
                method: "POST",
                data: request,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    if(data == "sukses"){
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Diubah',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href="{{route('karyawans.index')}}";
                            }
                        })
                    }
                }
            });
        });

        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
            Swal.fire({
                title: 'Hapus?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('karyawans/hapus') }}/"+id,
                        method: "GET",
                        success:function(data){
                            if(data == "sukses"){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data Terhapus',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href="{{route('karyawans.index')}}";
                                    }
                                })
                            }
                        }
                    })
                }
            })
           
        });

    </script>
</body>
</html>