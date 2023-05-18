@foreach ($orders as $key => $order)
    <tr class="tr-shadow">
        <input type="hidden" id="orderId" value="{{ $order->id }}">
        <td class=" align-middle">{{ ++$key }}</td>
        <td>{{ $order->id }}</td>
        <td class="">{{ $order->user_name }}</td>
        <td class="">{{ $order->total_price }}</td>
        <td><a href="{{ route('orderDetail', $order->order_code) }}">{{ $order->order_code }}</a></td>
        <td>{{ $order->created_at->format('F-d-Y') }}</td>
        <td>
            <select onchange="changeOrderStatus(this, {{ $order->id }})">
                {{-- <select class="changeOrderStatus" > --}}
                <option value="pending" @if ($order->status == 'pending') selected @endif>
                    Pending</option>
                <option value="success" @if ($order->status == 'success') selected @endif>
                    Success</option>
                <option value="reject" @if ($order->status == 'reject') selected @endif>
                    Reject</option>
            </select>
        </td>
        {{-- <td>
            <div class="table-data-feature">
                <a href="{{ route('orderDetail', $order->order_code) }}">
                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                        <i class="zmdi zmdi-more"></i>
                    </button>
                </a>
            </div>
        </td> --}}
    </tr>
    <tr class="spacer"></tr>
@endforeach
<tr>
    <td style="background-color: #e5e5e5" class=" text-right"  colspan="8">
        {{ $orders->links() }}
     </td>
</tr>  

{{-- <div> {{ $orders->links() }}</div> --}}


