<div style="width: 400px; margin: 20px auto; border: 1px solid #ccc; padding: 20px;">
    <h3 style="text-align: center;">CHỈNH SỬA SÁCH</h3>
    
    <form action="{{ route('sach.update', $sach->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Tiêu đề sách:</label><br>
        <input type="text" name="tieu_de" value="{{ $sach->tieu_de }}" required style="width: 100%;"><br><br>

        <label>Giá bán:</label><br>
        <input type="number" name="gia_ban" value="{{ $sach->gia_ban }}" required style="width: 100%;"><br><br>
        
        <label>Tác giả:</label>
        <input type="text" name="tac_gia" value="{{ $sach->tac_gia }}" required style="width: 100%;"><br><br>

        <label>Nhà xuất bản:</label>
        <input type="text" name="nha_xuat_ban" value="{{ $sach->nha_xuat_ban }}" required style="width: 100%;"><br><br>

        <label>Nhà cung cấp:</label>
        <input type="text" name="nha_cung_cap" value="{{ $sach->nha_cung_cap }}" required style="width: 100%;"><br><br>

        <label>Hình thức bìa:</label>
        <input type="text" name="hinh_thuc_bia" value="{{ $sach->hinh_thuc_bia }}" required style="width: 100%;"><br><br>


        <label>Ảnh bìa hiện tại:</label><br>
       <div style="margin-bottom: 10px;">
        @if($sach->file_anh_bia && file_exists(public_path('storage/books/' . $sach->file_anh_bia)))
            <img src="{{ asset('storage/books/' . $sach->file_anh_bia) }}" width="120">
        @elseif($sach->file_anh_bia && file_exists(public_path('image/' . $sach->file_anh_bia)))
            <img src="{{ asset('image/' . $sach->file_anh_bia) }}" width="120">
        @elseif($sach->link_anh_bia)
            <img src="{{ $sach->link_anh_bia }}" width="120">
        @endif
    </div>
        <br>
        <label>Thay ảnh mới (nếu muốn):</label><br>
        <input type="file" name="file_anh_bia" accept="image/*"><br><br>

        <div style="text-align: center;">
            <button type="submit" style="background: orange; color: white; padding: 10px 20px; border: none; cursor: pointer;">Cập Nhật</button>
            <a href="{{ route('sach.index') }}">Hủy</a>
        </div>
    </form>
</div>