<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Thể loại Phim</title>
</head>
<body>
    <h2>Danh sách thể loại phim</h2>
    
    <ul>
        @foreach($genres as $genre)
            <li>
                <strong>{{ $genre->genre_name }}</strong> 
                ({{ $genre->genre_name_vn }})
            </li>
        @endforeach
    </ul>

</body>
</html>