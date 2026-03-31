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
            <button class="btn btn-primary" id="add-to-cart">Thêm vào giỏ hàng</button>
        </div>
    </div>
<script>
$(document).ready(function(){
    $("#add-to-cart").click(function(e){
        // 1. Ngăn chặn hành vi mặc định (tránh reload trang nếu nút nằm trong form)
        e.preventDefault(); 
        
        let id = "{{ $sach->id }}"; 
        let num = $("#product-number").length > 0 ? $("#product-number").val() : 1; 

        $.ajax({
            type: "POST",
            // 2. Tắt dataType: "json" hoặc đổi thành "html" để JQuery không bị lỗi parse
            dataType: "html", 
            url: "{{ route('cartadd') }}",
            data: {
                "_token": "{{ csrf_token() }}", 
                "id": id, 
                "num": num
            },
            success: function(data) {
                // 3. Cập nhật số lượng mới nhất lên icon giỏ hàng
                $("#cart-number-product").html(data); 
                alert("Đã thêm sách vào giỏ hàng thành công!");
            },
            error: function (xhr, status, error) {
                console.log("Lỗi AJAX:", error);
                console.log("Chi tiết:", xhr.responseText);
                alert("Có lỗi xảy ra, vui lòng thử lại!");
            }
        });
    });
});
</script>
</x-main-layout>