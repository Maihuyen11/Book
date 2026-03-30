<x-main-layout>
    <x-slot name="title">Thông tin sách: {{ $sach->tieu_de }}</x-slot>

    <div class="row">
        <div class="col-4">
            <img src="{{ asset('image/'.$sach->file_anh_bia) }}" width="100%" class="img-thumbnail">
        </div>
        <div class="col-8">
            <h2 class="text-danger">{{ $sach->tieu_de }}</h2>
            <p><b>Giá bán:</b> <span class="badge badge-warning" style="font-size: 1.2rem;">{{ number_format($sach->gia_ban, 0, ",", ".") }}đ</span></p>
            <p><b>Mô tả:</b></p>
            <p class="text-justify">{{ $sach->mo_ta }}</p>
            <hr>
            <a href="{{ url('sach') }}" class="btn btn-secondary">Quay lại danh sách</a>
            <button class="btn btn-primary">Thêm vào giỏ hàng</button>
        </div>
    </div>
</x-main-layout>