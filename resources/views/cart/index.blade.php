@extends('app')

@section('content')
<div class="container">
    <h2 class="text-center">Cart</h2>
    <div class="row shadow-sm mt-4">
        <div
         class="table-responsive"
        >
         <table
            class="table"
         >
            <thead>
               <tr>
                  <th>Product</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>SubTotal</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               @php
               $total = 0;
               // var_dump(session('cart'));
               // unset($_SESSION['cart'])
               // session()->forget('cart');
               @endphp
               
               @if(session('cart')) 
               @foreach (session('cart') as $id => $item)
               @php
                 $subTotal = $item['price'] * $item['qty'];
                 $total += $subTotal;  
               @endphp
               <tr rowId="{{ $id }}">
                  <td scope="row">{{ $item['name'] }}</td>
                  <td scope="row">
                     <form action="{{ route('update.sopping.cart') }}" method="post">
                     <div class="input-group input-group-sm mb-3">
                           @csrf
                           <input type="hidden" name="id" value="{{ $item['id']; }}">
                        <input type="number" name="qty" min="1" max="10" class="form-control quantity" placeholder="Quantity" value="{{ $item['qty'] }}">
                           <button type="submit" class="btn btn-outline-primary update-product-qty" data-id="{{ $id }}">Update</button>
                           
                        </div>
                     </form>
                  </td>
                  <td scope="row">{{ number_format($item['price'], 0, ",", ".") }}</td>
                  <td data-th="Subtotal" class="text-center">{{ number_format($subTotal, 0, ",", ".") }}</td>
                    <td class="actions">
                        <a href="#" data-id="{{$id}}" class="btn btn-outline-danger btn-sm delete-product">Delete</a>
                    </td>
               </tr>
               @endforeach
               @else
               <tr><td colspan="4" class="text-center"><small>not found</small></td></tr>
               @endif
               <tr>
                  <td colspan="3"><strong>Total</strong></td>
                  <td colspan="3"><strong>Rp. {{ number_format($total, 0, ",", ".")}}</strong></td>
               </tr>
            </tbody>
            <tfoot>
               <form action="{{ route('checkout.cart') }}" method="post">
               <tr>
                  <td>
                     <div class="mb-3">
                           @csrf
                           <input type="hidden" name="total" value="{{$total}}">
                           <label for="name" class="form-label">Fullname</label>
                           <input type="text" class="form-control" name="name" id="name" placeholder="fullname">
                           </div>
                           <div class="mb-3">
                           <label for="phone"  class="form-label">Phone</label>
                           <input type="number" name="phone" class="form-control" id="phone">
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="5" class="text-right">
                        <a href="{{ url('/products') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                        <button type="submit" class="btn btn-danger">Checkout</button>
                     </td>
                  </tr>
               </form>
            </tfoot>
         </table>
        </div>
        
    </div>
</div>

<script>
   // const buttonDelete = document.querySelector('.delete-product');
   $('.delete-product').click(function() {
      let token   = $("meta[name='csrf-token']").attr("content");
          
  
        var id = $(this).data('id');
         // console.log(id);
            $.ajax({
                url: `/delete-cart-product`,
                method: "DELETE",
                data: {
                    _token: token, 
                    id: id
                },
                success: function (response) {
                    window.location.reload();
                }
            });
   })

   // Update Quantity Cart
   // $('.update-product-qty').click(function() {
   //    let token   = $("meta[name='csrf-token']").attr("content");
   //        var qty = $('.quantity').val();
  
   //      var id = $(this).data('id');
   //       // console.log(id, qty);
   //          $.ajax({
   //              url: `{{ route('update.sopping.cart') }}`,
   //              method: "PUT",
   //              data: {
   //                  _token: '{{ csrf_token() }}', 
   //                  id: id,
   //                  qty: qty,
   //              },
   //              success: function (response) {
   //                console.log(response);
   //                //   window.location.reload();
   //              }
   //          });
   // })
</script>
@endsection