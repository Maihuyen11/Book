<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action Movies</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial;
        }
        tr {
            display: grid;
            grid-template-columns: 2fr 1.5fr 4fr 1.5fr;
            border-bottom: 1px solid #ececec;
        }
        th, td {
            border: 1px solid #ececec;
            padding: 15px;
            text-align: center;
        }
        th {
            background-color: #2c3e50; 
            color: white; 
            text-align: center;
        }
        img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>

    <h2>Thể loại: Action</h2>

    <table>
        <thead>
            <tr>
                <th>Tên phim</th>
                <th>Ngày phát hành</th>
                <th>Mô tả</th>
                <th>Ảnh đại diện</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->movie_name }}</td>
                    <td>{{ $movie->release_date }}</td>
                    <td>{{ $movie->overview }}</td>
                    <td>
                        @if($movie->image_link)
                            <img src="{{ $movie->image_link }}" width="100">
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

</body>
</html>