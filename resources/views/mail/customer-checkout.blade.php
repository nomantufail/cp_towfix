
<div style="width: 100%; text-align: center">

    <strong>Dear customer, your order has been received to Towfix admin. Here are the products you ordered. Order No#  {{$data['order']->id}}</strong>

    <?php $total = 0;
    foreach(json_decode($data['order']->document) as $item)
        $total +=  $item->product->price * $item->quantity;
    ?>
    <table width="100%" border="1" cellspacing="0" cellpadding="10" style="margin: 50px 0;">
        <thead>
        <tr align="left">
            <th width="55%">Product</th>
            <th width="15%">Price</th>
            <th width="15%">Quantity</th>
            <th width="16%">Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach(json_decode($data['order']->document) as $item)
        <tr align="left">
            <th>{{$item->product->name}}</th>
            <th>{{$item->product->price}}</th>
            <th>{{$item->quantity}}</th>
            <th>{{$item->product->price * $item->quantity}}</th>
        </tr>
        @endforeach
        </tbody>
    </table>
    <h1>Total Amount {{$total}}</h1>
    <p>Your order will be shipped in 2-4 working days.
    Click here to view your orders (Orders link.
    If you want any assistance regarding our services, franchise or anything feel free to contact us </p> <a href="http://towfix.com.au/?page_id=63">Contact Us</a>
    <P>Regards ?
        Team TowFix.</P>


    <span style="display: block; margin-bottom: 20px; color: #d82121;">Franchises Now Available</span>
    <img src="http://towfix.com.au/wp-content/uploads/2016/09/logo.jpg" alt="">
</div>


