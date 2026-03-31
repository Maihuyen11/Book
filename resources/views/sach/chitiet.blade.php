<x-main-layout>
    <x-slot name="title">Thông tin sách: {{ $sach->tieu_de }}</x-slot>

    <div class="row">
        <div class="col-4">
            <img src="{{ asset('hinh/image/'.$sach->file_anh_bia) }}" width="100%" class="img-thumbnail">
        </div>
        <div class="col-8">
            <h2 class="text-danger">{{ $sach->tieu_de }}</h2>
            <p><b>Giá bán:</b> <span class="badge badge-warning" style="font-size: 1.2rem;">{{ number_format($sach->gia_ban, 0, ",", ".") }}đ</span></p>
            <p><b>Mô tả:</b></p>
            <p class="text-justify">{{ $sach->mo_ta }}</p>
            <hr>
            <a href="{{ url('sach') }}" class="btn btn-secondary">Quay lại danh sách</a>
            <div class='mt-1'>
                Số lượng mua:
                <input type='number' id='product-number' size='5' min="1" value="1">
                <button class='btn btn-success btn-sm mb-1' id='add-to-cart'>Thêm vào giỏ hàng</button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
        $("#add-to-cart").click(function(){
            id = "{{$sach->id}}";
            num = $("#product-number").val()
            $.ajax({
            type:"POST",
            dataType:"json",
            url: "{{route('cartadd')}}",
            data:{"_token": "{{ csrf_token() }}","id":id,"num":num},
            beforeSend:function(){
            },
            success:function(data){
                $("#cart-number-product").html(data);
            },
            error: function (xhr,status,error){
            },
            complete: function(xhr,status){
            }
            });
                    });
                });
    </script>
</x-main-layout>