<h2>Danh sách phim Canada</h2>
<ul>
    @foreach ($movies as $movie)
        <li>
            Tên phim: {{ $movie->movie_name }} <br>
            Ngày phát hành: {{ $movie->release_date }} <br>
            Thời lượng: {{ $movie->runtime }}
        </li>
        <hr>
    @endforeach
</ul>