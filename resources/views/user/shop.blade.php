 @include('user.header')
 <div class="breadcrumb-section breadcrumb-bg">
     <div class="container">
         <div class="row">
             <div class="col-lg-8 offset-lg-2 text-center">
                 <div class="breadcrumb-text">
                     <p>Fresh and Organic</p>
                     <h1>Shop</h1>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="product-section mt-150 mb-150">
     <div class="container">

         <div class="row">
             <div class="col-md-12">
                 <div class="product-filters">
                     <ul>
                         <li class="active" data-filter="*">All</li>
                         @foreach ($jenis as $jns)
                             <li data-filter=".{{ $jns->jenis }}">{{ $jns->jenis }}</li>
                         @endforeach
                     </ul>
                 </div>
             </div>
         </div>

         <div class="row product-lists">
             @foreach ($data as $dt)
                 <div class="col-lg-4 col-md-6 text-center {{ $dt->GetJenis->jenis }}">
                     <div class="single-product-item">
                         <div class="product-image">
                             <a href="single-product.html"><img src="{{ asset('user/img/' . $dt->gambar) }}"
                                     alt=""></a>
                         </div>
                         <h3>{{ $dt->nama }}</h3>
                         <p class="product-price"><span>1 pcs</span>Rp. {{ number_format($dt->harga, 2, ',', '.') }}
                         </p>
                         <a onclick="OpenModal('{{ $dt }}')" class="cart-btn"><i
                                 class="fas fa-shopping-cart"></i> Add to Car</a>
                     </div>
                 </div>
             @endforeach

         </div>

         <div class="row">
             <div class="col-lg-12 text-center">
                 <div class="pagination-wrap">
                     <ul>
                         <li><a href="#">Prev</a></li>
                         <li><a href="#">1</a></li>
                         <li><a class="active" href="#">2</a></li>
                         <li><a href="#">3</a></li>
                         <li><a href="#">Next</a></li>
                     </ul>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <script type="text/javascript">
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });

     function OpenModal(data) {
         data = data.replace("\n", "\\n");
         let dt = JSON.parse(data)
         //  let dt = JSON.parse(data)

         $('#nama_menu').val(dt.nama)
         $('#id_keranjang').val(dt.id)
         $('#CartModal').appendTo("body").modal('show');

     }

     function AddCart(id) {

         $.ajax({
             type: "POST",
             url: "{{ route('cart.add') }}",
             data: {
                 id: id
             },
             dataType: 'json',
             success: function(res) {
                 console.log(res);
             }
         });
     }
 </script>
 <div class="modal fade" id="CartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="/#" id="save_cart" method="post" enctype="multipart/form-data">
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
                             <input type="number" class="form-control w-100" name="jumlah">

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
 <script>
     document.getElementById("save_cart").addEventListener('submit', function(e) {
         e.preventDefault();
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         $.ajax({
             type: "POST",
             url: "{{ route('cart.add') }}",
             data: $('#save_cart').serialize(),
             dataType: 'json',
             success: function(res) {
                 console.log(res);
             }
         });
     });
 </script>
 @include('user.footer')
