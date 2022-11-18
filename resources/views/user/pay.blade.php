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
<div class="cart-section mt-100 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        <h3>Masukan Kode Invoice</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" id="kode_invoice" class="form-control">
                        </div>
                        <div class="form-group" id="pay_place">
                            <button onclick="cariInvoice()" class="btn btn-success w-100">Cari</button>
                        </div>

                    </div>
                </div>

            </div>


        </div>
    </div>
</div>

<script type="text/javascript">
    // For example trigger on button clicked, or any time you need


    function cariInvoice() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{ route('bayar.kode') }}",
            data: {
                kode: $('#kode_invoice').val()
            },
            dataType: 'json',
            success: function(res) {

                window.snap.pay(res.snapToken, {
                    onSuccess: function(result) {
                        /* You may add your own implementation here */
                        alert("payment success!");
                        result.id_pay = res.id_pesanan;
                        console.log(result);
                        $.ajax({
                            type: "POST",
                            url: "{{ route('bayar.midtrans') }}",
                            data: result,
                            dataType: 'json',
                            success: function(pay) {
                                console.log(pay);
                            }
                        });
                        // console.log(result);
                    },
                    onPending: function(result) {
                        /* You may add your own implementation here */
                        alert("wating your payment!");
                        result.id_pay = res.id_pesanan;
                        console.log(result);
                        $.ajax({
                            type: "POST",
                            url: "{{ route('bayar.midtrans') }}",
                            data: result,
                            dataType: 'json',
                            success: function(pay) {
                                console.log(pay);
                            }
                        });

                    },
                    onError: function(result) {
                        /* You may add your own implementation here */
                        alert("payment failed!");
                        console.log(result);
                    },
                    onClose: function() {
                        /* You may add your own implementation here */
                        alert('you closed the popup without finishing the payment');
                    }
                })
            },
            error: function(xhr, ajaxOptions, thrownError) {
                if (xhr.status == 404) {
                    alert("error", "Tidak DItemukan");
                }
            }
        });
    }
</script>

@include('user.footer')
