@include('admin.header')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row ">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col">
                            <div class="row ">
                                <div class="col">
                                    <h4>About</h4>
                                </div>
                                <div class="col text-right">
                                    <button type="button" data-toggle="modal" data-target="#kelebihanModal"
                                        class="btn btn-primary">Tambah Kelebihan</button>

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
                                        <th>Kelebihan</th>
                                        <th>Deskripsi</th>

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
                                            <td>{{ $dt->title_kelebihan }}</td>
                                            <td>{{ $dt->desk_kelebihan }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown"
                                                        class="btn btn-primary dropdown-toggle">Pilihan</a>
                                                    <div class="dropdown-menu">
                                                        <a onclick="EditAbout('{{ $dt }}')"
                                                            class="dropdown-item has-icon"><i class="far fa-edit"></i>
                                                            Edit</a>
                                                        <form id="form_deleteabout{{ $dt->id }}"
                                                            action="{{ route('about.delete', $dt->id) }}" method="POST"
                                                            style="display: inline-flex">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="javascript:void()"
                                                                onclick="document.getElementById('form_deleteabout{{ $dt->id }}').submit();"
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
        <div class="modal fade" id="kelebihanModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
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
                        <form class="" action="{{ route('about.tambah') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Kelebihan</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Kelebiihan"
                                        name="title_kelebihan">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <div class="input-group">
                                    <textarea name="desk_kelebihan" id=""class="form-control"></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ModalEditAbout" tabindex="-1" role="dialog" aria-labelledby="formModal"
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
                        <form class="" action="{{ route('about.edit') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Kelebihan</label>
                                <div class="input-group">
                                    <input type="text" id="editabout_title" class="form-control" placeholder="Nama"
                                        name="title_kelebihan">
                                    <input hidden type="text" id="editabout_id" name="id">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <div class="input-group">
                                    <textarea name="desk_kelebihan" class="form-control" id="editabout_desk"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function EditAbout(data) {
                let dt = JSON.parse(data)
                $('#editabout_id').val(dt.id)
                $('#editabout_title').val(dt.title_kelebihan)
                $('#editabout_desk').val(dt.desk_kelebihan)
                $('#ModalEditAbout').appendTo("body").modal('show');

            }
        </script>
