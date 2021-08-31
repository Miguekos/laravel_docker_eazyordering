<table>
    <thead>
    <tr>
        <td>Order: {{ $order->id }}</td>
    </tr>
    <tr>
        <td>Manager: {{ $order->manager->name }}</td>
    </tr>
    <tr>
        <td>Date: {{ $order->date }}</td>
    </tr>
    <tr>
        <td>Total Order: {{ $order->total }}</td>
    </tr>
    <tr>
    </tr>
    <tr>
        <th>Code</th>
        <th>Description En</th>
        <th>Description Es</th>
        <th>Description It</th>
        <th>Category</th>
        <th>Family</th>
        <th>Unit Weight</th>
        <th>Unit of Measurement</th>
        <th>Pack Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->products as $product)
        <tr>
            <td>{{ $product->code }}</td>
            <td>{{ $product->description_en }}</td>
            <td>{{ $product->description_es }}</td>
            <td>{{ $product->description_it }}</td>
            <td>{{ $product->category }}</td>
            <td>{{ $product->family }}</td>
            <td>{{ $product->unit_weight }}</td>
            <td>{{ $product->uom }}</td>
            <td>{{ $product->pack_description }}</td>
            <td>{{ $product->total_price }}</td>
            <td>{{ $product->pivot->quantity }}</td>
            <td>{{ $product->total_price*$product->pivot->quantity }}</td>
        </tr>
    @endforeach
    </tbody>
</table>