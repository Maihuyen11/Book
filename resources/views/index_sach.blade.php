<style>
    .image-column {
        width: 150px; 
        text-align: center;
        vertical-align: middle;
        padding: 10px;
        border: 1px solid black !important; 
    }

    .image-column img {
        width: 110px; 
        height: auto;
        object-fit: cover;
        border: none;
    }

    .action-column {
        width: 100px;
        text-align: center;
        vertical-align: middle;
        border: 1px solid black !important; 
        padding: 10px;
    }

    .action-container {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .btn-action {
        display: inline-block;
        padding: 8px 10px;
        color: white !important;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    .btn-edit { background-color: #17a2b8; }
    .btn-delete { background-color: #dc3545; }
</style>
<div style="padding: 20px;">
    <center>
        <h1>DANH MỤC SÁCH</h1>
    </center>

    @if(session('status'))
        <div style="color: green; margin-bottom: 10px;">{{ session('status') }}</div> 
    @endif

    <a href="{{ route('sach.create') }}" style="text-decoration: none; background: blue; color: white; padding: 5px 10px; border-radius: 3px;">+ Thêm sách mới</a>
    <table border="1" style="width:100%; border-collapse: collapse; margin-top: 20px; text-align: center;">
        <thead style="background: #f2f2f2;">
            <tr>
                <th>Tiêu đề</th>
                <th>Tác giả</th>
                <th>Nhà xuất bản</th>
                <th>Nhà cung cấp</th>
                <th>Hình thức bìa</th>
                <th>Giá bán</th>
                <th>Hình ảnh</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ds_sach as $s)
            <tr>
                <td>{{ $s->tieu_de }}</td>
                <td>{{ $s->tac_gia }}</td>
                <td>{{ $s->nha_xuat_ban }}</td>
                <td>{{ $s->nha_cung_cap }}</td>
                 <td>{{ $s->hinh_thuc_bia }}</td>
                <td>{{ number_format($s->gia_ban) }}đ</td>

          <td class="image-column">
    @if($s->file_anh_bia && file_exists(public_path('storage/books/' . $s->file_anh_bia)))
        <img src="{{ asset('storage/books/' . $s->file_anh_bia) }}">
    @elseif($s->file_anh_bia && file_exists(public_path('image/' . $s->file_anh_bia)))
        <img src="{{ asset('image/' . $s->file_anh_bia) }}">
    @elseif($s->link_anh_bia)
        <img src="{{ $s->link_anh_bia }}">
    @endif
</td>

                <td class="action-column">
                <div class="action-container">
                    <a href="{{ route('sach.edit', $s->id) }}" class="btn-action btn-edit">
                        Sửa
                    </a>

                    <a href="{{ route('sach.destroy', $s->id) }}" 
                    class="btn-action btn-delete" 
                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                        Xóa
                    </a>
                </div>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>