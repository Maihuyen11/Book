<x-main-layout>
    <x-slot name="title">Danh sách sách</x-slot> 

    <div id='book-view-div'> 
        <div class='list-book'> 
            @foreach($data as $row) 
                <div class='book'> 
                    <a href="{{ url('sach/chitiet/'.$row->id) }}" style="text-decoration: none; color: inherit;"> 
                        <img src="{{ asset('image/'.$row->file_anh_bia) }}" width='200px' height='200px'> 
                        <br>
                        <b>{{ $row->tieu_de }}</b><br/> 
                        <i>{{ number_format($row->gia_ban, 0, ",", ".") }}đ</i> 
                    </a>
                    
                    <div class='btn-add-product'>
                        <button class='btn btn-success btn-sm mb-1 add-product' book_id="{{$row->id}}">
                            Thêm vào giỏ hàng
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
    $(document).ready(function(){
        
        // 1. Xử lý sự kiện Thêm vào giỏ hàng (Dùng Event Delegation để không bị liệt nút)
        $(document).on("click", ".add-product", function(){
            let id = $(this).attr("book_id");
            let num = 1;
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('cartadd') }}",
                data: {"_token": "{{ csrf_token() }}", "id": id, "num": num},
                success: function(data) {
                    $("#cart-number-product").html(data); // Cập nhật số lượng trên giỏ hàng
                    alert("Đã thêm sách vào giỏ hàng!"); // Thông báo nhỏ để biết đã thêm thành công
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        });

        // 2. Xử lý lọc danh sách theo thể loại
        $(".menu-the-loai").click(function(e){
            e.preventDefault(); // Ngăn trình duyệt nhảy lên đầu trang
            let the_loai = $(this).attr("the_loai");
            
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ route('bookview') }}",
                data: {"_token": "{{ csrf_token() }}", "the_loai": the_loai},
                success: function(data) {
                    $("#book-view-div").html(data); // Cập nhật lại HTML của danh sách sách
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        });

    });
    </script>
</x-main-layout>