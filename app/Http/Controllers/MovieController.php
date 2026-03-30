<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    // Yêu cầu 7.2: Hàm lấy 10 phim điểm cao nhất
    public function topMovies()
    {
        $movies = DB::table('movie')
            ->orderBy('vote_average', 'desc')
            ->limit(10)
            ->get();

        return view('top_movies', compact('movies'));
    }

    public function runtimeOver120()
    {
        $movies = DB::table('movie')
            ->select('movie_name', 'release_date', 'runtime')
            ->where('runtime', '>', 120)
            ->limit(10)
            ->get();

        return view('runtime_over_120', compact('movies'));
    }
    public function phimDoanhThuCaoNhat()
    {
    $movies = DB::table('movie') // check lại tên bảng
        ->select('movie_name', 'release_date', 'budget')
        ->orderBy('budget', 'desc')
        ->limit(10)
        ->get();

    return view('phim_doanh_thu_cao_nhat', compact('movies'));
    }
    public function phimHanhDong()
    {
        $movies = DB::table('movie')
            ->join('movie_genre', 'movie.id', '=', 'movie_genre.id_movie')
            ->join('genre', 'movie_genre.id_genre', '=', 'genre.id')
            ->where('genre.genre_name', 'Action')
            ->select('movie.movie_name', 'movie.release_date', 'movie.overview', 'movie.image_link')
            ->get();
            
        return view('action', compact('movies'));
    }
     public function phimThoiLuongDai()
    {
        // Truy vấn 10 bộ phim có runtime > 120 phút
        $movies = DB::table('movie') 
                    ->select('movie_name', 'release_date', 'runtime')
                    ->where('runtime', '>', 120)
                    ->limit(10)
                    ->get();

        // Trả về view và truyền biến $movies sang
        return view('phim_thoi_luong_dai', compact('movies'));
    }
     public function showGenres()
    {
        $genres = DB::table('genre')->get(); 
        return view('genres', compact('genres')); 
    }
    public function phimCanada()
    {
        $movies = DB::table('movie')
            ->select('movie_name', 'release_date', 'runtime')
            ->where('country_name', 'Canada')
            ->limit(10)
            ->get();

        return view('canada_movies', compact('movies'));
    }
}