<h2>Danh sách phim có thời lượng > 120 phút</h2>

@foreach($movies as $movie)
    <p>
        Tên phim: {{ $movie->movie_name }} <br>
        Ngày phát hành: {{ $movie->release_date }} <br>
        Thời lượng: {{ $movie->runtime }} phút
    </p>
    <hr>
@endforeach