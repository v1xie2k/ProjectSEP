@extends('layouts.layout')
@section('content')
<form action="{{url('home/cart/callback')}}" method="post" style="width: 90%;" id="formCallBack">
    @csrf
    <input type="hidden" name="midtrans-callback" id="midtrans-callback">
    <input type="hidden" name="idHtrans" id="idHtrans" value="{{$htrans->id}}">
</form>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-3pvddp1GPtAATWkY"></script>
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('buttonco');
    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
    window.onload = function(){
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{$snapToken}}', {
        onSuccess: function(result){
            $('#midtrans-callback').val(JSON.stringify(result));
            $('#formCallBack').trigger('submit');

        },
        onPending: function(result){
            submitMidtransCallback(result);
        },
        onError: function(result){
            submitMidtransCallback(result);
        },
        onClose: function(){
            //ini dipikirkan lagi
            alert('you closed the popup without finishing the payment');
        }
        })
    };
    function submitMidtransCallback(result){
        document.getElementById('midtrans-callback').value = JSON.stringify(result);
        $('#formCallback').submit();
    }
</script>
@endsection
