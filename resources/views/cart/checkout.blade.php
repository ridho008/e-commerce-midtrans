@extends('app')

@section('content')
<div class="container">
    <h2 class="text-center">Detail Order</h2>
    <div class="row shadow-sm mt-4">
        <button id="pay-button" class="btn btn-success btn-lg">Pay Now!</button>
    </div>
</div>

<script type="text/javascript">
   // For example trigger on button clicked, or any time you need
   var payButton = document.getElementById('pay-button');
   payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay(`{{ $snapToken }}`, {
         onSuccess: function(result){
         /* You may add your own implementation here */
         alert("payment success!"); console.log(result);
         },
         onPending: function(result){
         /* You may add your own implementation here */
         alert("wating your payment!"); console.log(result);
         },
         onError: function(result){
         /* You may add your own implementation here */
         alert("payment failed!"); console.log(result);
         },
         onClose: function(){
         /* You may add your own implementation here */
         alert('you closed the popup without finishing the payment');
         }
      })
   });
   </script>

@endsection