<table>
    <tr>
        <th>STT</th>
        <th>
            Sản phẩm
        </th>
        <th>
            Số lượng
        </th>
        <th>
            Tên
        </th>
        <th>
            SĐT
        </th>
        <th>
            Email
        </th>
        <th>
            Địa chỉ
        </th>
    </tr>
    @foreach ($datas as $index => $dataItem)
        <tr>
            <td>
                {{$index + 1}}
            </td>
            <td>
                {{$dataItem->productDetail->title}}
            </td>
            <td>
                {{$dataItem->sl}}
            </td>
            <td>
                {{$dataItem->cart->name}}
            </td>
            <td>
                {{$dataItem->cart->phone}}
            </td>
            <td>
                {{$dataItem->cart->email}}
            </td>
            <td>
                {{$dataItem->cart->address}}
            </td>
        </tr>
    @endforeach
</table>