@include('user.header')
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Fresh and Organic</p>
                    <h1>Cart</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->

<!-- cart -->
<div class="cart-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="cart-table-wrap">
                    <table class="cart-table">
                        <thead class="cart-table-head">
                            <tr class="table-head-row">
                                <th class="product-image">Product Image</th>
                                <th class="product-name">Name</th>
                                <th class="product-price">Jumlah</th>
                                <th class="product-quantity">Harga</th>
                                <th class="product-total">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = null;
                            @endphp
                            @foreach ($cart as $item)
                                @php
                                    $harga = $item['harga'] * $item['jumlah'];
                                    $total += $harga;
                                @endphp
                                <tr class="table-body-row">
                                    </td>
                                    <td class="product-image"><img src="{{ asset('user/img/' . $item['gambar']) }}"
                                            alt=""></td>
                                    <td class="product-name">{{ $item['nama'] }}</td>
                                    <td class="product-quantity">{{ $item['jumlah'] }}</td>
                                    <td class="product-price"> Rp.
                                        {{ number_format($harga, 2, ',', '.') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-expanded="false">
                                                Pilihan </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    onclick="EditCart('{{ collect($item) }}')">Edit</a>
                                                <a onclick="DeleteProduct('{{ collect($item) }}')"
                                                    class="dropdown-item">Hapus</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>

            </div>

            <div class="col-lg-4">
                <div class="total-section">
                    <table class="total-table">
                        <thead class="total-table-head">
                            <tr class="table-total-row">
                                <th>Total</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>


                            <tr class="total-data">
                                <td><strong>Total: </strong></td>
                                <td>Rp .{{ number_format($total, 2, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>


            </div>
            <div class="col-lg-12 col-md-12 d-flex mt-3">
                <form class="w-100" id="submitbuy" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                        <input name="nama" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input name="alamat" type="text" class="form-control" id="alamat" required>
                    </div>
                    <div class="mb-3">
                        <label for="nowa" class="form-label">No WA</label>
                        <input name="no_wa" type="text" class="form-control" id="nowa" required>
                        <input name="pesanan" hidden type="text" value="{{ json_encode($cart) }}">
                    </div>
                    <div class="form-group">
                        <label for="id_start_datetime">Tanggal Dan Jam Diambil</label>
                        <div class="input-group date" id="id_1">
                            <input type="text" value="05/16/2018 11:31:00" class="form-control"
                                name="pesanan_diambil" required />
                            <div class="input-group-addon input-group-append">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    document.getElementById('submitbuy').addEventListener('submit', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{ route('buying') }}",
            data: $('#submitbuy').serialize(),
            dataType: 'json',
            success: function(res) {

            }
        });
        $(document).ajaxStop(function() {
            window.location.reload();
        });
    });
    $(function() {
        $('#datetimepicker1').datetimepicker();
    });
</script>
<script>
    function EditCart(data) {
        data = data.replace("\n", "\\n");
        let dt = JSON.parse(data);
        $('#id_keranjang').val(dt.id)
        $('#jumlah_edit').val(dt.jumlah)
        $('#nama_menu').val(dt.nama)

        $('#CartUpdateModal').appendTo("body").modal('show');


    }

    function DeleteProduct(data) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        data = data.replace("\n", "\\n");
        let dt = JSON.parse(data);
        $.ajax({
            type: "POST",
            url: "{{ route('cart.delete') }}",
            data: {
                id: dt.id
            },
            dataType: 'json',
            success: function(res) {
                console.log(res);
            }
        });
    }
</script>
<div class="modal fade" id="CartUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('cart.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Menu</label>
                        <div class="input-group">
                            <input hidden type="text" id="id_keranjang" name="id">
                            <input disabled type="text" class="form-control w-100" id="nama_menu" name="nama">

                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <div class="input-group">
                            <input type="number" id="jumlah_edit" class="form-control w-100" name="quantity">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="" class="btn btn-primary">Simpan Di Keranjang</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('user.footer')
