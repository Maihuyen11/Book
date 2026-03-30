<x-main-layout>
    <x-slot name="title">Danh sách sách</x-slot> 

    <div class='list-book'> 
        @foreach($data as $row) 
            <div class='book'> 
                <a href="{{ url('sach/chitiet/'.$row->id) }}"> 
                    <img src="{{ asset('image/'.$row->file_anh_bia) }}" width='200px' height='200px'> 
                    <br>
                    <b>{{ $row->tieu_de }}</b><br/> 
                    <i>{{ number_format($row->gia_ban, 0, ",", ".") }}đ</i> 
                </a>
            </div>
        @endforeach
    </div>
</x-main-layout>