<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Top 10 Phim Cao Điểm</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #f8f9fa; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
        th, td { border: 1px solid #dee2e6; padding: 12px; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        h2 { color: #333; text-align: center; }
    </style>
</head>
<body>
    <h2>DANH SÁCH 10 BỘ PHIM CÓ ĐIỂM BÌNH CHỌN CAO NHẤT</h2>
    <table>
        <thead>
            <tr>
                <th>Tên bộ phim</th>
                <th>Ngày phát hành</th>
                <th>Điểm bình chọn</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movies as $movie)
            <tr>
                <td>{{ $movie->movie_name }}</td>
                <td>{{ date('d/m/Y', strtotime($movie->release_date)) }}</td>
                <td><strong>{{ $movie->vote_average }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>