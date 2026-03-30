<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Nhà Sách Phương Nam' }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .navbar { background-color: #ff5850; font-weight: bold; }
        .nav-item a { color: #fff !important; }
        .navbar-nav { margin: 0 auto; }
        .list-book { display: grid; grid-template-columns: repeat(4, 24%); }
        .book { margin: 10px; text-align: center; }
        .list-book {
    display: grid;
    grid-template-columns: repeat(4, 24%); /* Chia 4 cột [cite: 152] */
}
.book {
    margin: 10px;
    text-align: center; /* Căn giữa nội dung sách [cite: 156, 157] */
}
    </style>
</head>
<body>
    <header style='text-align:center'>
        <img src="{{ asset('image/banner_sach.jpg') }}" width="1000px">
    </header>

    <main style="width:1000px; margin:2px auto;">
        <div class='row'>
            <div class='col-3 pr-0'>
                <nav class="navbar navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('sach') }}">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('sach/theloai/1') }}">Tiểu thuyết </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('sach/theloai/2') }}">Truyện ngắn-tản văn </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('sach/theloai/3') }}">Tác phẩm kinh điển </a>
                        </li>
                    </ul>
                </nav>
                <img src="{{ asset('image/sidebar_1.jpg') }}" width="100%" class='mt-1'>
                <img src="{{ asset('image/sidebar_2.jpg') }}" width="100%" class='mt-1'>
            </div>

            <div class='col-9'>
                {{ $slot }} 
            </div>
        </div>
    </main>
</body>
</html>