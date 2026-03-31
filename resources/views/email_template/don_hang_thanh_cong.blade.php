<!DOCTYPE html>
<html>
<head>
    <style>
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: center; }
        th { background-color: #f2f2f2; color: #800080; }
        .title { color: #0066cc; font-weight: bold; text-align: center; }
    </style>
</head>
<body>
    <p class="title">THÔNG TIN ĐƠN HÀNG</p>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sách</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($data as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row->tieu_de }}</td>
                    <td>{{ $row->so_luong }}</td>
                    <td>{{ number_format($row->don_gia, 0, ',', '.') }}đ</td>
                </tr>
                @php $total += $row->so_luong * $row->don_gia; @endphp
            @endforeach
            <tr>
                <td colspan="3"><strong>Tổng cộng</strong></td>
                <td><strong>{{ number_format($total, 0, ',', '.') }}đ</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>