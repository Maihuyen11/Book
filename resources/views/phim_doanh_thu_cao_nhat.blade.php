<h2>Top 10 phim có doanh thu cao nhất</h2>

@foreach($movies as $movie)
    <p>
        Tên phim: {{ $movie->movie_name }} <br>
        Ngày phát hành: {{ $movie->release_date }} <br>
        Doanh thu: {{ $movie->budget }}
    </p>
    <hr>
@endforeach