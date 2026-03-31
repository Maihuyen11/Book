<div style="width: 400px; margin: 20px auto; border: 1px solid #ccc; padding: 20px;">
    <h3 style="text-align: center;">THÊM SÁCH MỚI</h3>
    
    <form action="{{ route('sach.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Tiêu đề sách:</label><br>
        <input type="text" name="tieu_de" required style="width: 100%;"><br><br>

        <label>Tác giả:</label><br>
        <input type="text" name="tac_gia" style="width: 100%;"><br><br>

        <label>Giá bán:</label><br>
        <input type="number" name="gia_ban" required style="width: 100%;"><br><br>

        <label>Nhà xuất bản:</label>
        <input type="text" name="nha_xuat_ban" required style="width: 100%;"><br><br>

        <label>Nhà cung cấp:</label>
        <input type="text" name="nha_cung_cap" required style="width: 100%;"><br><br>

        <label>Hình thức bìa:</label>
        <input type="text" name="hinh_thuc_bia" required style="width: 100%;"><br><br>

        <label>Upload ảnh bìa:</label><br>
        <input type="file" name="file_anh_bia" accept="image/*"><br><br> 

        <label>Hoặc dán Link ảnh:</label><br>
        <input type="text" name="link_anh_bia" style="width: 100%;" placeholder="http://..."><br><br>

        <div style="text-align: center;">
            <button type="submit" style="background: green; color: white; padding: 10px 20px; border: none; cursor: pointer;">Lưu Sách</button>
            <a href="{{ route('sach.index') }}">Quay lại</a>
        </div>
    </form>
</div>