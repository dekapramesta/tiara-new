@include('admin.header')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row ">
            {{-- <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">New Booking</h5>
                                        <h2 class="mb-3 font-18">258</h2>
                                        <p class="mb-0"><span class="col-green">10%</span> Increase</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="{{ asset('admin/img/banner/1.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15"> Customers</h5>
                                        <h2 class="mb-3 font-18">1,287</h2>
                                        <p class="mb-0"><span class="col-orange">09%</span> Decrease</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="admin/img/banner/2.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">New Project</h5>
                                        <h2 class="mb-3 font-18">128</h2>
                                        <p class="mb-0"><span class="col-green">18%</span>
                                            Increase</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="admin/img/banner/3.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Revenue</h5>
                                        <h2 class="mb-3 font-18">$48,697</h2>
                                        <p class="mb-0"><span class="col-green">42%</span> Increase</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="admin/img/banner/4.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col">
                            <div class="row ">
                                <div class="col">
                                    <h4>Menu</h4>
                                </div>
                                <div class="col text-right">
                                    <button type="button" data-toggle="modal" data-target="#exampleModal"
                                        class="btn btn-primary">Tambah Menu</button>

                                </div>

                            </div>
                            <div class="col mt-2">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $err)
                                        <p class="alert alert-danger">{{ $err }}</p>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>Harga</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data as $dt)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $dt->nama }}</td>
                                            <td>{{ $dt->GetJenis->jenis }}</td>
                                            <td>{{ $dt->harga }}</td>
                                            <td><img src="{{ asset('image/' . $dt->gambar) }}" class="img-thumbnail"
                                                    alt="" style="height: 150px; width:150px"></td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown"
                                                        class="btn btn-primary dropdown-toggle">Pilihan</a>
                                                    <div class="dropdown-menu">
                                                        <a onclick="EditMenu('{{ $dt }}')"
                                                            class="dropdown-item has-icon"><i class="far fa-edit"></i>
                                                            Edit</a>
                                                        <form id="form_delete{{ $dt->id }}"
                                                            action="{{ route('menu.delete', $dt->id) }}" method="POST"
                                                            style="display: inline-flex">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="javascript:{}"
                                                                onclick="document.getElementById('form_delete{{ $dt->id }}').submit();"
                                                                class="dropdown-item has-icon"><i
                                                                    class="fas fa-user-shield"></i> Delete</a>
                                                        </form>


                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.footer')
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModal">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="" action="{{ route('menu.tambah') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Nama</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Nama" name="nama">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Jenis" name="jenis">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Harga" name="harga">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Gambar</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" name="gambar" placeholder="Gambar">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <div class="input-group">
                                    <textarea name="deskripsi" class="form-control" id=""></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="formModal"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModal">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="" action="{{ route('menu.edit') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Nama</label>
                                <div class="input-group">
                                    <input type="text" id="edit_nama" class="form-control" placeholder="Nama"
                                        name="nama">
                                    <input hidden type="text" id="edit_id" name="id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis</label>
                                <div class="input-group">
                                    <input type="text" id="edit_jenis" class="form-control" placeholder="Jenis"
                                        name="jenis">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <div class="input-group">
                                    <input type="text" id="edit_harga" class="form-control" placeholder="Harga"
                                        name="harga">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Gambar</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" name="gambar" placeholder="Gambar">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <div class="input-group">
                                    <textarea name="deskripsi" class="form-control" id="edit_desk"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function EditMenu(data) {
                let dt = JSON.parse(data)
                $('#edit_id').val(dt.id)
                $('#edit_nama').val(dt.nama)
                $('#edit_nama').val(dt.nama)
                $('#edit_harga').val(dt.harga)
                $('#edit_jenis').val(dt.jenis)
                $('#edit_desk').html(dt.deskripsi)
                $('#ModalEdit').appendTo("body").modal('show');

            }
        </script>
