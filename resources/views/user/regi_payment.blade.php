<html>
<body onload="document.frm1.submit()">
   <form action="{{ route('user.registration-pay', $order->id) }}" name="frm1" method="POST">
    @csrf
   </form>
</body>
</html>