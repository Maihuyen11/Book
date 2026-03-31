<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayOutController;
use App\Http\Controllers\BookController;

Route::get('/baoyen', function () {
    return 'Bảo Yến'; 
});
Route::get('/buimaihuyen', function () {
    return 'Bùi Mai Huyền';
});


Route::get('/test', [TestController::class, 'test']);

Route::get('/Dinhcuong', function () {
    return 'Dinh Cuong';
});

Route::get('/tranvothuhung', function () {
    return 'Trần Võ Thu Hưng';
});

Route::get('/truongthicamhong', function () {
    return 'Trương Thị Cẩm Hồng';
});

Route::get('/phamlebichhop', function () {
    return 'Phạm Lê Bích Hợp';
});


// Route hiển thị phim hành động
Route::get('/action', [App\Http\Controllers\MovieController::class, 'phimHanhDong']);
use App\Http\Controllers\MovieController;

Route::get('/phim_doanh_thu_cao_nhat', [MovieController::class, 'phimDoanhThuCaoNhat']);

Route::get('/the-loai-phim', [MovieController::class, 'showGenres']);

Route::get('/canada-movies', [MovieController::class, 'phimCanada']);

Route::get('/phim-tren-120-phut', [MovieController::class, 'phimThoiLuongDai']);

Route::get('/top-movies', [MovieController::class, 'topMovies']);

// 1. Trang mặc định hiển thị 8 cuốn sách rẻ nhất
Route::get('/sach', [LayOutController::class, 'sach']);

// 2. Trang hiển thị sách theo thể loại khi bấm Menu 
Route::get('/sach/theloai/{id}', [LayOutController::class, 'theloai']);

// 3. Trang xem chi tiết 
Route::get('/sach/chitiet/{id}', [LayOutController::class, 'chitiet']);

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 1. Đặt trang chủ mặc định là trang Sách
Route::get('/', [App\Http\Controllers\LayOutController::class, 'sach']);

// 2. Route hiển thị trang cập nhật thông tin (Yêu cầu đăng nhập)
Route::get('/accountpanel','App\Http\Controllers\AccountController@accountpanel')
    ->middleware('auth')->name("account");

// 3. Route xử lý lưu thông tin cá nhân
Route::post('/saveaccountinfo', 'App\Http\Controllers\AccountController@saveaccountinfo')
    ->middleware('auth')->name('saveinfo');

require __DIR__.'/auth.php';

Route::post('/bookview', 'App\Http\Controllers\LayOutController@bookview')->name("bookview");
Route::post('/cart/add', 'App\Http\Controllers\LayOutController@cartadd')->name('cartadd');
// Trang danh sách sách (index)
Route::get('/danh-muc-sach', [BookController::class, 'index'])->name('sach.index');

// Nhóm Route Thêm mới
Route::get('/them-moi-sach', [BookController::class, 'create'])->name('sach.create');
Route::post('/them-moi-sach', [BookController::class, 'store'])->name('sach.store');

// Nhóm Route Sửa sách (Cần truyền {id} để biết sửa cuốn nào)
Route::get('/sua-sach/{id}', [BookController::class, 'edit'])->name('sach.edit');
Route::post('/sua-sach/{id}', [BookController::class, 'update'])->name('sach.update');

// Route Xóa sách
Route::get('/xoa-sach/{id}', [BookController::class, 'destroy'])->name('sach.destroy');
