<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product name</th>
            <th scope="col">quantity</th>
            <th scope="col">price</th>
        </tr>
    </thead>
    <tbody>
        @php
            $sum = 0;
            $i = 0;
        @endphp
        @foreach ($cartData as $order)
            <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>{{ $order->product->en_name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->product->price }}</td>
            </tr>
            @php
                $sum = $sum + $order->product->price * $order->quantity;
            @endphp
        @endforeach

    </tbody>
</table>

<div class="btn btn-success">
    <b>
        <div><strong>Total Price: {{ $sum }}</strong></div>
        <div> <strong>Shipping: 50</strong></div>
        <div><strong>Total: {{ $sum + 50 }}</strong></div>
    </b>
</div>
