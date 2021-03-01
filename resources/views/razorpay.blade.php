<!-- <button id="rzp-button1">Pay</button> -->
<!-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script> -->
<!-- <script> -->
var options = {
    "key": "{{ env('RAZOR_KEY') }}",
    "amount": "{{$pay['amount']}}",
    "currency": "{{$pay['currency']}}",
    "name": "{{$pay['ordername']}}",
    "description": "{{$pay['description']}}",
    "image": "{{ env('RAZOR_IMAGE') }}",
    "order_id": "{{$pay['order_id']}}",
    "callback_url": "{{route('razorpaysuccess')}}",
    "prefill": {
        "name": "{{$pay['username']}}",
        "email": "{{$pay['useremail']}}",
    },
    "notes": {
        "address": "{{$pay['address']}}"
    },
    "theme": {
        "color": "{{ env('RAZOR_THEME') }}"
    }
};
var rzp1 = new Razorpay(options);

 document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
 }
<!-- </script>