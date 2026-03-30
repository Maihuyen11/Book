<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Phim có thời lượng trên 120 phút</title>
</head>
<body>
    <h2>Danh sách 10 bộ phim dài hơn 120 phút</h2>
    
    <ul>
        @foreach($movies as $movie)
            <li>
                <strong>Tên phim:</strong> {{ $movie->movie_name }} <br>
                <strong>Ngày phát hành:</strong> {{ $movie->release_date }} <br>
                <strong>Thời lượng:</strong> {{ $movie->runtime }} phút
            </li>
            <br>
        @endforeach
    </ul>
</body>
</html>